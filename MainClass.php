<?php

function autoLoader($className) {
    if(strpos($className, 'Controller') !== false){
        require('controller/'.$className.'.php');
        return true;
    }
    elseif(file_exists('model/'.$className.'.php')){
        require('model/'.$className.'.php');
        return true;
    }
    return false;
}

/**
 * Główna klasa programu
 *
 * @author Mateusz Jurasz
 */



class mainClass {
    public function __construct() {
        session_start();
        require_once 'config/settings.php';
        spl_autoload_register('autoLoader');
    }
    
}

?>