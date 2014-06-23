<?php

/**
 * Klasa zapewniająca usługi dla obsługi klientów
 *
 * @author Mateusz Jurasz
 */
class KlienciService
{
    function pokaz()
    {
        if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
            return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db(DB_NAME)==false) 
            return('Nie można połączyć się z bazą danych');

        $query = 'SELECT idKlienta, Login, Imie, Nazwisko, Adres, "E-mail", Telefon FROM Klienci';
        $result='<table border="5"><th></th><th>Id</th><th>Login</th><th>Imie</th><th>Nazwisko</th><th>Adres</th><th>e-mail</th><th>telefon</th></th>';
        $odpowiedz = mysql_query($query);
        while ($wiersz = mysql_fetch_row($odpowiedz)) 
        {
              $result=$result. '<tr><td><input type="radio" name="idKlienta" value="'. $wiersz[0] .'"/></td><td>'. $wiersz[0] .'</td><td>'. $wiersz[1] .'</td><td>'. $wiersz[2] .'</td><td>'. $wiersz[3] .'</td><td>'. $wiersz[4] .'</td><td>'. $wiersz[5] .'</td><td>'.$wiersz[6] .'</td></tr>' ;
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
        $query = 'SELECT idKlienta, Login, Imie, Nazwisko, Adres, "E-mail", Telefon FROM Klienci';
        
        //Wyszukiwanie id
        if(!empty($_GET['idKlienta']))
        {
            $query = $query . ' where idKlienta = '.$_GET['idKlienta'];
            $count = $count + 1;
        }
        
        //Wyszukiwanie Loginu
        if(!empty($_GET['Login']))
        {
            if($count == 0)
                $query = $query . ' Where Login = "'.$_GET['Login'].'"';
            else
            $query = $query . ' And Login = "'.$_GET['Login'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie Imienia
        if(!empty($_GET['Imie']))
        {
            if($count == 0)
                $query = $query . ' Where Imie = "'.$_GET['Imie'].'"';
            else
            $query = $query . ' And Imie = "'.$_GET['Imie'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie Nazwiska
        if(!empty($_GET['Nazwisko']))
        {
            if($count == 0)
                $query = $query . ' Where Nazwisko = "'.$_GET['Nazwisko'].'"';
            else
            $query = $query . ' And Nazwisko = "'.$_GET['Nazwisko'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie Adresu
        if(!empty($_GET['Adres']))
        {
            if($count == 0)
                $query = $query . ' Where Adres = "'.$_GET['Adres'].'"';
            else
            $query = $query . ' And Adres = "'.$_GET['Adres'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie e-mailu
        if(!empty($_GET['Email']))
        {
            if($count == 0)
                $query = $query . ' Where "e-mail" = "'.$_GET['Email'].'"';
            else
            $query = $query . ' And "e-mail" = "'.$_GET['Email'].'"';
            $count = $count + 1;
        }
        
        //Wyszukiwanie Telefonu
        if(!empty($_GET['Telefon']))
        {
            if($count == 0)
                $query = $query . ' Where Telefon = '.$_GET['Telefon'];
            else
            $query = $query . ' And Telefon = '.$_GET['Telefon'];
            $count = $count + 1;
        }
        
        $result='<table border="5"><th></th><th>Id</th><th>Login</th><th>Imie</th><th>Nazwisko</th><th>Adres</th><th>e-mail</th><th>telefon</th></th>';
        $odpowiedz = mysql_query($query);
        while ($wiersz = mysql_fetch_row($odpowiedz)) 
        {
              $result=$result. '<tr><td><input type="radio" name="idKlienta" value="'. $wiersz[0] .'"/></td><td>'. $wiersz[0] .'</td><td>'. $wiersz[1] .'</td><td>'. $wiersz[2] .'</td><td>'. $wiersz[3] .'</td><td>'. $wiersz[4] .'</td><td>'. $wiersz[5] .'</td><td>'.$wiersz[6] .'</td></tr>' ;
        }
        $result=$result. '<table>';
        mysql_free_result($odpowiedz);
 
        mysql_close($link);
        return $result;
    }
    
    function dodaj()
    {
        require_once "DTO/KlientDTO.php";
        $DTO = new KlientDTO();
        return ($DTO->Dodaj($_GET['Login'], $_GET['Haslo'], $_GET['Imie'], $_GET['Nazwisko'], $_GET['Adres'], $_GET['Email'], $_GET['Telefon']));
    }
}
