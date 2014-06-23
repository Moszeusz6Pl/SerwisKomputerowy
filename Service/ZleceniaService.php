<?php

/**
 * Klasa zapewniająca usługi dla obsługi zleceń
 *
 * @author Mateusz Jurasz
 */
class ZleceniaService
{
    function pokaz()
    {
        if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
            return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db(DB_NAME)==false) 
            return('Nie można połączyć się z bazą danych');

        $query = 'SELECT idZlecenia, Data, Status, idKlienta, Cena, CzasNaprawy, Rabat FROM Zlecenia';
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
        mysql_free_result($odpowiedz);
 
        mysql_close($link);
        return $result;
    }
    
    function szukaj()
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
        mysql_free_result($odpowiedz);
 
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
        $query = 'SELECT Login, Imie, Nazwisko, Adres, Email, Telefon FROM Klienci Where idKlienta ='.$_GET['idKlienta'];
        $odpowiedz = mysql_query($query);              
        $wiersz = mysql_fetch_row($odpowiedz);
        
        //Wypełnienie formularza wartościami z bazy danych
        $html=file_get_contents("View/Pracownik/Klienci/Edytuj.html");
        $search = array(":LOGIN:");
        $replace = array($wiersz[0]);
        $html = str_replace($search, $replace, $html);
        $search = array(":IMIE:");
        $replace = array($wiersz[1]);
        $html = str_replace($search, $replace, $html);
        $search = array(":NAZWISKO:");
        $replace = array($wiersz[2]);
        $html = str_replace($search, $replace, $html);
        $search = array(":ADRES:");
        $replace = array($wiersz[3]);
        $html = str_replace($search, $replace, $html);
        $search = array(":EMAIL:");
        $replace = array($wiersz[4]);
        $html = str_replace($search, $replace, $html);
        $search = array(":TELEFON:");
        $replace = array($wiersz[5]);
        $html = str_replace($search, $replace, $html);
        $search = array(":IDKLIENTA:");
        $replace = array($_GET['idKlienta']);
        $html = str_replace($search, $replace, $html);
        
        mysql_free_result($odpowiedz);
 
        mysql_close($link);
        return $html;
    }
    
    function edytuj()
    {
        if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
            return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db(DB_NAME)==false) 
            return('Nie można połączyć się z bazą danych');

        $count=0;
        
        //Zmiana danych klienta w bazie danych
        $query = 'Update Klienci ';
        
        //Wyszukiwanie Loginu
        if(!empty($_GET['Login']))
        {
            $query = $query . ' Set Login = "'.$_GET['Login'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie Imienia
        if(!empty($_GET['Imie']))
        {
            if($count == 0)
                $query = $query . ' Set Imie = "'.$_GET['Imie'].'"';
            else
            $query = $query . ', Imie = "'.$_GET['Imie'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie Nazwiska
        if(!empty($_GET['Nazwisko']))
        {
            if($count == 0)
                $query = $query . ' Set Nazwisko = "'.$_GET['Nazwisko'].'"';
            else
            $query = $query . ', Nazwisko = "'.$_GET['Nazwisko'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie Adresu
        if(!empty($_GET['Adres']))
        {
            if($count == 0)
                $query = $query . ' Set Adres = "'.$_GET['Adres'].'"';
            else
            $query = $query . ', Adres = "'.$_GET['Adres'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie e-mailu
        if(!empty($_GET['Email']))
        {
            if($count == 0)
                $query = $query . ' Set Email = "'.$_GET['Email'].'"';
            else
            $query = $query . ', Email = "'.$_GET['Email'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie Telefonu
        if(!empty($_GET['Telefon']))
        {
            if($count == 0)
                $query = $query . ' Set Telefon = '.$_GET['Telefon'];
            else
            $query = $query . ', Telefon = '.$_GET['Telefon'];
            $count = $count + 1;
        }
        
        $query = $query . ' Where idKlienta = ' . $_GET['idKlienta'];
        
        echo $query;
        
        $odpowiedz = mysql_query($query);
        mysql_free_result($odpowiedz);
        mysql_close($link);
    }
    
    function dodaj()
    {
        require_once "DTO/ZleceniaDTO.php";
        $DTO = new ZleceniaDTO();
        return ($DTO->Dodaj($_GET['Login'], $_GET['Haslo'], $_GET['Imie'], $_GET['Nazwisko'], $_GET['Adres'], $_GET['Email'], $_GET['Telefon']));
    }
}
