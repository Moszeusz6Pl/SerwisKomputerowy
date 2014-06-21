<?php
require_once 'mainClass.php';

$main = new mainClass();

$defaultSubpage = 'Login';
if(!empty($_GET['subpage'])){
    $subpage = strtolower($_GET['subpage']);
    if(ctype_lower($subpage)){
        $subpage[0] = strtoupper($subpage[0]);
        $dir = "controller/".$task."Controller.php";
        if(!file_exists($dir)){
            $subpage = $defaultSubpage;
        }
    }
    else {
        $subpage = $defaultSubpage;
    }
}
else {
    $subpage = $defaultSubpage;
}

$controllerName = $subpage.'Controller';
$controller = new $controllerName();

$defaultAction = "index";
if(!empty($_GET['action'])){
    $action = strtolower($_GET['action']);
    if(!method_exists($controller, $action)){
        $action = $defaultAction;
    }
}
else {
    $action = $defaultAction;
}

$controller->$action();

?>