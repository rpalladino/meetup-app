<?php

namespace App\Listeners;

use Twig_Environment as Twig;
use Symfony\Component\HttpFoundation\Request;

class TwigRenderingListener
{
    private $routes;
    private $twig;

    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(array $controllerResult, Request $request)
    {
        if (! $template = $request->attributes->get('template')) {
            throw new \RuntimeException('Template file must be specified for the route');
        }

        return $this->twig->render($template, $controllerResult);
    }
}
