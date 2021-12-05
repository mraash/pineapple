<?php

namespace app\general\libraries\SqlBuilder;

use app\general\libraries\SqlBuilder\SqlString;
use app\general\libraries\SqlBuilder\parts\joins\JoinsTrait;
use app\general\libraries\SqlBuilder\parts\where\WhereTrait;
use app\general\libraries\SqlBuilder\parts\groupBy\GroupByTrait;
use app\general\libraries\SqlBuilder\parts\orderBy\OrderByTrait;
use app\general\libraries\SqlBuilder\parts\limit\LimitTrait;

/**
 * @package app\general\libraries\SqlBuilder
 */
class SqlSelectString extends SqlString
{
    use JoinsTrait, WhereTrait, LimitTrait, GroupByTrait, OrderByTrait {
        JoinsTrait::__construct as private __joinsConstruct;
        WhereTrait::__construct as private __whereConstruct;
        GroupByTrait::__construct as private __groupByConstruct;
        OrderByTrait::__construct as private __orderByConstruct;
        LimitTrait::__construct as private __limitConstruct;
    }

    /** @var string */
    private $tableName;

    /** @var string */
    private $columns;


    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;

        $this->__joinsConstruct();
        $this->__whereConstruct();
        $this->__groupByConstruct();
        $this->__orderByConstruct();
        $this->__limitConstruct();
    }


    public function __clone()
    {
        $this->joinsPart = clone $this->joinsPart;
        $this->wherePart = clone $this->wherePart;
        $this->groupByPart = clone $this->groupByPart;
        $this->orderByPart = clone $this->groupByPart;
        $this->limitPart = clone $this->limitPart;
    }


    public function setColumns(array $columns) : self
    {
        $this->columns = implode(', ', $columns);

        return $this;
    }


    public function getString() : string
    {
        if (!isset($this->columns)) {
            throw new \Exception('Columns are required');
        }

        $sql = "SELECT {$this->columns} FROM {$this->tableName}";

        if ($this->joinsPart->isset()) {
            $sql .= "\n" . $this->joinsPart->getString("  ");
        }

        if ($this->wherePart->isset()) {
            $sql .= "\n" . $this->wherePart->getString();
        }

        if ($this->groupByPart->isset()) {
            $sql .= "\n" . $this->groupByPart->getString();
        }

        if ($this->orderByPart->isset()) {
            $sql .= "\n" . $this->orderByPart->getString();
        }

        if ($this->limitPart->isset()) {
            $sql .= "\n" . $this->limitPart->getString();
        }

        return $sql;
    }
}
