<?php
namespace bundle\menuTreeBundle;

use engine\Bundle;

class MenuTreeGenerator extends Bundle {

    private $projectRootDir;

    public function __construct($projectRootDir)
    {
        $this->projectRootDir = $projectRootDir;
    }

    public function generateSendersDetailMenuTreeList()
    {
        $rootDir = $this->projectRootDir;
        $senderDetailMenuTreeList = [
            'bread'   =>['menu'=>FALSE, 'href'=>"/$rootDir/admin/SenderDetail/breads", 'name'=>'Breads'],
            'history' =>['menu'=>FALSE, 'href'=>"/$rootDir/admin/SenderDetail/history", 'name'=>'history'],
            'sender'  =>['menu'=>FALSE, 'href'=>"/$rootDir/admin/SenderDetail/sender", 'name'=>'Առաքիչներ'],
        ];

        return $senderDetailMenuTreeList;
    }
}