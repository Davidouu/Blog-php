<?php

namespace App\Http;

class File
{
    /*
    * Get file
    * @param string $name
    * @return mixed
    */
    public function get(string $name): mixed
    {
        return $_FILES[$name] ?? null;
    }
}
