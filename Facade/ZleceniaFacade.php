<?php

require_once "Service/ZleceniaService.php";
require_once "View/Gui.php";

/**
 * Klasa fasady obsługująca obsługę zleceń
 *
 * @author Mateusz Jurasz
 */
class ZleceniaFacade
{
    function pokazKlient($error=NULL)
    {
    $service = new ZleceniaService();
    $wynik=$service->szukaj();   
        
    $gui=new Gui();
    $gui->Show("View/Klient/Zlecenia.html", $wynik, $error);
    }
    
    function pokazPracownik($error=NULL)
    {
    $service = new ZleceniaService();
    $wynik=$service->pokaz();   
        
    $gui=new Gui();
    $gui->Show("View/Pracownik/Zlecenia.html", $wynik, $error);
    }
    
    //to do
    function edytuj()
    {
    $service = new ZleceniaService();
    $wynik=$service->edytujWyswietl();
        
    $this->pokazPracownik($wynik);
    }
    
    function edytujPotwierdz()
    {
        $service = new ZleceniaService();
        if(($wynik=$service->edytuj())==1)          
            $this->pokazPracownik();
        else
        {
            $gui=new Gui();
            $formularz =  file_get_contents("View/Pracownik/Klienci/Szukaj.html").$wynik;
            $gui->Show("View/Pracownik/Klienci.html", $formularz);
        }
            
    }
    
    function szukaj()
    {
    $gui=new Gui();
    $formularz =  file_get_contents("View/Pracownik/Zlecenia/Szukaj.html");
    $gui->Show("View/Pracownik/Zlecenia.html", $formularz);
    }
    
    function szukajPotwierdz()
    {
        $service = new ZleceniaService();
        $wynik=$service->szukaj();
        $gui=new Gui();
        $formularz =  file_get_contents("View/Pracownik/Zlecenia/Szukaj.html").$wynik;
        $gui->Show("View/Pracownik/Zlecenia.html", $formularz);            
    }
    
    function dodaj()
    {
    $gui=new Gui();
    $formularz =  file_get_contents("View/Pracownik/Zlecenia/Dodaj.html");
    $gui->Show("View/Pracownik/Zlecenia.html", $formularz);
    }
    
    function dodajPotwierdz()
    {
        $service = new ZleceniaService();
        if(($wynik=$service->dodaj())==1)
            $wynik=NULL;
        
        $this->pokazPracownik($wynik);           
    }
}
