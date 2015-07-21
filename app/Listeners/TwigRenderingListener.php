<?php

namespace App\Listeners;

use Twig_Environment as Twig;
use Symfony\Component\HttpFoundation\Request;

/**
 * View listener that converts an array result to string using a Twig template
 */
class TwigRenderingListener
{
    private $routes;
    private $twig;

    /**
     * @param Twig_Environment $twig
     */
    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Render a twig template from an array returned by a controller
     *
     * @param  array   $controllerResult
     * @param  Request $request
     *
     * @return string                    The template rendered as a string
     */
    public function __invoke(array $controllerResult, Request $request)
    {
        if (! $template = $request->attributes->get('template')) {
            throw new \RuntimeException('Template file must be specified for the route');
        }

        return $this->twig->render($template, $controllerResult);
    }
}
