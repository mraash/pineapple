<?php

namespace app\general\libraries\SqlBuilder;

/**
 * @package app\general\libraries\SqlBuilder
 * 
 * @internal
 */
abstract class SqlString
{
    public abstract function getString() : string;
}
