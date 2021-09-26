<?php

namespace App;

use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;

class Chat
{
    private array $messages;

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function __construct()
    {
        $this->messages = [];
        $csv = Reader::createFromPath("messages.csv", "r");
        $csv->setHeaderOffset(0);
        $csv->setDelimiter(";");
        $messages = Statement::create()->process($csv);
        foreach ($messages as $message)
        {
            $this->messages[] = new Message(...array_values($message));
        }
    }

    public function send(Message $message): void
    {
        $this->messages[] = $message;
        $this->save();
    }

    private function save(): void
    {
        $writer = Writer::createFromPath("messages.csv", "w");
        $writer->setDelimiter(";");
        $writer->insertOne(Message::getPropertyNames());
        foreach ($this->messages as $message)
        {
            $writer->insertOne((array)$message);
        }
    }
}
