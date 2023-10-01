<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

abstract class AbstractController
{
    public function __construct(protected Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Render the twig template.
     */
    protected function render(string $template, array $data = []): string
    {
        try {
            return $this->twig->render($template, $data);
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            return $e->getMessage();
        }
    }
}
