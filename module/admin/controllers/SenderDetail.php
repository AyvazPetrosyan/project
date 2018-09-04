<?php
namespace admin\controllers;

use bundle\menuTreeBundle\MenuTreeGenerator;
use engine\ParentController;
use engine\ViewManager;

class SenderDetail extends ParentController{

    public function indexAction()
    {
        $this->assignParams['viewPath'] = 'sender_detail/index.php';

        $rootDir = $this->projectInfo['rootDir'];
        $menuTree = new MenuTreeGenerator($rootDir);
        $this->assignParams['senderDetailMenuTreeList'] = $menuTree->generateSendersDetailMenuTreeList();

        new ViewManager($this->assignParams);
    }

    public function breadsAction()
    {
        $this->assignParams['viewPath'] = 'sender_detail/breads.php';

        $this->assignParams['breadsTableInfo'] = [
            ['name', 'price'],
            ['value-1', 'value-2'],
            ['value-1', 'value-2'],
            ['value-1', 'value-2'],
        ];

        $rootDir = $this->projectInfo['rootDir'];
        $menuTree = new MenuTreeGenerator($rootDir);
        $this->assignParams['senderDetailMenuTreeList'] = $menuTree->generateSendersDetailMenuTreeList();

        $this->assignParams['breadsTableForm'] = $this->generateBreadsTableForm();

        new ViewManager($this->assignParams);
    }

    public function addBreadAction()
    {
        $sqlConfig = $this->projectInfo['sqlConfig'];
        $breadName  = $this->projectInfo['params']['post']['breadName'];
        $breadPrice = $this->projectInfo['params']['post']['breadPrice'];

        $query = new Query($sqlConfig);
        $query->addIntoTable('senders',[
            'name'=>$breadName
        ]);

        $this->redirectToController('admin', 'SenderDetail', 'breadsAction');
    }

    public function historyAction()
    {
        $this->redirectToController('admin', 'SenderDetail');
    }

    public function senderAction()
    {
        $this->redirectToController('admin', 'SenderDetail');
    }

    private function generateBreadsTableForm()
    {
        $this->getBreads();
        $tableInfo = $this->assignParams['breadsTableInfo'];
        $breads = $this->getBreads();
        $tableForm = "<form method='post' action=''>";
        foreach ($tableInfo[0] as $infoKey => $infoVal) {
            if($infoVal == 'name') {
                $tableForm .= "<td><select type='text' name=$infoKey.'_name' placeholder='$infoVal' required='required'>";
                foreach ($breads as $breadKey=>$breadValue){
                    $breadName = $breadValue['name'];
                    $tableForm .= "<option value=$breadKey>$breadName</option>";
                }
                $tableForm .= "</select></td>";
            } elseif($infoVal == 'price') {
                $tableForm .= "<td><input type='number' min='10' name=$infoKey.'_name' placeholder='$infoVal' required='required'></td>";
            } else {
                $tableForm .= "<td><input type='text' name=$infoKey.'_name' placeholder='$infoVal' required='required'></td>";
            }
        }
        $tableForm .= "<td><button type='submit' >ավելացնել</button></td>";
        $tableForm .= "</form>";

        return $tableForm;
    }

    private function getBreads()
    {
        $bread = new \bundle\breadBundle\Bread($this->projectInfo['sqlConfig']);
        $breads = $bread->getBreads();

        return $breads;
    }
}