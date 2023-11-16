<?php

namespace App\Validator;

#[\Attribute]
class IsNotEmpty
{
    public function __construct(private string $message)
    {
    }

    public function validate(string $value): bool
    {
        return ! empty($value);
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
