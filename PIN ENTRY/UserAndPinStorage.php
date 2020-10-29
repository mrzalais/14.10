<?php


class UserAndPinStorage
{
    private $resource;

    private array $users;

    public function __construct()
    {
        $this->resource = fopen('pins.csv', 'rwb+');

        $this->loadPersonData();
    }

    private function loadPersonData(): array
    {
        $users = [];

        while (!feof($this->resource)) {

            $numberData = array_filter((array)fgetcsv($this->resource));

            if (!empty($numberData)) {
                $this->users[] = new UserWithPin(
                    (string)$numberData[0],
                    (int)$numberData[1],
                );
            }
        }
        return $users;
    }

    public function loginWithPin(int $number): ?UserWithPin
    {
        foreach ($this->users as $userData) {
            /** @var UserWithPin $userData */
            if ($userData->getNumber() === $number) {
                return $userData;
            }
        }
        return null;
    }
}
