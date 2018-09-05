<?php
namespace bundle;

use engine\Project;

class TablesGenerator extends Project {
    private $hostName;

    private $userName;

    private $password;

    private  $dbName;

    private $tables = [
        "senders"=>[
            'id INT(5) NOT NULL AUTO_INCREMENT',
            'order_number VARCHAR(20)',
            'name VARCHAR(20)',
            'PRIMARY KEY(id)'
        ],

        'breads'=>[
            'id INT(5) NOT NULL AUTO_INCREMENT',
            'order_number VARCHAR(20)',
            'name VARCHAR(20)',
            'PRIMARY KEY(id)'
        ],

        'senders_breads_relation'=>[
            'id INT(5) NOT NULL AUTO_INCREMENT',
            'sender_id INT(5)',
            'bread_id INT(5)',
            'price int(5)',
            'PRIMARY KEY(id)'
        ]
    ];

    public function __construct($sqlConfig)
    {
        $this->hostName = $sqlConfig['host'];
        $this->userName = $sqlConfig['user'];
        $this->password = $sqlConfig['password'];
        $this->dbName   = $sqlConfig['db'];
    }

    private function sqlConnect()
    {
        $hostName = $this->hostName;
        $userName = $this->userName;
        $password = $this->password;
        $sqlConnect = mysqli_connect($hostName, $userName, $password);
        return $sqlConnect;
    }

    private function sqlDbConnect()
    {
        $hostName = $this->hostName;
        $userName = $this->userName;
        $password = $this->password;
        $dbName = $this->dbName;
        $sqlDbConnect = mysqli_connect($hostName, $userName, $password, $dbName);
        return $sqlDbConnect;
    }

    public function createDB()
    {
        $sqlConnect = $this->sqlConnect();
        $dbName = $this->dbName;
        $dbSelect = mysqli_select_db($sqlConnect, $dbName);
        if($dbSelect){
            $this->dropDb();
        }
        $query = "CREATE DATABASE $dbName";
        $result = mysqli_query($sqlConnect, $query);
        return $result;
    }

    public function dropDb()
    {
        $sqlConnect = $this->sqlConnect();
        $dbName = $this->dbName;
        $query = "DROP DATABASE $dbName";
        $result = mysqli_query($sqlConnect, $query);
        return $result;
    }

    public function createTables()
    {
        $sqlDbConnect = $this->sqlDbConnect();
        $tableNameList = $this->tables;
        foreach($tableNameList as $tableName=>$tableInfo){
            $query = "CREATE TABLE $tableName (";
            foreach ($tableInfo as $key=>$columnInfo){
                if($key+1 < count($tableInfo)){
                    $query = $query.$columnInfo.", ";
                } else {
                    $query = $query.$columnInfo.")";
                }
            }
            mysqli_query($sqlDbConnect, $query);
        }
    }
}