<?php


class UserWithPin
{
    private string $name;
    private int $pin;

    public function __construct(string $name, int $pin)
    {

        $this->name = $name;
        $this->pin = $pin;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumber(): int
    {
        return $this->pin;
    }
}