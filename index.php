<?php

use Mad\Application\Application;

define('ROOT_DIR', realpath(dirname(__FILE__)));

$autoload = ROOT_DIR . '/vendor/autoload.php';
if (is_file($autoload)) {
    require $autoload;
}

(new Application(ROOT_DIR))->run();