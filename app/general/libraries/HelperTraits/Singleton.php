<?php

namespace app\general\libraries\HelperTraits;

/**
 * @package app\general\libraries\HelperTraits
 */
trait Singleton
{
    private static $instance;

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (!(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    } 
}
