<?php
namespace admin\controllers;

use bundle\Query;
use engine\ParentController;
use engine\ViewManager;

class Bread extends ParentController{

    public function indexAction()
    {
        $this->assignParams['viewPath'] = 'bread/index.php';

        $breads = $this->getBreads();
        $this->assignParams['breads'] = $breads;

        new ViewManager($this->assignParams);
    }

    public function deleteBreadAction()
    {
        $sqlConfig = $this->projectInfo['sqlConfig'];
        $breadId = $this->projectInfo['params']['id'];

        $query = new Query($sqlConfig);
        $query->deleteFromTable('breads',[
            'id'=>$breadId
        ]);

        $this->redirectToController('admin','Bread');
    }

    public function addBreadAction()
    {
        $sqlConfig = $this->projectInfo['sqlConfig'];
        $breadName = $this->projectInfo['params']['post']['breadName'];

        $query = new Query($sqlConfig);
        $query->addIntoTable('breads',[
            'name'=>$breadName
        ]);

        $this->redirectToController('admin','Bread');
    }

    public function breadDetailAction()
    {

    }

    private function getBreads()
    {
        $sqlConfig = $this->projectInfo['sqlConfig'];
        $query = new Query($sqlConfig);
        $breads = [];
        $resultList = $query->getAllFromTable('breads');

        foreach($resultList as $result){
            $breads[] = $result;
        }

        return $breads;

    }
}