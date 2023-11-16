<?php

namespace App\Validator;

#[\Attribute]
class IsValidPassword
{
    public function __construct(private string $message)
    {
    }

    public function validate(string $value): bool
    {
        if (! preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/', $value)) {

            return false;
        }

        return true;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
