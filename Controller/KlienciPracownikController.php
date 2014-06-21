<?php

require_once "Facade/KlienciFacade.php";

/**
 * Klasa odpowiedzialna za obsługę zdarzeń w podstronie Klienci dla Pracownika
 *
 * @author Mateusz Jurasz
 */
class KlienciPracownikController
{
    
    function dodaj()
    {
        $facade=new KlienciFacade();           
        $facade->dodaj();
    }
   
    function szukaj()
    {
        $facade=new KlienciFacade();           
        $facade->szukaj();
    }
    
    function usun()
    {
            $facade=new KlienciFacade();           
            $facade->usuń();
    }
    
    function modyfiukuj()
    {
        $facade=new KlienciFacade();           
        $facade->modyfikuj();
    }
    
    function wyloguj()
    {
        $facade=new LogowanieFacade();
        $facade->wyloguj();
    }
    
    function index()
    {
        $facade=new KlienciFacade();           
        $facade->pokaz();
    }
}
