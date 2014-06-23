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
    
    function edytuj()
    {
    $service = new KlienciService();
    $wynik=$service->edytujWyswietl();
        
    $gui=new Gui();
    $gui->Show("View/Pracownik/Klienci.html", $wynik);
    }
    
    function edytujPotwierdz()
    {
        $service = new KlienciService();
        if(($wynik=$service->edytuj())==1)          
            $this->pokaz();
        else
        {
            $gui=new Gui();
            $formularz=  file_get_contents("View/Pracownik/Klienci/Szukaj.html").$wynik;
            $gui->Show("View/Pracownik/Klienci.html", $formularz);
        }
            
    }
    
    function szukaj()
    {
    $gui=new Gui();
    $formularz=  file_get_contents("View/Pracownik/Klienci/Szukaj.html");
    $gui->Show("View/Pracownik/Klienci.html", $formularz);
    }
    
    function szukajPotwierdz()
    {
        $service = new KlienciService();
        if(($wynik=$service->szukaj())==1)          
            $this->pokaz();
        else
        {
            $gui=new Gui();
            $formularz=  file_get_contents("View/Pracownik/Klienci/Szukaj.html").$wynik;
            $gui->Show("View/Pracownik/Klienci.html", $formularz);
        }
            
    }
    
    function dodaj()
    {
    $gui=new Gui();
    $formularz=  file_get_contents("View/Pracownik/Klienci/Dodaj.html");
    $gui->Show("View/Pracownik/Klienci.html", $formularz);
    }
    
    function dodajPotwierdz()
    {
        $service = new KlienciService();
        $wynik=$service->dodaj();         
        
        $gui=new Gui();
        $gui->Show("View/Pracownik/Klienci.html", $wynik);
            
    }
}
