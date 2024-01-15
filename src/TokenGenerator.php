<?php

namespace App;

class TokenGenerator
{
    /**
     * Generate a token
     * @return string
     */
    public static function generateToken(): string
    {
        return bin2hex(random_bytes(32));
    }
}
