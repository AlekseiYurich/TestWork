<?php

namespace App\Events;

class ExceptionEvents
{
    public string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }


    public function getMessage(): string
    {
        return $this->message;
    }


    public function setMessage(string $message): ExceptionEvents
    {
        $this->message = $message;
        return $this;
    }
}