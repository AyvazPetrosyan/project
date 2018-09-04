<?php
namespace bundle\htmlTableBundle;

/*
    $tableInfo = [
        ['value-1', 'value-2', ..., 'value-n'],
        ['value-1', 'value-2', ..., 'value-n'],
        .
        .
        .
        ['value-1', 'value-2', ..., 'value-n']
    ];

    $tableStyleList = [
        'background-color'=>'red',
        'border'=>'1px solid black'
    ];
*/

class HtmlTable {

    private $tableClass = '';

    private $tableInfoList = [];

    private $formAction = '';

    private $formMethod = '';

    public $tableStyleList = [];

    public $isDynamic = false;

    public $tableForm = NULL;

    public function __construct($tableClass, $tableInfoList, $formAction='', $formMethod='post')
    {
        $this->tableClass = $tableClass;
        $this->tableInfoList = $tableInfoList;
        if($this->isDynamic){
            $this->formAction = $formAction;
            $this->formMethod = $formMethod;
        }
    }

    public function printTable()
    {
        $class = $this->tableClass;
        $tableInfo = $this->tableInfoList;

        echo "<table class='$class' >";
            foreach ($tableInfo as $infoListKey=>$infoList) {
                if($infoListKey == 0){
                    echo "<tr>";
                        foreach ($infoList as $infoKey=>$infoVal){
                            echo "<th>";
                                echo "<span class='info-value'>$infoVal</span>";
                            echo "</th>";
                        }
                        if($this->isDynamic){
                            echo "<th>ջնջել</th>";
                        }
                    echo "</tr>";
                } else {
                    echo "<tr>";
                        foreach ($infoList as $infoKey=>$infoVal){
                            echo "<td>";
                                echo "<span class='info-value'>$infoVal</span>";
                            echo "</td>";
                        }
                        if($this->isDynamic){
                            echo "<td><a href=''>ջնջել</a></td>";
                        }
                    echo "</tr>";
                }
            }
            if($this->isDynamic){
                $action = $this->formAction;
                $method = $this->formMethod;
                echo "<tr>";
                    if(empty($this->tableForm)) {
                        echo "<form method='$method' action='$action'>";
                            foreach ($tableInfo[0] as $infoKey => $infoVal) {
                                echo "<td><input type='text' name=$infoKey.'_name' placeholder='$infoVal' required='required'></td>";
                            }
                            echo "<td><button type='submit' >ավելացնել</button></td>";
                        echo "</form>";
                    } else {
                        echo $this->tableForm;
                    }
                echo "</tr>";
            }
        echo "</table>";
    }
}