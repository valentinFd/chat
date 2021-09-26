<?php

namespace App;

class Message
{
    private string $sender;

    public function getSender(): string
    {
        return $this->sender;
    }

    private string $text;

    public function getText(): string
    {
        return $this->text;
    }

    public function __construct(string $sender, string $text)
    {
        $this->sender = $sender;
        $this->text = $text;
    }

    public static function getPropertyNames(): array
    {
        return array_keys(get_class_vars(__CLASS__));
    }
}
