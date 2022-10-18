<?php

declare(strict_types=1);

namespace Mad\Application;

use Mad\Router\Router;
use Mad\Router\RouterFactory;
use Mad\Traits\SystemTrait;
use Mad\Yaml\YamlConfig;

class Application
{

    /**
     * @var string
     */
    protected string $appRoot;


    /**
     * @var array
     */
    protected array $options = [];


    /**
     * Main class constructor
     *
     * @param string $appRoot
     */
    public function __construct(string $appRoot)
    {
        $this->appRoot = $appRoot;
    }


    /**
     * A method for Execution at application level
     *
     * @return self
     */
    public function run(): self
    {
        $this->constants();
        if (version_compare($phpVersion = PHP_VERSION, $coreVersion = Config::MAD_MIN_VERSION, '<'))
        {
            die(sprintf('You are running PHP %s, but the core framework requires at least PHP %s', $phpVersion, $coreVersion));
        }

        $this->environment();
        $this->errorHandler();

        return $this;
    }


    /**
     * A method to define framework and application directory constants
     *
     * @return void
     */
    private function constants(): void
    {
        defined('DS') or define('DS', '/');
        defined('APP_ROOT') or define('APP_ROOT', $this->appRoot);
        defined('CONFIG_PATH') or define('CONFIG_PATH', APP_ROOT . DS . 'Config');
        defined('TEMPLATE_PATH') or define('TEMPLATE_PATH', APP_ROOT . DS . 'App/templates');
        defined('LOG_DIR') or define('LOG_DIR', APP_ROOT . DS . 'tmp/log');
    }


    /**
     * A method to set framework and application settings
     *
     * @return void
     */
    private function environment()
    {
        ini_set('default_charset', 'UTF-8');
    }


    /**
     * A method to convert PHP errors to exceptions and to set a custom
     * exception handler which will allow us to take control of error handling 
     * sothat we can display errors in a customizable way.
     *
     * @return void
     */
    private function errorHandler(): void
    {

        error_reporting(E_ALL | E_STRICT);
        set_error_handler('Mad\ErrorHandling\ErrorHandling::errorHandler');
        set_exception_handler('Mad\ErrorHandling\ErrorHandling::exceptionHandler');
    }


    public function setSession()
    {
        SystemTrait::sessionInit(true);
        return $this;
    }

    public function setRouteHandler(string $url = null, array $routes = []): self
    {
        $url = ($url) ? $url : $_SERVER['QUERY_STRING'];
        $routes = ($routes) ? $routes : YamlConfig::file('routes');

        $factory = new RouterFactory($url, $routes);
        $factory->create(Router::class)->buildRoutes();
        return $this;
    }
}