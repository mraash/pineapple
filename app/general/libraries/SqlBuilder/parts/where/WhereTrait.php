<?php

namespace app\general\libraries\SqlBuilder\parts\where;

use app\general\libraries\SqlBuilder\parts\where\Where;

/**
 * @package app\general\libraries\SqlBuilder
 * 
 * @internal
 */
trait WhereTrait
{
    /** @var Where */
    private $wherePart;


    public function __construct()
    {
        $this->wherePart = new Where();
    }

    /**
     * Adds string to the where part
     * 
     * @param string $condition  String to add
     */
    public function addWhereCondition(string $conditions) : self
    {
        $this->wherePart->addCondition($conditions);

        return $this;
    }

    /**
     * Adds string to the where part. If it is posible will add 'OR' before this string
     * 
     * @param string $condition  String to add
     */
    public function addWhereConditionByOr(string $conditions) : self
    {
        $this->wherePart->addConditionByOr($conditions);

        return $this;
    }

    /**
     * Adds string to the where part. If it is posible will add 'AND' before this string
     * 
     * @param string $condition  String to add
     */
    public function addWhereConditionByAnd(string $conditions) : self
    {
        $this->wherePart->addConditionByAnd($conditions);

        return $this;
    }

    /**
     * Adds '(' to the where part
     */
    public function startWhereBlock() : self
    {
        $this->wherePart->startBlock();

        return $this;
    }

    /**
     * Adds ')' to the where part
     */
    public function endWhereBlock() : self
    {
        $this->wherePart->endBlock();

        return $this;
    }

    /**
     * Adds '(' to the were part. If it is posible will add 'AND' before that
     */
    public function startWhereBlockByAnd() : self
    {
        $this->wherePart->startBlockByAnd();

        return $this;
    }

    /**
     * Adds '(' to the were part. If it is posible will add 'OR' before that
     */
    public function startWhereBlockByOr() : self
    {
        $this->wherePart->startBlockByOr();

        return $this;
    }
}
