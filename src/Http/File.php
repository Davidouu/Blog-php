<?php

namespace App\Http;

class file
{
    /*
    * @param string $name
    * @return mixed
    */
    public function get(string $name): mixed
    {
        return $_FILES[$name] ?? null;
    }
}
