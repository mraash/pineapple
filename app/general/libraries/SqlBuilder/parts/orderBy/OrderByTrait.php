<?php

namespace app\general\libraries\SqlBuilder\parts\orderBy;

use app\general\libraries\SqlBuilder\parts\orderBy\OrderBy;

trait OrderByTrait
{
    /** @var OrderBy */
    private $orderByPart;


    public function __construct()
    {
        $this->orderByPart = new OrderBy();
    }

    public function setOrderBy(string $table) : self
    {
        $this->orderByPart->set($table);

        return $this;
    }

    public function removeOrderBy() : self
    {
        $this->orderByPart->unset();

        return $this;
    }
}
