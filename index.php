<?php

use Mad\Application\Application;

defined('ROOT_PATH') or define('ROOT_PATH', realpath(dirname(__FILE__)));

$autoload = ROOT_PATH . '/vendor/autoload.php';
if (is_file($autoload)) {
    require $autoload;
}

$filename = __DIR__ . preg_replace( '#(\?.*)$#', '', $_SERVER['REQUEST_URI'] );
if ( php_sapi_name() == 'cli-server' && is_file( $filename ) ) {
    return false;
}

$app = new Application(ROOT_PATH);
// echo '<pre>';
// var_dump($_SERVER['REQUEST_URI']);
// echo '<pre>';
// exit;
$app
    ->run()
    ->setSession()
    ->setRouteHandler();