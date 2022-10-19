<?php

declare(strict_types=1);

namespace App\Model;

use Mad\Abstracts\AbstractBaseModel;

class UserModel extends AbstractBaseModel
{

    /** @var string */
    protected const TABLESCHEMA = 'users';

    /** @var string */
    protected const TABLESCHEMAID = 'id';


    /**
     * Main constructor class which passes the relevant arguments to the 
     * base model parent constructor. This allows the repository to fetch the
     * correct information from the database based on the model/entity.
     * 
     * @throws BaseInvalidArgException
     * @return void
     */
    public function __construct()
    {
        parent::__construct(self::TABLESCHEMA, self::TABLESCHEMAID);
    }


    /**
     * @inheritDoc
     *
     * @return array
     */
    public function guardedID(): array
    {
        return [];
    }
}
