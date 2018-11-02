<?php
namespace admin\controllers;

use bundle\menuTreeBundle\MenuTreeGenerator;
use bundle\Query;
use bundle\senderBundle\Sender;
use engine\ParentController;
use engine\ViewManager;

class SenderDetail extends ParentController{

    public function indexAction()
    {
        $this->assignParams['viewPath'] = 'sender_detail/index.php';

        $rootDir = $this->projectInfo['rootDir'];
        $menuTree = new MenuTreeGenerator($rootDir);

        $sqlConfig = $this->projectInfo['sqlConfig'];
        $senderId = $this->projectInfo['params']['id'];
        $sender = new Sender($sqlConfig);
        $sender = $sender->getSenderById($senderId);

        $this->assignParams['senderDetailMenuTreeList'] = $menuTree->generateSendersDetailMenuTreeList($senderId);
        $this->assignParams['senderInfo'] = $sender;

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
        $senderId = $this->projectInfo['params']['id'];
        $this->assignParams['senderDetailMenuTreeList'] = $menuTree->generateSendersDetailMenuTreeList($senderId);

        $this->assignParams['breadsTableForm'] = $this->generateBreadsTableForm($senderId);

        new ViewManager($this->assignParams);
    }

    public function addBreadAction()
    {
        $sqlConfig  = $this->projectInfo['sqlConfig'];
        $senderId = $this->projectInfo['params']['post']['senderId'];
        $breadId  = $this->projectInfo['params']['post']['breadId'];
        $breadPrice = $this->projectInfo['params']['post']['breadPrice'];

        $insertList = [
            'sender_id' => $senderId,
            'bread_id' => $breadId,
            'price' => $breadPrice
        ];

        $query = new Query($sqlConfig);
        $query->addIntoTable('senders_breads_relation',$insertList);

        $this->redirectToController('admin', 'SenderDetail', 'breads');
    }

    public function historyAction()
    {
        $senderId = $this->projectInfo['params']['id'];
        $this->redirectToController('admin', 'SenderDetail','index','id', $senderId);
    }

    public function senderAction()
    {
        $this->redirectToController('admin', 'SenderDetail');
    }

    private function generateBreadsTableForm($senderId)
    {
        $rootDir = $this->projectInfo['rootDir'];
        $tableInfo = $this->assignParams['breadsTableInfo'];
        $breads = $this->getBreads();
        $tableForm = "<form method='post' action='/$rootDir/admin/SenderDetail/addBread'>";
        foreach ($tableInfo[0] as $infoKey => $infoVal) {
            if($infoVal == 'name') {
                $tableForm .= "<td><select type='text' name='breadId' placeholder='$infoVal' required='required'>";
                foreach ($breads as $breadKey=>$breadValue){
                    $breadId = $breadValue['id'];
                    $breadName = $breadValue['name'];
                    $tableForm .= "<option value=$breadId>$breadName</option>";
                }
                $tableForm .= "</select></td>";
            } elseif($infoVal == 'price') {
                $tableForm .= "<td><input type='hidden' name='senderId' value='$senderId' /><input type='number' min='10' name='breadPrice' placeholder='$infoVal' required='required'></td>";
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