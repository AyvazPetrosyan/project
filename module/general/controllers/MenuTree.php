<?php

namespace general\controllers;

use bundle\Query;
use engine\ParentController;
use engine\ViewManager;

class MenuTree extends ParentController
{
    public function mainManuTreeAction()
    {
        $rootDir = $this->projectInfo['rootDir'];

        $this->assignParams['topBarMenuTree'] = [
            'main' => ['menu' => FALSE, 'href' => "/$rootDir/admin", 'name' => 'Գլխավոր'],
            'settings' => [
                'menu' => TRUE,
                'name' => 'Settings',
                'history' => [
                    'menu' => TRUE,
                    'name' => 'History',
                    'history1' => ['menu' => FALSE, 'href' => '/$rootDir/admin/Senders', 'name' => 'history 1']
                ],
                'install' => ['menu' => FALSE, 'href' => "/$rootDir/admin/Install", 'name' => 'install']
            ],
            'senders' => ['menu' => FALSE, 'href' => "/$rootDir/admin/Senders", 'name' => 'Առաքիչներ'],
            'bread' => ['menu' => FALSE, 'href' => "/$rootDir/admin/Bread", 'name' => 'Bread']
        ];

        new ViewManager($this->assignParams);
    }
}