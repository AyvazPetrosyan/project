<?php
$URL = $_SERVER['REQUEST_URI'];
$PROJECT_NAME = 'PROJECT';
$URL_ELEMENTS_LIST = generateUrl($PROJECT_NAME, explode("/", $URL));

if(empty($sqlConfig)) {
    $URL_ELEMENTS_LIST[1] = 'frontend';
    $URL_ELEMENTS_LIST[2] = 'Install';
    $URL_ELEMENTS_LIST[3] = 'sqlConnectToDb';
} else {
    /*$connect = new \bundle\Connect($sqlConfig);
    $sqlConnectToDb = $connect->sqlConnectToDb;*/
}

$URL_INFO = array();

/*module name*/
if(empty($URL_ELEMENTS_LIST[1]) || $URL_ELEMENTS_LIST[1]==NULL)
    $URL_INFO["moduleName"] = "frontend";
else
    $URL_INFO["moduleName"] =  $URL_ELEMENTS_LIST[1];

/*controller name*/
if(empty($URL_ELEMENTS_LIST[2]) || $URL_ELEMENTS_LIST[2]==NULL)
    $URL_INFO["controllerName"] = "Index";
else
    $URL_INFO["controllerName"] =  $URL_ELEMENTS_LIST[2];

/*action name*/
if(empty($URL_ELEMENTS_LIST[3]) || $URL_ELEMENTS_LIST[3]==NULL)
    $URL_INFO["actionName"] = "indexAction";
else
    $URL_INFO["actionName"] =  $URL_ELEMENTS_LIST[3]."Action";

/*param name*/
if(empty($URL_ELEMENTS_LIST[4]) || $URL_ELEMENTS_LIST[4]==NULL)
    $URL_ELEMENTS_LIST[4] = "";

/*param value*/
if(empty($URL_ELEMENTS_LIST[5]) || $URL_ELEMENTS_LIST[5]==NULL)
    $URL_ELEMENTS_LIST[5] = "";

$PROJECT_INFO = array();
$PROJECT_INFO["host"] = gethostname();
$PROJECT_INFO["rootDir"] = "project";
$PROJECT_INFO['moduleName'] = $URL_INFO['moduleName'];
$PROJECT_INFO['controllerName'] = $URL_INFO["controllerName"];
$PROJECT_INFO['actionName'] = $URL_INFO["actionName"];
$PROJECT_INFO['sqlConfig'] = $sqlConfig;
$PROJECT_INFO['params']['post']=$_POST;
$PROJECT_INFO['params']['get']=$_GET;
$PROJECT_INFO['params'][$URL_ELEMENTS_LIST[4]]=$URL_ELEMENTS_LIST[5];

session_start();

$Router = new Router($PROJECT_INFO, $URL_INFO);

function generateUrl($projectName, $requestedUrlElementList = []){
    $generatedUrlElementList[] = $projectName;
    if(empty($requestedUrlElementList)) {
        return $requestedUrlElementList;
    }

    foreach ($requestedUrlElementList as $urlElementKey=>$urlElement){
        if($urlElement=='frontend' || $urlElement=='admin'){
            break;
        }
        unset($requestedUrlElementList[$urlElementKey]);
    }

    foreach($requestedUrlElementList as $urlElement){
        $generatedUrlElementList[] = $urlElement;
    }

    return $generatedUrlElementList;
}


class Router {

    private $moduleName = 'frontend';

    private $controllerName = 'Index';

    private $actionName = 'index';

    public function __construct($projectInfo, $urlInfo)
    {
        if(!empty($urlInfo["moduleName"]) && ($urlInfo["moduleName"]=='admin' || $urlInfo["moduleName"]=='frontend'))
            $this->moduleName = $urlInfo["moduleName"];
        if(!empty($urlInfo["controllerName"]))
            $this->controllerName = $urlInfo["controllerName"];
        if(!empty($urlInfo["actionName"]))
            $this->actionName = $urlInfo["actionName"];

        $actionName = $this->actionName;
        $controllerFullName = $this->generateControllerName();

        $controller = new $controllerFullName($projectInfo);
        $controller->$actionName();
    }

    private function generateControllerName()
    {
        $controllerFileName = $this->generateControllerFileName();
        $controllerName = 'Index';

        if(file_exists($controllerFileName)){
            $controllerName = $this->controllerName;
        }

        if($this->moduleName == "admin") {
            $fullControllerName = "admin\controllers\\" . $controllerName;
        } elseif ($this->moduleName == "frontend") {
            $fullControllerName = "frontend\controllers\\" . $controllerName;
        }

        return $fullControllerName;
    }

    private function generateControllerFileName()
    {
        $controllerName = $this->controllerName;
        if($this->moduleName == "admin") {
            $controllerFileName = __DIR__."\module\admin\controllers\\" . $controllerName.".php";
        } elseif ($this->moduleName == "frontend") {
            $controllerFileName = __DIR__."\module\\frontend\controllers\\" . $controllerName.".php";
        }

        return $controllerFileName;
    }
}