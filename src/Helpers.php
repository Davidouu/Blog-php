<?php

namespace App;

class helpers
{
    public static function slugify(string $slug): string
    {
        $slug = strtolower($slug);
        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

        return $slug;
    }
}
