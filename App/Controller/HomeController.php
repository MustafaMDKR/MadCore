<?php

declare(strict_types=1);

namespace App\Controller;

use Mad\Base\BaseController;

class HomeController extends BaseController
{

    public function __construct($routeParams)
    {
        parent::__construct($routeParams);
    }

    public function indexAction()
    {
        echo 'HomeController';
    }
}