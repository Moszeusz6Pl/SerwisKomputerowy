<?php

require_once "Service/NaprawyPracownikService.php";
require_once "View/Gui.php";

/**
 * Klasa fasady obsługująca obsługę napraw
 *
 * @author Mateusz Jurasz
 */
class NaprawyPracownikFacade
{    
    function pokaz($error=NULL)
    {
    $service = new NaprawyPracownikService();
    $wynik=$service->pokaz();   
        
    $gui=new Gui();
    $gui->Show("View/Pracownik/Naprawy.html", $wynik, $error);
    }
    
    function edytujWyswietl($error = NULL)
    {
    $service = new NaprawyPracownikService();
    $wynik=$service->edytujWyswietl().$error;
        
    $this->pokaz($wynik);
    }
    
    function edytujPotwierdz()
    {
       $service = new NaprawyPracownikService();
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
    $formularz =  file_get_contents("View/Pracownik/Naprawy/Szukaj.html");
    $gui->Show("View/Pracownik/Naprawy.html", $formularz);
    }
    
    function szukajPotwierdz()
    {
        $service = new NaprawyPracownikService();
        $wynik=$service->szukajPotwierdz();
        $gui=new Gui();
        $formularz =  file_get_contents("View/Pracownik/Naprawy/Szukaj.html").$wynik;
        $gui->Show("View/Pracownik/Naprawy.html", $formularz);            
    }
    
    function dodajWyswietl()
    {
        $service = new NaprawyPracownikService();
        $formularz=$service->dodajWyswietl();
    
        $gui=new Gui();
        $gui->Show("View/Pracownik/Naprawy.html", $formularz);
    }
    
    function dodajPotwierdz()
    {
        $service = new NaprawyPracownikService();
        if(($wynik=$service->dodajPotwierdz())==1)
            $wynik=NULL;
        
        $this->pokaz($wynik);           
    }
}
