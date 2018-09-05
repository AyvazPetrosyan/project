<?php
namespace bundle\menuTreeBundle;

use engine\Bundle;

class MenuTreeGenerator extends Bundle {

    private $projectRootDir;

    public function __construct($projectRootDir)
    {
        $this->projectRootDir = $projectRootDir;
    }

    public function generateSendersDetailMenuTreeList($senderId)
    {
        $rootDir = $this->projectRootDir;
        $senderDetailMenuTreeList = [
            'bread'   =>['menu'=>FALSE, 'href'=>"/$rootDir/admin/SenderDetail/breads/id/$senderId", 'name'=>'Breads'],
            'history' =>['menu'=>FALSE, 'href'=>"/$rootDir/admin/SenderDetail/history/id/$senderId", 'name'=>'history'],
            'sender'  =>['menu'=>FALSE, 'href'=>"/$rootDir/admin/SenderDetail/sender/id/$senderId", 'name'=>'Առաքիչներ'],
        ];

        return $senderDetailMenuTreeList;
    }
}