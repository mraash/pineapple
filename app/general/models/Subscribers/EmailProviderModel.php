<?php

namespace app\general\models\Subscribers;

use app\general\models\Model;

/**
 * @package app\general\models\Subscribers
 * 
 * @internal
 */
class EmailProviderModel extends Model
{
    /** @var int */
    private $id;

    /** @var int */
    private $name;


    public function __construct(string $name)
    {
        parent::__construct();

        $id = $this->db->getTableCell('
            SELECT `id` FROM `email_providers` WHERE `name` = ?
        ', [ $name ]);

        $this->id   = $id;
        $this->name = $name;
    }


    public function getId()
    {
        return $this->id;
    }


    public function doesExists() : bool
    {
        return is_int($this->id);
    }


    public function createIfNotExist() : void
    {
        if ($this->doesExists()) {
            return;
        }

        $sql = "INSERT INTO `email_providers` (`name`) VALUES (?)";

        $newId = $this->db->createRow($sql, [ $this->name ]);

        $this->id = $newId;
    }
}
