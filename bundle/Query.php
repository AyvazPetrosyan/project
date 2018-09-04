<?php
namespace bundle;

use bundle\Connect;
use engine\Bundle;

class Query extends Bundle{

	private $connect = NULL;

	public function __construct($sqlConfig)
	{
		$this->connect = new Connect($sqlConfig);
	}

	public function getAllFromTable($tableName)
	{
        $resultList = [];
		$sqlConnectToDb = $this->connect->sqlConnectToDb;
		$queryString = "SELECT * FROM $tableName";
		$queryResult = mysqli_query($sqlConnectToDb, $queryString);
		while ($result = mysqli_fetch_assoc($queryResult)) {
			$resultList[] = $result;
		}

		return $resultList;
	}

	/*
		$tabelName = 'table name
		$column = [
			'name' => 'column_name',
			'value' => 'column value'
		]

	*/
	public function getFromTable($tableName, array $column, $isResultList = true)
	{
		$sqlConnectToDb = $this->connect->sqlConnectToDb;
		$queryString = "SELECT * FROM $tableName WHERE " . $column['name'] . "=" . $column['value'];
		$queryResult = mysqli_query($sqlConnectToDb, $queryString);

		if($isResultList){
			$queryResult = mysqli_fetch_assoc($queryResult);
		}

		return $queryResult;
	}

	/*
		$tabelName = 'table name'
		$insertList = [
			'columnName' => 'column value'
		]
	*/
	public function addIntoTable($tableName, array $insertList)
	{
		$sqlConnectToDb = $this->connect->sqlConnectToDb;
		$columnNameList = "";
		$columnValueList = "";
		$index = 0;
		foreach ($insertList as $columnName => $columnValue) {
			if($index+1 < count($insertList)){
				$columnNameList .= "`" . $columnName . "`,";
				$columnValueList .=  "'" . $columnValue . "',";
            } else {
                $columnNameList .= "`" . $columnName . "`";
				$columnValueList .= "'" . $columnValue . "'";
            }
			$index++;
		}
		$queryString = "INSERT INTO `$tableName` ($columnNameList) VALUES ($columnValueList)";
		$queryResult = mysqli_query($sqlConnectToDb, $queryString);

		return $queryResult;
	}

	/*
		$tabelName = 'table name'
		$deleteBy = [
			'columnName' => 'column value',
			.
			.
			.
			.
			'columnName' => 'column value'
		]
	*/
	public function deleteFromTable($tableName, array $column)
	{
		$sqlConnectToDb = $this->connect->sqlConnectToDb;
		$queryString="DELETE FROM $tableName ";
		$step = 1;
		foreach ($column as $columnName=> $columnValue) {
			if($step==1){
				$queryString .= "WHERE $columnName=$columnValue ";
			} else {
				$queryString .= "OR $columnName=$columnValue ";
			}
			$step++;
		}
		$queryResult = mysqli_query($sqlConnectToDb, $queryString);
		
		return $queryResult;
	}

	public function setIntoTable()
	{

	}
}