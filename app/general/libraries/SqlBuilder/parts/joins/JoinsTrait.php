<?php

namespace app\general\libraries\SqlBuilder\parts\joins;

use app\general\libraries\SqlBuilder\parts\joins\Joins;

trait JoinsTrait
{
    /** @var Joins */
    private $joinsPart;


    public function __construct()
    {
        $this->joinsPart = new Joins();
    }


    public function addInnerJoin(string $table, string $condition) : self
    {
        $this->joinsPart->addInner($table, $condition);

        return $this;
    }


    public function addLeftJoin(string $table, string $condition) : self
    {
        $this->joinsPart->addLeft($table, $condition);

        return $this;
    }


    public function addRightJoin(string $table, string $condition) : self
    {
        $this->joinsPart->addRight($table, $condition);

        return $this;
    }
}
