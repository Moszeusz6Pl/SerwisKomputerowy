<?php

/**
 * Klasa zapewniająca usługi dla obsługi napraw
 *
 * @author Mateusz Jurasz
 */
class NaprawyPracownikService
{
    function pokaz()
    {
        if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
            return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db(DB_NAME)==false) 
            return('Nie można połączyć się z bazą danych');

        $query = 'SELECT * FROM Naprawy';
        $result='<table border="5"><th>Id</th><th>Status</th><th>Id Zlecenia</th><th>Id Sprzetu</th><th>Opis</th><th>Cena</th><th>Id Czesci</th><th>Edytuj</th><th>Pokaż zlecenie</th><th>Pokaż sprzęt</th><th>Pokaż część</th>';
        $odpowiedz = mysql_query($query);
        while ($wiersz = mysql_fetch_row($odpowiedz)) 
        {
              $result=$result. '<tr><td>'. $wiersz[0] .'</td><td>'. $wiersz[1] .'</td><td>'
                . $wiersz[2] .'</td><td>'. $wiersz[3] .'</td><td>'. $wiersz[4] .'</td><td>'. $wiersz[5] .'</td><td>'.
                $wiersz[6] .'</td><td> <a href="index.php?subpage=naprawyPracownik&action=edytujWyswietl&idNaprawy='. $wiersz[0] .'">Edytuj</a> </td>'
                . '<td> <a href="index.php?subpage=zleceniaPracownik&action=szukajPotwierdz&idZlecenia='. $wiersz[2] .'">Pokaż zlecenie</a> </td>'
                . '<td> <a href="index.php?subpage=sprzetyPracownik&action=szukajPotwierdz&idSprzetu='. $wiersz[3] .'">Pokaż sprzęt</a> </td>'
                . '<td> <a href="index.php?subpage=czesciPracownik&action=szukajPotwierdz&idCzesci='. $wiersz[6] .'">Pokaż część</a> </td></tr>';
        }
        $result=$result. '<table>';
 
        mysql_close($link);
        return $result;
    }
    
    function szukajPotwierdz()
    {
        if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
            return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db(DB_NAME)==false) 
            return('Nie można połączyć się z bazą danych');

        //Tworzenie zapytania
        $count = 0;
        $query = 'SELECT *';
        
        //Wyszukiwanie id
        if(!empty($_GET['idNaprawy']))
        {
            $query = $query . ' where idNaprawy = '.$_GET['idNaprawy'];
            $count = $count + 1;
        }
        
        //Wyszukiwanie Stanu
        if(!empty($_GET['Stan']))
        {
            if($count == 0)
                $query = $query . ' Where Stan = "'.$_GET['Stan'].'"';
            else
            $query = $query . ' And Stan = "'.$_GET['Stan'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie ID Zlecenia
        if(!empty($_GET['idZlecenia']))
        {
            if($count == 0)
                $query = $query . ' Where idZlecenia = "'.$_GET['idZlecenia'].'"';
            else
            $query = $query . ' And idZlecenia = "'.$_GET['idZlecenia'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie ID Sprzętu
        if(!empty($_GET['idSprzetu']))
        {
            if($count == 0)
                $query = $query . ' Where idSprzetu = "'.$_GET['idSprzetu'].'"';
            else
            $query = $query . ' And idSprzetu = "'.$_GET['idSprzetu'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie Opisu
        if(!empty($_GET['Opis']))
        {
            if($count == 0)
                $query = $query . ' Where Opis = "'.$_GET['Opis'].'"';
            else
            $query = $query . ' And Opis = "'.$_GET['Opis'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie Ceny
        if(!empty($_GET['Cena']))
        {
            if($count == 0)
                $query = $query . ' Where Cena = '.$_GET['Cena'];
            else
            $query = $query . ' And Cena = '.$_GET['Cena'];
            $count = $count + 1;
        }
        
        //Wyszukiwanie ID Części
        if(!empty($_GET['idCzesci']))
        {
            if($count == 0)
                $query = $query . ' Where idCzesci = "'.$_GET['idCzesci'].'"';
            else
            $query = $query . ' And idCzesci = "'.$_GET['idCzesci'].'"';
            $count = $count + 1;
        }
        
        $result='<table border="5"><th>Id</th><th>Status</th><th>Id Zlecenia</th><th>Id Sprzetu</th><th>Opis</th><th>Cena</th><th>Id Czesci</th><th>Edytuj</th><th>Pokaż zlecenie</th><th>Pokaż sprzęt</th><th>Pokaż część</th>';
        $odpowiedz = mysql_query($query);
        while ($wiersz = mysql_fetch_row($odpowiedz)) 
        {
              $result=$result. '<tr><td>'. $wiersz[0] .'</td><td>'. $wiersz[1] .'</td><td>'
                . $wiersz[2] .'</td><td>'. $wiersz[3] .'</td><td>'. $wiersz[4] .'</td><td>'. $wiersz[5] .'</td><td>'.
                $wiersz[6] .'</td><td> <a href="index.php?subpage=naprawyPracownik&action=edytujWyswietl&idNaprawy='. $wiersz[0] .'">Edytuj</a> </td>'
                . '<td> <a href="index.php?subpage=zleceniaPracownik&action=szukajPotwierdz&idZlecenia='. $wiersz[2] .'">Pokaż zlecenie</a> </td>'
                . '<td> <a href="index.php?subpage=sprzetyPracownik&action=szukajPotwierdz&idSprzetu='. $wiersz[3] .'">Pokaż sprzęt</a> </td>'
                . '<td> <a href="index.php?subpage=czesciPracownik&action=szukajPotwierdz&idCzesci='. $wiersz[6] .'">Pokaż część</a> </td></tr>';
        }
        $result=$result. '<table>';
 
        mysql_close($link);
        return $result;
    }
    
    function edytujWyswietl()
    {
        if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
            return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db(DB_NAME)==false) 
            return('Nie można połączyć się z bazą danych');

        
        //Pobieranie danych z bazy
        $query = 'SELECT Stan, idZlecenia, idSprzetu, Opis, Cena, idCzesci FROM Naprawy Where idNaprawy ='.$_GET['idNaprawy'];
        $odpowiedz = mysql_query($query);              
        $wiersz = mysql_fetch_row($odpowiedz);
        
        //Wypełnienie formularza wartościami z bazy danych
        $html=file_get_contents("View/Pracownik/Naprawy/Edytuj.html");
        $search = array(":PRZYJETE:");
        if($wiersz[0]=="Przyjete")           
            $replace = array("selected");
        else
            $replace = array(""); 
        $html = str_replace($search, $replace, $html);
        
        $search = array(":WTOKU:");
        if($wiersz[0]=="WToku")           
            $replace = array("selected");
        else
            $replace = array(""); 
        $html = str_replace($search, $replace, $html);
        
        $search = array(":ZAKONCZONE:");
        if($wiersz[0]=="Zakonczone")           
            $replace = array("selected");
        else
            $replace = array(""); 
        $html = str_replace($search, $replace, $html);
              
        $search = array(":IDZLECENIA:");
        $replace = array($wiersz[1]);
        $html = str_replace($search, $replace, $html);
        
        $search = array(":IDZSPRZETU:");
        $replace = array($wiersz[2]);
        $html = str_replace($search, $replace, $html);
        
        $search = array(":OPIS:");
        $replace = array($wiersz[3]);
        $html = str_replace($search, $replace, $html);
        
        $search = array(":CENA:");
        $replace = array($wiersz[4]);
        $html = str_replace($search, $replace, $html);
        
        $search = array(":IDCZESCI:");
        $replace = array($wiersz[5]);
        $html = str_replace($search, $replace, $html);
        
        $search = array(":IDNAPRAWY:");
        $replace = array($_GET['idNaprawy']);
        $html = str_replace($search, $replace, $html);
 
        mysql_close($link);
        return $html;
    }
    
    function edytujPotwierdz()
    {
        require_once "DTO/NaprawyDTO.php";
        $DTO = new ZlecenieDTO();
        $wynik=$DTO->Edytuj($_GET['idNaprawy'], $_GET['Stan'], $_GET['idZlecenia'], $_GET['idSprzetu'], $_GET['Opis'], $_GET['Cena'], $_GET['idCzesci']);
        return($wynik);
    }
    
    function dodajWyswietl()
    {
        $search = array(":IDZLECENIA:");
        
        if(isset($_GET['idZlecenia']))  
        {
            $replace = array($_GET['idZlecenia']);
        }
        else
            $replace = array('');

        $html =  file_get_contents("View/Pracownik/Naprawy/Dodaj.html");
        $html = str_replace($search, $replace, $html);
        return $html;
    }
    
    function dodajPotwierdz()
    {
        require_once "DTO/NaprawyeDTO.php";
        $DTO = new ZlecenieDTO();
        return ($DTO->Dodaj($_GET['Stan'], $_GET['idZlecenia'], $_GET['idSprzetu'], $_GET['Opis'], $_GET['Cena'], $_GET['idCzesci']));
    }
}
