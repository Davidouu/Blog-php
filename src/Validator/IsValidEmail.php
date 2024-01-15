<?php

namespace App\Validator;

#[\Attribute]
class IsValidEmail
{
    public function __construct(private string $message)
    {
    }

    /**
     * @param string $value
     * @return bool
     */
    public function validate(string $value): bool
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {

            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
