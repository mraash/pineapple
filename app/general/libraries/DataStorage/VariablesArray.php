<?php

namespace app\general\libraries\DataStorage;

use Exception;

/**
 * Class wrapper for array
 * 
 * It is needed to avoid problems with accidental rewriting of array items.
 * 
 * @package app\general\libraries\DataStorage
 */
class VariablesArray
{
    /** @var array */
    private $variables = [];


    public function set(string $name, $value) : void
    {
        if (isset($this->variables[$name])) {
            throw new Exception("Trying to rewrite '{$name}' variable");
        }

        $this->variables[$name] = $value;
    }


    public function isset(string $name) : bool
    {
        return isset($this->variables[$name]);
    }


    public function rewrite(string $name, $newValue) : void
    {
        if (!$this->isset($name)) {
            throw new Exception("Trying to rewrite non existing variable '{$name}'");
        }

        $this->variables[$name] = $newValue;
    }


    public function remove(string $name)
    {
        unset($this->variables[$name]);
    }

 
    public function get(string $name)
    {
        return $this->variables[$name] ?? null;
    }


    public function getAll() : array
    {
        return $this->variables;
    }
}
