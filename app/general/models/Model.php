<?php

namespace app\general\models;

use app\general\utilities\Databases\MainDatabase;

class Model
{
    /** @var MainDatabase */
    protected $db;


    public function __construct()
    {
        $this->db = MainDatabase::getInstance();
    }
}
