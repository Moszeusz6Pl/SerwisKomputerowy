<?php

require_once "Service/KlienciPracownikService.php";
require_once "View/Gui.php";

/**
 * Klasa fasady obsługująca obsługę klientów
 *
 * @author Mateusz Jurasz
 */
class KlienciPracownikFacade
{
    function pokaz($error=NULL)
    {
    $service = new KlienciPracownikService();
    $wynik=$service->pokaz();   
        
    $gui=new Gui();
    $gui->Show("View/Pracownik/Klienci.html", $wynik, $error);
    }
    
    function edytujWyswietl($error=NULL)
    {
    $service = new KlienciPracownikService();
    $wynik=$service->edytujWyswietl().$error;
        
    $this->pokaz($wynik);
    }
    
    function edytujPotwierdz()
    {
        $service = new KlienciPracownikService();
        if(($wynik=$service->edytujPotwierdz())==1)          
            $this->pokaz();
        else
        {
            $this->edytujWyswietl($wynik);
        }
    }
    
    function szukajWyswietl()
    {
    $gui=new Gui();
    $formularz =  file_get_contents("View/Pracownik/Klienci/Szukaj.html");
    $gui->Show("View/Pracownik/Klienci.html", $formularz);
    }
    
    function szukajPotwierdz()
    {
        $service = new KlienciPracownikService();
        $wynik=$service->szukajPotwierdz();         
        $gui=new Gui();
        $formularz =  file_get_contents("View/Pracownik/Klienci/Szukaj.html").'<br>'. $wynik;
        $gui->Show("View/Pracownik/Klienci.html", $formularz);           
    }
    
    function dodajWyswietl()
    {
    $gui=new Gui();
    $formularz =  file_get_contents("View/Pracownik/Klienci/Dodaj.html");
    $gui->Show("View/Pracownik/Klienci.html", $formularz);
    }
    
    function dodajPotwierdz()
    {
        $service = new KlienciPracownikService();
        if(($wynik=$service->dodajPotwierdz())==1)
            $wynik=NULL;
        
        $this->pokaz($wynik);           
    }
}
