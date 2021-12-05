<?php

namespace app\general\libraries\SqlBuilder\parts\orderBy;

class OrderBy
{
    /** @var string */
    private $table;

    
    public function set(string $table) : void
    {
        $this->table = $table;
    }

    public function isset() : bool
    {
        return isset($this->table);
    }

    public function unset() : void
    {
        unset($this->table);
    }

    public function getString() : string
    {
        if (!$this->isset()) {
            return '';
        }

        return "ORDER BY {$this->table}";
    }
}
