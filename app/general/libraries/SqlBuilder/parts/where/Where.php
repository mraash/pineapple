<?php

namespace app\general\libraries\SqlBuilder\parts\where;

/**
 * @package app\general\libraries\SqlBuilder
 * 
 * @internal
 */
class Where
{
    /** @var array */
    private $list = [];


    public function isset() : bool
    {
        return !empty($this->list);
    }


    public function addCondition(string $condition) : void
    {
        array_push($this->list, $condition);
    }


    public function addConditionByOr(string $condition) : void
    {
        if ($this->canPushALogicalOperand()) {
            array_push($this->list, "OR");
        }

        array_push($this->list, $condition);
    }


    public function addConditionByAnd(string $condition) : void
    {
        if ($this->canPushALogicalOperand()) {
            array_push($this->list, "AND");
        }

        array_push($this->list, $condition);
    }


    public function startBlock() : void
    {
        array_push($this->list, '(');
    }


    public function endBlock() : void
    {
        array_push($this->list, ')');
    }


    public function startBlockByOr() : void
    {
        if ($this->canPushALogicalOperand()) {
            array_push($this->list, 'OR');
        }

        array_push($this->list, '(');
    }


    public function startBlockByAnd() : void
    {
        if ($this->canPushALogicalOperand()) {
            array_push($this->list, 'AND');
        }

        array_push($this->list, '(');
    }


    public function getString() : string
    {
        if (!$this->isset()) {
            return '';
        }

        $list = implode(' ', $this->list);

        return "WHERE {$list}";
    }


    private function canPushALogicalOperand() : bool
    {
        return
            $this->isset() &&
            !$this->isLastAnOpeningBracket() &&
            !$this->isLastALogicalOperand()
        ;
    }


    private function isLastAnOpeningBracket() : bool
    {
        $last = $this->list[count($this->list) - 1];
        $last = rtrim($last, "\n");

        return preg_match('/[(]$/', $last);
    }


    private function isLastALogicalOperand() : bool
    {
        $last = $this->list[count($this->list) - 1];
        $last = rtrim(strtolower($last));

        return preg_match('/(and|or)$/', $last);
    }
}
