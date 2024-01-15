<?php

namespace App;

class Hydrator
{
    /**
    * @var array
    */
    private const DATES = [
        'publishDate',
        'updateDate',
        'comfirmationToken',
        'validateAt',
    ];

    /**
    * @param object $entity
    * @param array $data
    * @return void
    */
    public function Hydrate(object $entity, array $data): void
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
