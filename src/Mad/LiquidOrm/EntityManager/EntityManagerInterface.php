<?php

declare(strict_types=1);

namespace Mad\LiquidOrm\EntityManager;

interface EntityManagerInterface
{

    /**
     * A method to get the crud object which will expose all the 
     * methods within our crud class.
     *
     * @return object
     */
    public function getCrud(): object;
}
