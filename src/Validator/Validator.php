<?php

namespace App\Validator;

class Validator
{
    // Method to validate an object with attributes
    public function validate(object $object, array $data): array
    {
        $class = new \ReflectionClass($object);
        $properties = $class->getProperties();

        $errors = [];

        foreach ($properties as $property) {
            $attributes = $property->getAttributes();

            foreach ($attributes as $attribute) {
                $attrInstance = $attribute->newInstance();

                if (! $attrInstance->validate($data[$property->getName()] === null ? '' : $data[$property->getName()])) {
                    $errors[$property->getName()] = $attrInstance->getMessage();
                }
            }
        }

        return $errors;
    }
}
