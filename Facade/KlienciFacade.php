<?php

require_once "Service/KlienciService.php";
require_once "View/Gui.php";

/**
 * Klasa fasady obsługująca obsługę klientów
 *
 * @author Mateusz Jurasz
 */
class KlienciFacade
{
    function pokaz()
    {
    $service = new KlienciService();
    $wynik=$service->pokaz();   
        
    $gui=new Gui();
    $gui->Show("View/Pracownik/Klienci.html", $wynik);
    }
    
    function dodaj()
    {
    $gui=new Gui();
    $formularz=  file_get_contents("View/Pracownik/Klienci/Dodaj.html");
    $gui->Show("View/Pracownik/Klienci.html", $formularz);
    }
}
