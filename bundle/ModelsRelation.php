<?php
namespace bundle;

class ModelsRelation {

    private $modelEntity = null;

    private $tableName = null;

    public function __construct($modelInfo)
    {
        $this->modelEntity = $modelInfo['modelEntity'];
        $this->tableName = $modelInfo['tableName'];
    }

    public function set()
    {
        $modelEntityInfoList = iterator_to_array($this->modelEntity);
        $columns = '';
        $values = '';
        foreach($modelEntityInfoList as $entityKey => $modelEntityInfo){
            $columns += $modelEntityInfo+", ";
        }
        $sql = "INSERT INTO $this->tableName ($columns) VALUES (1, 2)";
    }

    public function getById()
    {

    }

    public function getBy()
    {

    }
}