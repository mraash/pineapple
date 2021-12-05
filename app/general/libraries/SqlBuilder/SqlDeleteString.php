<?php

namespace app\general\libraries\SqlBuilder;

use app\general\libraries\SqlBuilder\parts\where\WhereTrait;

/**
 * @package app\general\libraries\SqlBuilder
 */
class SqlDeleteString extends SqlString
{
    use WhereTrait {
        WhereTrait::__construct as private __whereConstruct;
    }

    /** @var string */
    private $tableName;


    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;

        $this->__whereConstruct();
    }


    public function __clone()
    {
        $this->wherePart = clone $this->wherePart;
    }


    public function getString() : string
    {
        if (!$this->wherePart->isset()) {
            throw new \Exception('Delete sql should have some conditions');
        }

        $sql = "DELETE FROM {$this->tableName}";

        $sql .= "\n" . $this->wherePart->getString();

        return $sql;
    }
}
