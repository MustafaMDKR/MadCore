<?php
declare(strict_types=1);

namespace Mad\Router;

use Mad\Router\Exception\RouterBadMethodCallException;
use Mad\Router\Exception\RouterException;
use Mad\Router\RouterInterface;

class Router implements RouterInterface
{
  /**
   * returns an array of route from our routing table
   *
   * @var array
   */
  protected array $routes = [];

  /**
   * returns an array of route parameters
   *
   * @var array
   */
  protected array $params = [];

  /**
   * Adds a suffix onto the controller name
   *
   * @var string
   */
  protected string $controllerSuffix = 'controller';

  /**
   * @inheritDoc
   */
  public function add(string $route, array $params = []): void
  {
    $route = preg_replace('/\//', '\\/', $route);
    $route = '/^' . $route . '$/i';


    $this->routes[$route] = $params;
  }

  /**
   * @inheritDoc
   */
  public function dispatch(string $url): void
  {
    $url = $this->formatQueryString($url);
    if ($this->match($url)) {
      $controllerString = $this->params['controller'] . $this->controllerSuffix;
      $controllerString = $this->transformUpperCamleCase($controllerString);
      $controllerString = $this->getNamespace($controllerString);

      if (class_exists($controllerString)) {
        $controllerObject = new $controllerString($this->params);
        $action = $this->params['action'];
        $action = $this->transformCamleCase($action);

        if (\is_callable([$controllerObject, $action])) {
          $controllerObject->$action();
        } else {
          throw new RouterBadMethodCallException();
        }

      } else {
        throw new RouterBadMethodCallException();
      }

    } else {
      throw new RouterBadMethodCallException();
    }
  }

  public function transformUpperCamleCase(string $string): string
  {
    return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
  }

  public function transformCamleCase(string $string): string
  {
    return \lcfirst($this->transformUpperCamleCase($string));
  }

  /**
   * Match the route to the routes in the routing table and setting 
   * the $this->params property if a route is found
   *
   * @param string $url
   * @return boolean
   */
  private function match(string $url): bool
  {
    foreach ($this->routes as $route => $params) {
      if (preg_match($route, $url, $matches)) {
        foreach ($matches as $key => $param) {
          if (is_string($key)) {
            $params[$key] = $param;
          }
        }
        $this->params = $params;
        return true;
      }
    }
    return false;
  }



  /**
   * Get the namespace of the controller class. The namespace difined within 
   * the route parameters only if it was added
   *
   * @param string $string
   * @return string
   */
  public function getNamespace(string $string): string
  {
    $namespace = 'App\Controller\\';
    if (array_key_exists('namespace', $this->params)) {
      $namespace .= $this->params['namespace'] . '\\';
    }
    return $namespace;
  }


  protected function formatQueryString($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return rtrim($url, '/');
    }

}