<?php
namespace engine;

class ViewManager extends Project{

    private $controllerView = NULL;

    private $controllerParams = [];

    private $js = [];

    private $css = [];

    public function __construct($controllerParams = NULL)
    {
        $this->rootDir = $controllerParams['rootDir'];
        $this->controllerView = $controllerParams['viewPath'];
        $this->controllerParams = $controllerParams;
        $this->createJs();
        $this->createCss();

        $this->htmlHead();
        $this->htmlBody($this->controllerView);
    }

    private function htmlHead()
    {
        echo '<html>';
        echo '<head>';
            echo "<title>HTDOCS</title>";
            foreach ($this->css as $cssFile){
                echo "<link rel=stylesheet href=$cssFile type=text/css />";
            }
            foreach ($this->js as $jsFile){
                echo "<script src='$jsFile' type='text/javascript' ></script>";
            }
        echo '</head>';
    }

    private function htmlBody()
    {
        $rootDir = $this->controllerParams['rootDir'];
        $moduleName = $this->controllerParams['moduleName'];
        $controllerView = $this->controllerView;
        $viewPath = "module/$moduleName/views/$controllerView";
        echo "<body class='body module-$moduleName ctrl-'>";
            echo '<div class="page--content container">';
                require_once "$viewPath";
            echo '</div>';
        echo '</body>';
        echo '</html>';
    }

    private function createJs()
    {
        $this->js = [
            // "/$this->rootDir/module/frontend/views/public/js/jquery.js",
            // "/$this->rootDir/module/frontend/views/public/js/SendAnswer.js"
        ];
    }

    private function createCss()
    {
        $this->css = [
            "/$this->rootDir/module/public/public.css",
            "/$this->rootDir/module/library/bootstrap/css/bootstrap.css"
        ];
    }
}
