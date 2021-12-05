<?php

namespace app\admin\libraries\CSV;


/**
 * Class for making string in csv format. It doesn't work on files, only on
 *   input arrays and output string
 */
class CsvTable
{
    /** @var string[]  Array of heading cells */
    private $header;

    /** @var array[]  Array of rows */
    private $body;
    
    /** @var int  Length of single row */
    private $length;

    /** @var string  Cells separator */
    private $separator;


    public function __construct(array $headingCells, string $separator = ',')
    {
        $this->header    = $headingCells;
        $this->body      = [];
        $this->length    = count($headingCells);
        $this->separator = $separator;
    }


    public function addRow(array $row) : void
    {
        array_push($this->body, $row);
    }


    public function addRows(array $rows) : void
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }
    }


    public function toString() : string
    {
        $result = $this->makeRowString($this->header);

        foreach ($this->body as $row) {
            $result .= "\n{$this->makeRowString($row)}";
        }

        return $result;
    }


    private function makeRowString(array $row) : string
    {
        $resultRow = [];

        foreach ($row as $i => $cell) {
            $resultRow[$i] = $this->makeCellString($cell);
        }

        return implode($this->separator, $resultRow);
    }


    private function makeCellString($cell) : string
    {
        $resultCell = $cell;

        if (strpos($cell, $this->separator) !== false) {
            $resultCell = str_replace("\"", "\"\"", $cell);
            $resultCell = "\"{$resultCell}\"";
        }

        return $resultCell;
    }
}
