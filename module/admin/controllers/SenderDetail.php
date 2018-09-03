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
        ];

        $rootDir = $this->projectInfo['rootDir'];
        $menuTree = new MenuTreeGenerator($rootDir);
        $this->assignParams['senderDetailMenuTreeList'] = $menuTree->generateSendersDetailMenuTreeList();

        new ViewManager($this->assignParams);
    }

    public function addBreadAction()
    {
        $sqlConfig = $this->projectInfo['sqlConfig'];
        $breadName = $this->projectInfo['params']['post']['breadName'];
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
}