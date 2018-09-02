<?php
namespace engine;

use engine\Project;

class ParentController extends Project {

    protected $projectInfo;

    protected $assignParams;

    public function __construct($projectInfo)
    {
        $this->projectInfo = $projectInfo;
        $this->assignParams['rootDir'] = $projectInfo['rootDir'];
        $this->assignParams['moduleName'] = $projectInfo['moduleName'];

        $rootDir = $projectInfo['rootDir'];
        $this->assignParams['topBarMenuTree'] = [
            'main'=>['menu'=>FALSE, 'href'=>"/$rootDir/admin", 'name'=>'Գլխավոր'],
            'settings'=>[
                'menu'=>TRUE,
                'name'=>'Settings',
                'history'=>[
                    'menu'=>TRUE,
                    'name'=>'History',
                    'history1'=>['menu'=>FALSE, 'href'=>'/$rootDir/admin/Senders', 'name'=>'history 1'
                    ]
                ],
                'install'=>['menu'=>FALSE, 'href'=>"/$rootDir/admin/Install", 'name'=>'install']
            ],
            'senders'=>['menu'=>FALSE, 'href'=>"/$rootDir/admin/Senders", 'name'=>'Առաքիչներ'],
            'bread'  =>['menu'=>FALSE, 'href'=>"/$rootDir/admin/Bread",   'name'=>'Bread'    ]
        ];
    }

    protected function redirectToController($moduleName='frontend', $controllerName='Index', $actionName="index")
    {
        $rootDir = $this->projectInfo['rootDir'];
        $url = "$rootDir/$moduleName/$controllerName/$actionName";
        header("Location: /$url");
    }
}