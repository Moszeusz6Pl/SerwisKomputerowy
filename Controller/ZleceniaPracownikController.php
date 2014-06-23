<?php

require_once "Facade/ZleceniaFacade.php";

/**
 * Klasa odpowiedzialna za obsługę zdarzeń w podstronie Zlecenia dla Pracownika
 *
 * @author Mateusz Jurasz
 */
class ZleceniaPracownikController
{
    function indexKlient()
    {
        $facade=new ZleceniaFacade();           
        $facade->pokazKlient();
    }
    
    function index()
    {
        $facade=new ZleceniaFacade();           
        $facade->pokazPracownik();
    }
    
    function edytuj()
    {
        $facade=new ZleceniaFacade();           
        $facade->edytuj();
    }
    
    function edytujPotwierdz()
    {
        $facade=new ZleceniaFacade();           
        $facade->edytujPotwierdz();
    }
    
    function szukaj()
    {
        $facade=new ZleceniaFacade();           
        $facade->szukaj();
    }
    
    function szukajPotwierdz()
    {
        $facade=new ZleceniaFacade();           
        $facade->szukajPotwierdz();
    }
    
    function dodaj()
    {
        $facade=new ZleceniaFacade();           
        $facade->dodaj();
    }
    
    function dodajPotwierdz()
    {
        $facade=new ZleceniaFacade();           
        $facade->dodajPotwierdz();
    }
    
    function pokazKlienta()
    {
        $facade=new KlientFacade();           
        $facade->szukajPotwierdz();
    }
    
    function wyloguj()
    {
        $facade=new LogowanieFacade();
        $facade->wyloguj();
    }
}
