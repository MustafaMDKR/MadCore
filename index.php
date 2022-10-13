<?php

use Mad\Application\Application;

defined('ROOT_DIR') or define('ROOT_DIR', realpath(dirname(__FILE__)));

$autoload = ROOT_DIR . '/vendor/autoload.php';
if (is_file($autoload)) {
    require $autoload;
}

$app = new Application(ROOT_DIR);


$app
    ->run()
    ->setSession();