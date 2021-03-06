<?php

require_once "Service/ZleceniaPracownikService.php";
require_once "View/Gui.php";

/**
 * Klasa fasady obsługująca obsługę zleceń
 *
 * @author Mateusz Jurasz
 */
class ZleceniaPracownikFacade
{    
    function pokaz($error=NULL)
    {
    $service = new ZleceniaPracownikService();
    $wynik=$service->pokaz();   
        
    $gui=new Gui();
    $gui->Show("View/Pracownik/Zlecenia.html", $wynik, $error);
    }
    
    function edytujWyswietl($error = NULL)
    {
    $service = new ZleceniaPracownikService();
    $wynik=$service->edytujWyswietl().$error;
        
    $this->pokaz($wynik);
    }
    
    function edytujPotwierdz()
    {
       $service = new ZleceniaPracownikService();
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
    $formularz =  file_get_contents("View/Pracownik/Zlecenia/Szukaj.html");
    $gui->Show("View/Pracownik/Zlecenia.html", $formularz);
    }
    
    function szukajPotwierdz()
    {
        $service = new ZleceniaPracownikService();
        $wynik=$service->szukajPotwierdz();
        $gui=new Gui();
        $formularz =  file_get_contents("View/Pracownik/Zlecenia/Szukaj.html").$wynik;
        $gui->Show("View/Pracownik/Zlecenia.html", $formularz);            
    }
    
    function dodajWyswietl()
    {
        $service = new ZleceniaPracownikService();
        $formularz=$service->dodajWyswietl();
    
        $gui=new Gui();
        $gui->Show("View/Pracownik/Zlecenia.html", $formularz);
    }
    
    function dodajPotwierdz()
    {
        $service = new ZleceniaPracownikService();
        if(($wynik=$service->dodajPotwierdz())==1)
            $wynik=NULL;
        
        $this->pokaz($wynik);           
    }
}
