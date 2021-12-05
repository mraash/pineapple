<?php

namespace app\general\libraries\Database;

use PDO;
use PDOStatement;
use PDOException;
use app\general\libraries\Database\exceptions\DbConnectionException;
use app\general\libraries\Database\exceptions\DbQueryException;


/**
 * Class wrapper for PDO MySQLi or something like that
 * 
 * @package app\general\libraries\Database
 */
class Database
{
    /** @var PDO */
    private $pdo;

    /**
     * @throws DbConnectionException
     */
    public function __construct(string $host, string $user, string $password, string $name)
    {
        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        $dsn = "mysql:host={$host};dbname={$name}";

        try {
            $this->pdo = new PDO($dsn, $user, $password, $options);
        }
        catch (PDOException $err) {
            throw new DbConnectionException($err->getMessage(), $err->getCode(), $err);
        }
    }

    /**
     * @throws DbQueryException
     */
    public function query(string $sql, array $variables = []) : void
    {
        $this->makeQuery($sql, $variables);
    }

    /**
     * Method for INSERT queries
     * 
     * @throws DbQueryException
     * 
     * @return int  Primary key of inserting row
     */
    public function createRow(string $sql, array $variables = [], string $primaryKey = 'id') : int
    {
        $sth = $this->makeQuery($sql, $variables);

        return $this->pdo->lastInsertId($primaryKey);
    }

    /**
     * Method for SELECT queries
     * 
     * @throws DbQueryException
     * 
     * @return array  An array of table rows
     */
    public function getTable(string $sql, array $variables = []) : array
    {
        $sth = $this->makeQuery($sql, $variables);

        return $sth->fetchAll();
    }

    /**
     * Method for SELECT queries
     * 
     * @throws DbQueryException
     * 
     * @return array  An array of table single row
     */
    public function getTableRow(string $sql, array $variables = []) : array
    {
        $sth = $this->makeQuery($sql, $variables);

        return $sth->fetch();
    }

    /**
     * Method for SELECT queries
     * 
     * It is useful when you only need to get one cell from each row
     * 
     * @throws DbQueryException
     * 
     * @return array  An array of table rows
     */
    public function getTableColumn(string $sql, array $variables = []) : array
    {
        $sth = $this->makeQuery($sql, $variables);

        $column = [];

        while($item = $sth->fetchColumn()) {
            array_push($column, $item);
        }

        return $column;
    }

    /**
     * Method for SELECT queries
     * 
     * @throws DbQueryException
     * 
     * @return mixed  Single table row cell
     */
    public function getTableCell(string $sql, array $variables = [])
    {
        $sth = $this->makeQuery($sql, $variables);

        return $sth->fetchColumn();
    }

    /**
     * Getting PDOStatement is same in all methods, so It's putted in seperate method
     * 
     * @throws DbQueryException
     * 
     * @return PDOStatement
     */
    private function makeQuery(string $sql, array $variables) : PDOStatement
    {
        $sth = $this->pdo->prepare($sql);

        if ($sth === false) {
            $errorInfo = $this->pdo->errorInfo();
            throw new DbQueryException($errorInfo[2], $errorInfo[1]);
        }

        $sth->execute($variables);

        return $sth;
    }
}
