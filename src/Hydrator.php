<?php

namespace App;

class Hydrator
{
    // Dates
    private const DATES = [
        'publishDate',
        'updateDate',
        'comfirmationToken',
        'validateAt',
    ];

    // Hydrate the entity
    public function Hydrate(object $entity, array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($entity, $method)) {
                if (in_array($key, self::DATES)) {
                    $value = new \DateTime($value);
                }
                $entity->$method($value);
            }
        }
    }
}
