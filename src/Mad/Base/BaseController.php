<?php

declare (strict_types=1);

namespace Mad\Base;

use Mad\Base\BaseView;
use Mad\Base\Exception\BaseBadMethodCallException;
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


    /**
     * Magic  method called when a non-existent or inaccessable method
     * is called on an object of this class. Used to excute before and after filter methods
     * on action methods.
     * Action methods need to be named with "Action" suffix e.g. indexAction - showAction. 
     *
     * @param [type] $name
     * @param [type] $arguments
     * @return void
     * @throws BaseBadMethodCallException
     */
    public function __call($name, $arguments): void
    {
        $method = $name . 'Action';
        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $arguments);
                $this->after();
            } else {
                throw new BaseBadMethodCallException('Method ' . $method . ' does not exist in ' . get_class($this));
            }
        }
    }


    /**
     * A method to be called before a controller method.
     *
     * @return void
     */
    protected function before()
    {}


    /**
     * A method to be called after a controller method.
     *
     * @return void
     */
    protected function after()
    {}

}