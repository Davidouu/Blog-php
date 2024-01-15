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
    * @return string
    */
    public function upload(array $file): string
    {
        if ($file['size'] > 1000000) {
            return $errors['thumbnailUrl'] = 'Le fichier est trop volumineux';
        } elseif ($file['error'] !== 0) {
            return $errors['thumbnailUrl'] = 'Une erreur est survenue lors de l\'upload du fichier';
        } elseif ($file['size'] === 0) {
            return $errors['thumbnailUrl'] = 'L\'image de mise en avant est obligatoire';
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (! in_array($extension, $this->extensions)) {
            return $errors['thumbnailUrl'] = 'Le format du fichier n\'est pas autorisé';
        }

        $filename = uniqid().'.'.$extension;

        if (! move_uploaded_file($file['tmp_name'], $this->path.'uploads/thumbnails/'.$filename)) {
            return $errors['thumbnailUrl'] = 'Une erreur est survenue lors de l\'upload du fichier';
        }

        return $filename;
    }
}
