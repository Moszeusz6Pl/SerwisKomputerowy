<?php

require_once "Facade/LogowanieFacade.php";
require_once "View/Gui.php";

/**
 * Kontroler logowania
 *
 * @author Mateusz Jurasz
 */
class LoginController {
 
    function zaloguj()
    {
        $facade=new LogowanieFacade();           
        $facade->zaloguj();
    }
    
    function show()
    {
        $gui = new Gui();
        $gui->Show("View/zaloguj.html",NULL);
    }
}
