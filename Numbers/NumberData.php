<?php


class NumberData
{
    private string $name;
    private string $surname;
    private int $number;

    public function __construct(string $name, string $surname, int $number)
    {

        $this->name = $name;
        $this->surname = $surname;
        $this->number = $number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'number' => $this->getNumber(),
        ];
    }
}