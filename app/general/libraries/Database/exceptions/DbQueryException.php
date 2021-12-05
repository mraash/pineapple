<?php

namespace app\general\libraries\Database\exceptions;

use PDOException;

/**
 * @package app\general\libraries\Database
 */
class DbQueryException extends PDOException
{
    public function __construct(string $message, int $mysqlCode)
    {
        parent::__construct($message, $mysqlCode);
    }
}
