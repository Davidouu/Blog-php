<?php

namespace App\Controller;

use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

abstract class AbstractController
{
    public function __construct(
        protected Environment $twig,
        protected Request $request,
        protected Session $session,
        protected File $files
    ) {
        $this->twig = $twig;
        $this->request = $request;
        $this->session = $session;
        $this->files = $files;
    }

    /**
     * Render the twig template.
     * @param string $template
     * @param array $data
     * @return string
     */
    protected function render(string $template, array $data = []): string
    {
        try {
            return $this->twig->render($template, $data);
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            return $e->getMessage();
        }
    }

    /**
    * Redirect the user
    * @param string $url
    * @return void
    */
    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit();
    }
}
