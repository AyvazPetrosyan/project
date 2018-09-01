<?php
namespace admin\controllers;

use bundle\Connect;
use bundle\Query;
use engine\ParentController;
use engine\ViewManager;

class Senders extends ParentController{

    public function indexAction()
    {
        $this->assignParams['viewPath'] = 'senders/index.php';

        $senders = $this->getSenders();
        $this->assignParams['senders'] = $senders;

        new ViewManager($this->assignParams);
    }

    public function addSenderAction()
    {
        $sqlConfig = $this->projectInfo['sqlConfig'];
        $senderName = $this->projectInfo['params']['post']['sendersName'];

        $query = new Query($sqlConfig);
        $query->addIntoTable('senders',[
            'name'=>$senderName
        ]);

        $this->redirectToController('admin','Senders');
    }

    public function deleteSenderAction()
    {
        $sqlConfig = $this->projectInfo['sqlConfig'];
        $senderId = $this->projectInfo['params']['id'];

        $query = new Query($sqlConfig);
        $query->deleteFromTable('senders',[
            'id'=>$senderId
        ]);

        $this->redirectToController('admin','Senders');
    }

    private function getSenders()
    {
        $sqlConfig = $this->projectInfo['sqlConfig'];
        $query = new Query($sqlConfig);
        $senders = [];
        $resultList = $query->getAllFromTable('senders');

        foreach($resultList as $result){
            $senders[] = $result;
        }

        return $senders;
    }

    private function generateSenderOrderNumber()
    {

    }
}