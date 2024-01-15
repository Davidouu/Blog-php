<?php

namespace App\Validator;

#[\Attribute]
class IsNotEmpty
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
        return ! empty($value);
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
