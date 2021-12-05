<?php

namespace app\general\libraries\SqlBuilder\parts\limit;

/**
 * @package app\general\libraries\SqlBuilder
 * 
 * @internal
 */
class Limit
{
    /** @var int */
    private $offset;

    /** @var int */
    private $count;


    public function setOffset($offset) : void
    {
        $this->offset = $offset;
    }


    public function setCount($offset) : void
    {
        $this->count = $offset;
    }


    public function isset() : bool
    {
        return isset($this->offset) || isset($this->count);
    }


    public function unset() : void
    {
        unset($this->offset);
        unset($this->count);
    }


    public function getString() : string
    {
        if (!$this->isset()) {
            return '';
        }

        $result = "LIMIT";

        if (isset($this->offset)) {
            $result .= ' ' . $this->offset;

            if (isset($this->count)) {
                $result .= ', ' . $this->count;
            }
        }
        else {
            $result .= ' ' . $this->count;
        }

        return $result;
    }
}
