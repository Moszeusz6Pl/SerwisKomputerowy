<?php

require_once "Facade/KlienciFacade.php";

/**
 * Klasa odpowiedzialna za obsługę zdarzeń w podstronie Klienci dla Pracownika
 *
 * @author Mateusz Jurasz
 */
class KlienciPracownikController
{
    function index()
    {
        $facade=new KlienciFacade();           
        $facade->pokaz();
    }
    
    function szukaj()
    {
        $facade=new KlienciFacade();           
        $facade->szukaj();
    }
    
    function szukajPotwierdz()
    {
        $facade=new KlienciFacade();           
        $facade->szukajPotwierdz();
    }
    
    function dodaj()
    {
        $facade=new KlienciFacade();           
        $facade->dodaj();
    }
    
    function dodajPotwierdz()
    {
        $facade=new KlienciFacade();           
        $facade->dodajPotwierdz();
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
}
