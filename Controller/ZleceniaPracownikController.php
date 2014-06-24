<?php

require_once "Facade/ZleceniaPracownikFacade.php";

/**
 * Klasa odpowiedzialna za obsługę zdarzeń w podstronie Zlecenia dla Pracownika
 *
 * @author Mateusz Jurasz
 */
class ZleceniaPracownikController
{
    function indexKlient()
    {
        $facade=new ZleceniaPracownikFacade();           
        $facade->pokazKlient();
    }
    
    function index()
    {
        $facade=new ZleceniaPracownikFacade();           
        $facade->pokazPracownik();
    }
    
    function edytuj()
    {
        $facade=new ZleceniaPracownikFacade();           
        $facade->edytuj();
    }
    
    function edytujPotwierdz()
    {
        $facade=new ZleceniaPracownikFacade();           
        $facade->edytujPotwierdz();
    }
    
    function szukaj()
    {
        $facade=new ZleceniaPracownikFacade();           
        $facade->szukaj();
    }
    
    function szukajPotwierdz()
    {
        $facade=new ZleceniaPracownikFacade();           
        $facade->szukajPotwierdz();
    }
    
    function dodaj()
    {
        $facade=new ZleceniaPracownikFacade();           
        $facade->dodaj();
    }
    
    function dodajPotwierdz()
    {
        $facade=new ZleceniaPracownikFacade();           
        $facade->dodajPotwierdz();
    }
    
    function pokazKlienta()
    {
        $facade=new KlientPracownikFacade();           
        $facade->szukajPotwierdz();
    }
    
    function wyloguj()
    {
        $facade=new LogowanieFacade();
        $facade->wyloguj();
    }
}
