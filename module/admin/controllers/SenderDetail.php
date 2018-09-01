<?php
namespace admin\controllers;

use engine\ParentController;
use engine\ViewManager;

class SenderDetail extends ParentController{

    public function indexAction()
    {
        $this->assignParams['viewPath'] = 'sender_detail/index.php';
        new ViewManager($this->assignParams);

    }
}