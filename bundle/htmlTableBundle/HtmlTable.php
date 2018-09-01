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

    private $tableInfoList = [

    ];

    private $formAction = '';

    public $tableStyleList = [

    ];

    public $hasBorder = true;

    public $isDynamic = false;

    public function __construct($tableClass, $tableInfoList, $formAction='')
    {
        $this->tableClass = $tableClass;
        $this->tableInfoList = $tableInfoList;
        if($this->isDynamic){
            $this->formAction = $formAction;
        }
    }

    public function printTable()
    {
        $class = $this->tableClass;
        $tableInfo = $this->tableInfoList;
        $styleText = $this->generateStyleText();
        $hasBorder = $this->hasBorder;

        $border = '';
        if($hasBorder){
            $border = "border: 1px solid black;";
        }

        echo "<table class='$class' style='$styleText' >";
            foreach ($tableInfo as $infoListKey=>$infoList) {
                if($infoListKey == 0){
                    echo "<tr style='$border'>";
                        foreach ($infoList as $infoKey=>$infoVal){
                            echo "<th style='$border'>";
                                echo "<span class='info-value'>$infoVal</span>";
                            echo "</th>";
                        }
                    echo "</tr>";
                } else {
                    echo "<tr style='$border'>";
                        foreach ($infoList as $infoKey=>$infoVal){
                            echo "<td style='$border'>";
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
                echo "<tr>";
                    echo "<form method='post' action='$action'>";
                        foreach ($tableInfo[0] as $infoKey=>$infoVal) {
                                echo "<td><input type='text' name=$infoKey.'_name' placeholder='$infoVal' required='required'></td>";
                        }
                        echo "<td><button type='submit' >ավելացնել</button></td>";
                    echo "</form>";
                echo "</tr>";
            }
        echo "</table>";
    }

    private function generateStyleText()
    {
        $styleText = '';
        $tableStyleList = $this->tableStyleList;

        if(count($tableStyleList)>0) {
            foreach ($tableStyleList as $optsName => $optsVal) {
                $styleText .= "$optsName: $optsVal; ";
            }
        }

        return $styleText;
    }
}