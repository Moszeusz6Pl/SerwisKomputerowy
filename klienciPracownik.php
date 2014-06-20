<?php                           

require_once "Controller/KlienciPracownikController.php";

session_start();

$controller=new KlienciPracownikController();
$controller->processRequest();

?>
