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
            ['value-1', 'value-2', 'value-n'],
            ['value-1', 'value-2', 'value-n'],
        ];

        $rootDir = $this->projectInfo['rootDir'];
        $menuTree = new MenuTreeGenerator($rootDir);
        $this->assignParams['senderDetailMenuTreeList'] = $menuTree->generateSendersDetailMenuTreeList();

        new ViewManager($this->assignParams);
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