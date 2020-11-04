<?php


class User
{
    private string $name;
    private int $pin;
    private int $id;

    public function __construct(int $id, string $name, int $pin)
    {

        $this->name = $name;
        $this->pin = $pin;
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumber(): int
    {
        return $this->pin;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'number' => $this->getNumber(),
        ];
    }
}