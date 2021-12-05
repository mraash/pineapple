<?php

namespace app\general\libraries\SqlBuilder\parts\limit;

use app\general\libraries\SqlBuilder\parts\limit\Limit;

/**
 * @package app\general\libraries\SqlBuilder
 * 
 * @internal
 */
trait LimitTrait
{
    /** @var Limit */
    private $limitPart;


    public function __construct()
    {
        $this->limitPart = new Limit();
    }


    public function setLimit($count, $offset) : self
    {
        $this->limitPart->setCount($count);
        $this->limitPart->setOffset($offset);

        return $this;
    }


    public function setLimitsCount($count) : self
    {
        $this->limitPart->setCount($count);

        return $this;
    }


    public function setLimitsOffset($offset) : self
    {
        $this->limitPart->setOffset($offset);

        return $this;
    }


    public function removeLimit() : self
    {
        $this->limitPart->unset();

        return $this;
    }
}
