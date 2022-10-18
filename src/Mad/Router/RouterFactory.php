<?php

declare(strict_types=1);

namespace Mad\Router;

use Mad\Base\Exception\BaseNoValueException;
use Mad\Base\Exception\BaseUnexpectedValueException;
use Mad\Yaml\YamlConfig;

class RouterFactory
{

    protected RouterInterface $router;

    protected string $dispatchedUrl;

    protected array $routes;


    public function __construct(string $dispatchedUrl = null, array $routes)
    {
        if (empty($routes)) {
            throw new BaseNoValueException('There are one or more empty arguments. In order to continue please ensure your <code>routes.yaml</code> has your defined routes and ypu are passing the correct $_SERVER variable ie "QUERY_STRING".');
        }

        $this->dispatchedUrl = $dispatchedUrl;
        $this->routes = $routes;
    }


    public function create(string $routerString): self
    {
        $this->router = new $routerString();
        if (!$this->router instanceof RouterInterface) {
            throw new BaseUnexpectedValueException($routerString . ' is not a valid Routwer object.');
        }
        return $this;
    }


    public function buildRoutes()
    {
        if (is_array($this->routes) && !empty($this->routes)) {
            $args = [];
            foreach ($this->routes as $key => $route) {
                if (isset($route['namespace']) && $route['namespace'] != '') {
                    $args = ['namespace' => $route['namespace']];
                } elseif (isset($route['controller']) && $route['controller'] != '') {
                    $args = [
                        'controller' => $route['controller'],
                        'action'     => $route['action']
                    ];
                }
                if (isset($key)) {
                    $this->router->add($key, $args);
                }
            }
            $this->router->dispatch($this->dispatchedUrl);
        }
        return false;
    }
}