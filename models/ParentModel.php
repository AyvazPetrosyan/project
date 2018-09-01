<?php
namespace models;

use engine\Project;

class ParentModel extends Project {

    protected $sqlConnectToDb;

    public function __construct($sqlConnectToDb)
    {
        $this->sqlConnectToDb = $sqlConnectToDb;
    }
}