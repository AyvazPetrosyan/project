<?php
namespace bundle\breadBundle;

use bundle\Query;
use engine\Bundle;

class Bread extends Bundle {

    private $sqlConfig = null;

    private $breadTableName = 'breads';

    public function __construct($sqlConfig)
    {
        $this->sqlConfig = $sqlConfig;
    }

    public function getBreads()
    {
        $query = new Query($this->sqlConfig);
        $breadsList = $query->getAllFromTAble($this->breadTableName);

        return $breadsList;
    }

    public function getBreadById()
    {

    }
}