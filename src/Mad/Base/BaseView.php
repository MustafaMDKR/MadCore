<?php

declare (strict_types=1);

namespace Mad\Base;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;


class BaseView
{

    /**
     * Get the contents of a view template using Twig
     *
     * @param string $template The template-file
     * @param array  $context  Associative array of data to display in the view (Optional)
     * 
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Exception
     */
    public function getTemplate(string $template, array $context = [])
    {
        static $twig;
        if ($twig === null) {
            $loader = new FilesystemLoader('templates', TEMPLATES_PATH);
            $twig = new Environment($loader, array());
            $twig->addExtension(new DebugExtension());
            $twig->addExtension(new TwigExtension());
        }
        return $twig->render($template, $context);
    }

}