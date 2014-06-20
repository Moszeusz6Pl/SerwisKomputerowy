<?php                           

require_once "Controller/MainController.php";

session_start();

$controller=new MainController();
$controller->processRequest();

?>