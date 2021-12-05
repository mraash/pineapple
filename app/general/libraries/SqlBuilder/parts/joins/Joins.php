<?php

namespace app\general\libraries\SqlBuilder\parts\joins;

class Joins
{
    /** @var array */
    private $joins = [];


    public function addInner(string $table, string $condition) : void
    {
        array_push($this->joins, "INNER JOIN {$table} ON {$condition}");
    }


    public function addLeft(string $table, string $condition) : void
    {
        array_push($this->joins, "LEFT JOIN {$table} ON {$condition}");
    }


    public function addRight(string $table, string $condition) : void
    {
        array_push($this->joins, "RIGHT JOIN {$table} ON {$condition}");
    }


    public function isset() : bool
    {
        return !empty($this->joins);
    }


    public function getString(string $separator = ' ') : string
    {
        return implode($separator, $this->joins);
    }
}
