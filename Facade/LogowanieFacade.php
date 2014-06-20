<?php

require_once "Service/LogowanieService.php";
require_once "View/Gui.php";

/**
 * Klasa fasady obsługująca logowanie i wylogowywanie
 *
 * @author Mateusz Jurasz
 */
class LogowanieFacade {
    
    function zaloguj()
    {
        $username=$_GET['username'];
        $password=$_GET['password'];
        $service=new LogowanieService();
        if(($error=$service->zaloguj($username, $password))==1)
        {
            if($_SESSION['Pracownik']==1)
                $strona="View/Pracownik/klienci.html";
            else
                $strona="View/Klient/zlecenia.html";
            $wynik=NULL;
        }
        else 
        {
            $strona="View/zaloguj.html";
            $wynik=$error;
        }
        $gui = new Gui();
        $gui->show($strona, $wynik);
    }
    
    function wyloguj()
    {
        $service=new LogowanieService();
        $service->wyloguj();
    }
    
}
