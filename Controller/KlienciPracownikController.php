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
    
    function edytuj()
    {
        $facade=new KlienciFacade();           
        $facade->edytuj();
    }
    
    function edytujPotwierdz()
    {
        $facade=new KlienciFacade();           
        $facade->edytujPotwierdz();
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
    
    function pokazZlecenia()
    {
        $facade=new KlienciFacade();           
        $facade->dodajPotwierdz();
    }
    
    function wyloguj()
    {
        $facade=new LogowanieFacade();
        $facade->wyloguj();
    }
}
