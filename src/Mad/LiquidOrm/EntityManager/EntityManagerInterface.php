<?php

declare(strict_types=1);

namespace Mad\LiquidOrm\EntityManager;

interface EntityManagerInterface
{
  public function getCrud(): Object;
}