<?php


class MessageStorage
{
    private $resource;

    private array $messages;

    public function __construct()
    {
        $this->resource = fopen('messages.csv', 'rwb+');

        $this->loadMessages();

        fclose($this->resource);
    }

    private function loadMessages(): array
    {
        $messages = [];

        while (feof($this->resource)) {

            $messageData = array_filter((array)fgetcsv($this->resource));

            var_dump($messageData);

            if (!empty($messageData)) {
                $this->messages[] = new Message(
                    (int)$messageData[0],
                    (string)$messageData[1],
                );
            }
        }
        return $messages;
    }

    public function saveMessage(array $msg, string $record): void
    {
        if ($record === 'addmsg') {
            file_put_contents('messages.csv', implode(',', $msg).PHP_EOL, FILE_APPEND);
        }
    }
}
