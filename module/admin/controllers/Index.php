<?php
namespace admin\controllers;

use engine\ParentController;
use engine\ViewManager;

class Index extends ParentController {

    public function indexAction()
    {
        $this->assignParams['viewPath'] = 'index/index.php';
        new ViewManager($this->assignParams);
    }
}