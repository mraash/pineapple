<?php

namespace app\general\libraries\SqlBuilder\parts\groupBy;

use app\general\libraries\SqlBuilder\parts\groupBy\GroupBy;

trait GroupByTrait
{
    /** @var GroupBy */
    private $groupByPart;


    public function __construct()
    {
        $this->groupByPart = new GroupBy();
    }

    public function setGroupBy(string $table) : self
    {
        $this->groupByPart->set($table);

        return $this;
    }

    public function removeGroupBy() : self
    {
        $this->groupByPart->unset();

        return $this;
    }
}
