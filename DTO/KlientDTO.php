<?php

/**
 * Klasa transferowa dla encji klient
 *
 * @author Mateusz Jurasz
 */
class KlientDTO
{
    function Dodaj($Login, $Haslo, $Imie, $Nazwisko, $Adres, $Email, $Telefon)
    {
        if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
                return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db(DB_NAME)==false) 
            return('Nie można połączyć się z bazą danych');

        $query = 'SELECT COUNT(*) FROM KLIENCI';
        if(($result = mysql_query($query))==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        $id=mysql_fetch_row($result);
        $id=$id[0]+1;
        $query = 'INSERT INTO KLIENCI VALUES('.$id.', "'. $Login.'", "'.$Haslo.'", "'.$Imie.'", "'.$Nazwisko.'", "'.$Adres.'", "'.$Email.'", '. $Telefon.')';
        mysql_free_result($result);
        if(($result = mysql_query($query))==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        mysql_free_result($result);
        
        mysql_close($link);
        return(1);
    }
    
    function Edytuj($idKlienta, $Login, $Imie, $Nazwisko, $Adres, $Email, $Telefon)
    {
        
        if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
            return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db(DB_NAME)==false) 
            return('Nie można połączyć się z bazą danych');

        $query = 'SELECT COUNT(*) FROM KLIENCI WHERE idKlienta='.$idKlienta;
        if(($odpowiedz=mysql_query($query))==false)
           return('Baza danych nie odpowiada na zapytanie '. $query);
        
        $result=mysql_fetch_row($odpowiedz);
        if($result[0]!=1)
            return('Nie ma użytkownika o id '.$idKlienta.' lub jest wielu o tym samym id');

        $count=0;
        
        //Zmiana danych klienta w bazie danych
        $query = 'Update Klienci ';
        
        //Zmiana Loginu
        if(strlen($Login)>0)
        {
            $query = $query . ' Set Login = "'.$Login.'"';
            $count = $count + 1;
        }
        
        //Zmiana Imienia
        if(strlen($Imie)>0)
        {
            if($count == 0)
                $query = $query . ' Set Imie = "'.$Imie.'"';
            else
            $query = $query . ', Imie = "'.$Imie.'"';
            $count = $count + 1;
        }
        
        //Zmiana Nazwiska
        if(strlen($Nazwisko)>0)
        {
            if($count == 0)
                $query = $query . ' Set Nazwisko = "'.$Nazwisko.'"';
            else
            $query = $query . ', Nazwisko = "'.$Nazwisko.'"';
            $count = $count + 1;
        }
        
        //Zmiana Adresu
        if(strlen($Adres)>0)
        {
            if($count == 0)
                $query = $query . ' Set Adres = "'.$Adres.'"';
            else
            $query = $query . ', Adres = "'.$Adres.'"';
            $count = $count + 1;
        }
        
        //Zmiana e-mailu
        if(strlen($Email)>0)
        {
            if($count == 0)
                $query = $query . ' Set Email = "'.$Email.'"';
            else
            $query = $query . ', Email = "'.$Email.'"';
            $count = $count + 1;
        }
        
        //Zmiana Telefonu
        if(strlen($Telefon)>0)
        {
            if($count == 0)
                $query = $query . ' Set Telefon = '.$Telefon;
            else
            $query = $query . ', Telefon = '.$Telefon;
            $count = $count + 1;
        }
        
        
        $query = $query . ' Where idKlienta = ' . $_GET['idKlienta'];
        if(mysql_query($query)==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        mysql_close($link);
        
        return 1;
    }
}
