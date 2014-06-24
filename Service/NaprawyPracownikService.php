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
        $query = 'SELECT idZlecenia, Data, Status, idKlienta, Cena, CzasNaprawy, Rabat FROM Zlecenia';
        
        //Wyszukiwanie id
        if(!empty($_GET['idZlecenia']))
        {
            $query = $query . ' where idZlecenia = '.$_GET['idZlecenia'];
            $count = $count + 1;
        }
        
        //Wyszukiwanie daty
        if(!empty($_GET['Data']))
        {
            if($count == 0)
                $query = $query . ' Where Data = "'.$_GET['Data'].'"';
            else
            $query = $query . ' And Data = "'.$_GET['Data'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie Statusu
        if(!empty($_GET['Status']))
        {
            if($count == 0)
                $query = $query . ' Where Status = "'.$_GET['Status'].'"';
            else
            $query = $query . ' And Status = "'.$_GET['Status'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie ID Klienta
        if(!empty($_GET['idKlienta']))
        {
            if($count == 0)
                $query = $query . ' Where idKlienta = "'.$_GET['idKlienta'].'"';
            else
            $query = $query . ' And idKlienta = "'.$_GET['idKlienta'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie Ceny
        if(!empty($_GET['Cena']))
        {
            if($count == 0)
                $query = $query . ' Where Cena = "'.$_GET['Cena'].'"';
            else
            $query = $query . ' And Cena = "'.$_GET['Cena'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie czasu naprawy
        if(!empty($_GET['CzasNaprawy']))
        {
            if($count == 0)
                $query = $query . ' Where CzasNaprawy = "'.$_GET['CzasNaprawy'].'"';
            else
            $query = $query . ' And CzasNaprawy = "'.$_GET['CzasNaprawy'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie Rabatu
        if(!empty($_GET['Rabat']))
        {
            if($count == 0)
                $query = $query . ' Where Rabat = '.$_GET['Rabat'];
            else
            $query = $query . ' And Rabat = '.$_GET['Rabat'];
            $count = $count + 1;
        }
        
        $result='<table border="5"><th>Id</th><th>Data</th><th>Status</th><th>Id Klienta</th><th>Cena</th><th>Czas naprawy</th><th>Rabat</th><th>Edycja</th><th>Pokaż klienta</th><th>Pokaż zlecenia</th>';
        $odpowiedz = mysql_query($query);
        while ($wiersz = mysql_fetch_row($odpowiedz)) 
        {
              $result=$result. '<tr><td>'. $wiersz[0] .'</td><td>'. $wiersz[1] .'</td><td>'
                . $wiersz[2] .'</td><td>'. $wiersz[3] .'</td><td>'. $wiersz[4] .'</td><td>'. $wiersz[5] .'</td><td>'.
                $wiersz[6] .'</td><td> <a href="index.php?subpage=zleceniaPracownik&action=edytuj&idZlecenia='. $wiersz[0] .'">Edytuj</a> </td>'
                . '<td> <a href="index.php?subpage=klienciPracownik&action=szukajPotwierdz&idKlienta='. $wiersz[3] .'">Pokaż klienta</a> </td>'
                . '<td> <a href="index.php?subpage=naprawyPracownik&action=szukajPotwierdz&idZlecenia='. $wiersz[0] .'">Pokaż naprawy</a> </td></tr>';
        }
        $result=$result. '<table>';
 
        mysql_close($link);
        return $result;
    }
    
    //to do
    function edytujWyswietl()
    {
        if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
            return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db(DB_NAME)==false) 
            return('Nie można połączyć się z bazą danych');

        
        //Pobieranie danych z bazy
        $query = 'SELECT Data, Status, idKlienta, Cena, CzasNaprawy, Rabat FROM Zlecenia Where idZlecenia ='.$_GET['idZlecenia'];
        $odpowiedz = mysql_query($query);              
        $wiersz = mysql_fetch_row($odpowiedz);
        
        //Wypełnienie formularza wartościami z bazy danych
        $html=file_get_contents("View/Pracownik/Zlecenia/Edytuj.html");
        $search = array(":DATA:");
        $replace = array($wiersz[0]);
        $html = str_replace($search, $replace, $html);
        
        $search = array(":PRZYJETE:");
        if($wiersz[1]=="Przyjete")           
            $replace = array("selected");
        else
            $replace = array(""); 
        $html = str_replace($search, $replace, $html);
        
        $search = array(":CZEKA:");
        if($wiersz[1]=="CzekaNaOdbior")           
            $replace = array("selected");
        else
            $replace = array(""); 
        $html = str_replace($search, $replace, $html);
        
        $search = array(":ZAKONCZONE:");
        if($wiersz[1]=="Zakonczone")           
            $replace = array("selected");
        else
            $replace = array(""); 
        $html = str_replace($search, $replace, $html);
        
        $search = array(":IDKLIENTA:");
        $replace = array($wiersz[2]);
        $html = str_replace($search, $replace, $html);
        $search = array(":CENA:");
        $replace = array($wiersz[3]);
        $html = str_replace($search, $replace, $html);
        $search = array(":CZASNAPRAWY:");
        $replace = array($wiersz[4]);
        $html = str_replace($search, $replace, $html);
        $search = array(":RABAT:");
        $replace = array($wiersz[5]);
        $html = str_replace($search, $replace, $html);
        $search = array(":IDZLECENIA:");
        $replace = array($_GET['idZlecenia']);
        $html = str_replace($search, $replace, $html);
 
        mysql_close($link);
        return $html;
    }
    
    function edytujPotwierdz()
    {
        require_once "DTO/ZlecenieDTO.php";
        $DTO = new ZlecenieDTO();
        $wynik=$DTO->Edytuj($_GET['idZlecenia'], $_GET['Data'], $_GET['Status'], $_GET['idKlienta'], $_GET['Cena'], $_GET['CzasNaprawy'], $_GET['Rabat']);
        return($wynik);
    }
    
    function dodajWyswietl()
    {
        $search = array(":IDKLIENTA:");
        
        if(isset($_GET['idKlienta']))  
        {
            $replace = array($_GET['idKlienta']);
        }
        else
            $replace = array('');

        $html =  file_get_contents("View/Pracownik/Zlecenia/Dodaj.html");
        $html = str_replace($search, $replace, $html);
        return $html;
    }
    
    function dodajPotwierdz()
    {
        require_once "DTO/ZlecenieDTO.php";
        $DTO = new ZlecenieDTO();
        return ($DTO->Dodaj($_GET['Data'], $_GET['Status'], $_GET['idKlienta'], $_GET['Cena'], $_GET['CzasNaprawy'], $_GET['Rabat']));
    }
}
