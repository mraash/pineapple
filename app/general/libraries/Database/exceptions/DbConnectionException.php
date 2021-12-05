<?php

namespace app\general\libraries\Database\exceptions;

use PDOException;

/**
 * @package app\general\libraries\Database
 */
class DbConnectionException extends PDOException
{
    public function __construct(string $message, int $code) {
        parent::__construct($message, $code);
    }
}
