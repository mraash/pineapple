<?php

namespace app\general\libraries\Routing;

/**
 * Url path in Router::add() method can contain special items ('{name|(regex)}').
 *   This is a class for them.
 * 
 * @package app\general\libraries\Routing
 * 
 * @internal
 */
class RouteSpecialItem
{
    private const NAME_AND_REGEX_SEPARATOR = '|';

    /** @var string */
    private $name;

    /** @var string */
    private $regex;


    public function __construct($item)
    {
        $item    = preg_replace('/^{/', '', $item);
        $item    = preg_replace('/}$/', '', $item);
        $splited = explode(self::NAME_AND_REGEX_SEPARATOR, $item);

        $this->name  = $splited[0];

        if (count($splited) > 1) {
            $splited[0]  = '';
            $this->regex = implode('', $splited);
        }
    }


    public function matches(string $realItem) : bool
    {
        if (!$this->regex) {
            return true;
        }

        return preg_match($this->regex, $realItem);
    }


    public function getName()
    {
        return $this->name;
    }


    public static function isItemSpecial(string $item) : bool
    {
        return preg_match('/^{.+}$/', $item);
    }
}
