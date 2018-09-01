<?php
namespace engine;

abstract class Project {

    public function __construct()
    {

    }

    public function customDebug($param)
    {
        echo '<pre>';
        print_r($param);
        die();
    }
}