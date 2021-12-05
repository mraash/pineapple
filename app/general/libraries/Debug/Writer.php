<?php

namespace app\general\libraries\Debug;

/**
 * My ugly code from old projects for debugging
 * 
 * Please don't try to understand how it works. You just need to include 'write.php'
 *   file (in this folder) and then you can use write($var [, ...]) function 
 */
class AAAAAAAAAAA
{
    const COLORS = [
        'string' => '#BD2403',
        'integer' => '#043FAF',
        'double' => '#043FAF',
        'boolean' => '#00750F',
        'NULL' => 'grey',
        'other' => '#660',
    ];

    const KEY_COLOR = '#444';
    const SEPARATOR_COLOR = '#aaa';
    const QUOTE_COLOR = '#aaa';


    const SEPARATORS = [
        'array' => ' => ',
        'object' => ' -> '
    ];

    const QUOTES = [
        'array' => ['[', ']'],
        'object' => ['{', '}'],
    ];

    const LEFT_SPACE = '    ';
    const LINE_BREAK = "\n";


    public static function write($args, $options = [])
    {
        echo '<pre style="border: 1px solid #eee; padding: 10px">';

        echo self::getHeader();

        foreach ($args as $val) {
            echo "\n";
            echo '--> ';
            echo self::getFormated($val, '', $options);
            echo "\n";
        }

        echo '</pre>';
    }


    private static function getHeader()
    {
        $domain = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);

        $debug_b = debug_backtrace()[2];

        $line = $debug_b['line'];
        $path = ltrim(
            str_replace(
                $domain, '', 
                str_replace('\\', '/', 
                    $debug_b['file']
                )
            ), 
            '/'
        );

        return "<b>{$path}</b>::<b>{$line}</b> \n";
    }

    public static function getFormated($val, $left = '', $options = [])
    {
        $isColumn = $options['isColumn'] ?? true;
        $inBrowser = $options['inBrowser'] ?? true;

        $type = gettype($val);

        if ($type !== 'array' && $type !== 'object') {
            return self::makeVal($val, $inBrowser);
        }

        if (empty($val)) {
            $q = self::QUOTES;
            return 
                self::makeQuote($q[$type][0], $inBrowser) .
                self::makeQuote($q[$type][1], $inBrowser);
        }

        if ($isColumn) {
            $maxK = 0;

            foreach ($val as $k => $v) {
                if (strlen($k) > $maxK) {
                    $maxK = strlen($k);
                }
            }
        }


        $result = self::makeQuote(self::QUOTES[$type][0], $inBrowser);
        $newLeft = $left . self::LEFT_SPACE;

        for (reset($val); list($k, $v) = @each($val); ) {
            if ($val === $v) {
                $result .= self::LINE_BREAK . $newLeft . 'selflink';
                continue;
            }

            if ($isColumn) {
                for ($i = strlen($k); $i < $maxK; $i++) {
                    $k .= ' ';
                }
            }

            $result .= self::LINE_BREAK;
            $result .= $newLeft;
            $result .= self::makeKey($k, $inBrowser);
            $result .= self::makeSep(self::SEPARATORS[$type], $inBrowser);
            $result .= self::getFormated($v, $newLeft, $options);
        }

        $result .= 
            self::LINE_BREAK .
            $left .
            self::makeQuote(self::QUOTES[$type][1], $inBrowser)
        ;

        return $result;
    }


    private static function makeVal($val, $inBrowser = true)
    {
        $type  = gettype($val);

        if ($type === 'boolean') {
            $val = $val ? 'true' : 'false';
        }
        if ($type === 'NULL') {
            $val = 'null';
        }
        if ($type === 'string') {
            $val = "'{$val}'";
        }


        $color = self::COLORS[$type] ?? null;

        if (!isset($color)) {
            $color = self::COLORS['other'];
            $val = ucfirst(gettype($val));
        }


        if (!$inBrowser) {
            return $val;
        }


        $val = htmlspecialchars($val);

        return "<span style='color:{$color}'>{$val}</span>";
    }

    private static function makeKey($k, $inBrowser = true)
    {
        if (!$inBrowser) {
            return $k;
        }

        $k = htmlspecialchars($k);

        $color = self::KEY_COLOR;

        return "<span style='color:{$color}'>{$k}</span>";
    }

    private static function makeSep($sep, $inBrowser = true)
    {
        if (!$inBrowser) {
            return $sep;
        }

        $color = self::SEPARATOR_COLOR;
        return "<span style='color:{$color}'>$sep</span>";
    }

    private static function makeQuote($q, $inBrowser = true)
    {
        if (!$inBrowser) {
            return $q;
        }

        $color = self::QUOTE_COLOR;
        return "<span style='color:{$color}'>$q</span>";
    }
}