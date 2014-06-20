<?php

require_once "Facade/KlienciFacade.php";

/**
 * Klasa odpowiedzialna za obsługę zdarzeń w podstronie Klienci dla Pracownika
 *
 * @author Mateusz Jurasz
 */
class KlienciPracownikController
{
    
    const AKCJA_DODAJ=1;
    
    const AKCJA_SZUKAJ=2;
    
    const AKCJA_USUŃ=3;
    
    const AKCJA_MODYFIKUJ=4;
    
    const AKCJA_WYLOGUJ=5;
    
    protected function getAction()
    {
       if(isset($_REQUEST['DODAJ']))
            return self::AKCJA_DODAJ;
        
       if(isset($_REQUEST['SZUKAJ']))
            return self::AKCJA_SZUKAJ; 
       
       if(isset($_REQUEST['USUŃ']))
            return self::AKCJA_USUŃ;
        
       if(isset($_REQUEST['MODYFIKUJ']))
            return self::AKCJA_MODYFIKUJ; 

       if(isset($_REQUEST['MAIN_WYLOGUJ']))
            return self::AKCJA_WYLOGUJ; 
    }
    
    function processRequest()
    {
        $akcja = $this->getAction();
       
        if($akcja==self::AKCJA_DODAJ)
        {
            $facade=new KlienciFacade();           
            $facade->dodaj();
        }
        else
        if($akcja==self::AKCJA_SZUKAJ)
        {
            $facade=new KlienciFacade();           
            $facade->szukaj();
        }
        else
        if($akcja==self::AKCJA_USUŃ)
        {
            $facade=new KlienciFacade();           
            $facade->usuń();
        }
        else
        if($akcja==self::AKCJA_MODYFIKUJ)
        {
            $facade=new KlienciFacade();           
            $facade->modyfikuj();
        }
        else
        if($akcja==self::AKCJA_WYLOGUJ)
        {
            $facade=new LogowanieFacade();
            $facade->wyloguj();
        }
        else
        {
           $facade=new KlienciFacade();           
           $facade->pokaz();
        }
    }
}
