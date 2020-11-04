<?php


class Message
{
    private int $id;
    private string $msg;

    public function __construct(int $id, string $msg)
    {
        $this->id = $id;
        $this->msg = $msg;
    }

    public function getMsg(): string
    {
        return $this->msg;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'message' => $this->getMsg(),
        ];
    }
}