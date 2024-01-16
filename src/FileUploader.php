<?php

namespace App;

class FileUploader
{
    private string $path;

    public function __construct(private array $extensions)
    {
        $this->path = dirname(__DIR__).'/public/';
    }

    /**
    * @param array $file
    * @return string|array
    */
    public function upload(array $file): string|array
    {
        $errors = [];

        if ($file['size'] > 1000000) {
            $errors['thumbnailUrl'] = 'Le fichier est trop volumineux';
            return $errors;
        } elseif ($file['error'] !== 0) {
            $errors['thumbnailUrl'] = 'Une erreur est survenue lors de l\'upload du fichier';
            return $errors;
        } elseif ($file['size'] === 0) {
            $errors['thumbnailUrl'] = 'L\'image de mise en avant est obligatoire';
            return $errors;
        }

        


        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (! in_array($extension, $this->extensions)) {
            $errors['thumbnailUrl'] = 'Le format du fichier n\'est pas autorisé';
            return $errors;
        }

        
        $filename = uniqid().'.'.$extension;
        
        if (! move_uploaded_file($file['tmp_name'], $this->path.'uploads/thumbnails/'.$filename)) {
            $errors['thumbnailUrl'] = 'Une erreur est survenue lors de l\'upload du fichier';
            return $errors;
        }

        return $filename;
    }
}
