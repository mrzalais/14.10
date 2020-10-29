<?php


class NumberStorage
{
    private $resource;

    private array $numbers;

    public function __construct()
    {
        $this->resource = fopen('numbers.csv', 'rwb+');

        $this->loadPersonData();
    }

    private function loadPersonData(): array
    {
        $numbers = [];

        while (!feof($this->resource)) {

            $personData = array_filter((array)fgetcsv($this->resource));

            if (!empty($personData)) {
                $this->numbers[] = new NumberData(
                    (string)$personData[0],
                    (string)$personData[1],
                    (int)$personData[2],
                );
            }
        }
        return $numbers;
    }

    public function getByNumber(int $number): ?NumberData
    {
        foreach ($this->numbers as $numberData) {
            /** @var NumberData $numberData */
            if ($numberData->getNumber() === $number) {
                return $numberData;
            }
        }
        return null;
    }
}
