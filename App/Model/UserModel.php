<?php

declare(strict_types=1);

namespace App\Model;

use Mad\Abstracts\AbstractBaseModel;

class UserModel extends AbstractBaseModel
{

    protected const TABLESCHEMA = 'users';

    protected const TABLESCHEMAID = 'id';

    public function __construct()
    {
        parent::__construct(self::TABLESCHEMA, self::TABLESCHEMAID);
    }


    public function guardedID(): array
    {
        return [];
    }
}
