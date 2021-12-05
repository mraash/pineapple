<?php

namespace app\general\utilities\Databases;

use app\general\libraries\HelperTraits\Singleton;
use app\general\libraries\Database\Database;


class MainDatabase extends Database
{
    use Singleton;

    private const HOST     = DB_HOST;
    private const USER     = DB_USER;
    private const PASSWORD = DB_PASS;
    private const NAME     = DB_NAME;


    public function __construct()
    {
        parent::__construct(self::HOST, self::USER, self::PASSWORD, self::NAME);
    }
}
