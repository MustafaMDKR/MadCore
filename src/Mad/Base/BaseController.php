<?php

declare (strict_types=1);

namespace Mad\Base;

use Mad\Base\BaseView;
use Mad\Base\Exception\BaseLogicException;

class BaseController
{

    /**
     * @var array
     */
    protected array $routeParams = [];

    /**
     * @var Object
     */
    private Object $twig;


    /**
     * Main Class Constructor
     *
     * @param array $routeParams
     * @return void
     */
    public function __construct(array $routeParams)
    {
        $this->routeParams = $routeParams;
        $this->twig = new BaseView();
    }


    /**
     * Renders a view template from sub controller classes
     *
     * @param string $template
     * @param array  $context
     * @return Response
     */
    public function render(string $template, array $context = [])
    {
        if ($this->twig === null) {
            throw new BaseLogicException('You cannot use the render method if the twig bundle is not available.'); 
        }
        return $this->twig->getTemplate($template, $context);
    }
}