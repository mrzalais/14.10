<?php


class UserStorage
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
                $this->users[] = new User(
                    (int)$numberData[0],
                    (string)$numberData[1],
                    (int)$numberData[2],
                );
            }
        }
        return $users;
    }

    public function loginWithPin(int $number): ?User
    {
        foreach ($this->users as $userData) {
            /** @var User $userData */
            if ($userData->getNumber() === $number) {
                return $userData;
            }
        }
        return null;
    }
}
