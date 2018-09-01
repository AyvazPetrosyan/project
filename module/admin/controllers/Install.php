<?php
namespace admin\controllers;

use bundle\TablesGenerator;
use engine\ParentController;
use engine\ViewManager;

class Install extends ParentController {

    public function indexAction()
    {
        $this->assignParams['viewPath'] = 'install/index.php';
        new ViewManager($this->assignParams);
    }

    public function installAction()
    {
        $sqlConfig = $this->projectInfo['sqlConfig'];
        /** @var TablesGenerator $tableCreator */
        $tableCreator = new TablesGenerator($sqlConfig);
        $dbResult = $tableCreator->createDB();
        if($dbResult){
            $tableResult = $tableCreator->createTables();
        }

        $this->assignParams['viewPath'] = 'install/install.php';
        new ViewManager($this->assignParams);
    }
}