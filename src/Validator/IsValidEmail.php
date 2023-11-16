<?php

namespace App\Validator;

#[\Attribute]
class IsValidEmail
{
    public function __construct(private string $message)
    {
    }

    public function validate(string $value): bool
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {

            return false;
        }

        return true;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
