<?php

declare(strict_types=1);

namespace Mad\Abstracts;

use Mad\Base\BaseModel;

abstract class AbstractBaseModel extends BaseModel
{

    /**
     * A method to prevent operations for some IDs e.g. delete all user except ...
     *
     * @return array
     */
    abstract public function guardedID(): array;
}