<?php

require_once "Facade/LogowanieFacade.php";
require_once "View/Gui.php";

/**
 * Główny kontroler aplikacji
 *
 * @author Mateusz Jurasz
 */
class MainController {
    //put your code here
    
    const AKCJA_LOGIN_ZALOGUJ=1;
    
    protected function getAction()
    {
       if(isset($_REQUEST['LOGIN_ZALOGUJ']))
            return self::AKCJA_LOGIN_ZALOGUJ;
    }
    
    function processRequest()
    {
        $akcja = $this->getAction();
       
        if($akcja==self::AKCJA_LOGIN_ZALOGUJ)
        {
            $facade=new LogowanieFacade();           
            $facade->zaloguj();
        }
        else
        {
            $gui = new Gui();
            $gui->Show("View/zaloguj.html",NULL);
        }
    }
}
