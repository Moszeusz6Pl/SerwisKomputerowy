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

        //Ustalam id kolejnego klienta
        $query = 'SELECT COUNT(*) FROM KLIENCI';
        if(($result = mysql_query($query))==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        $id=mysql_fetch_row($result);
        $id=$id[0]+1;
        
        //Sprawdzenie poprawności danych
        $query = 'SELECT COUNT(*) FROM KLIENCI WHERE LOGIN="'.$Login.'"';
        if(($result = mysql_query($query))==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        $NLogin=mysql_fetch_row($result);
        
        if($NLogin[0]>0)
            return('Istnieje już użytkownik o tym samym loginie, proszę wybrać inny');
        
        if(strlen($Login)<6)
            return('Podane login jest za krótki, proszę podać dłuższy(minimum 6 znaków)');
        
        if(strlen($Haslo)<6)
            return('Podane hasło jest za krótkie, proszę podać dłuższe(minimum 6 znaków)');
        
        if (preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/" , $Email))
            return('Wpisano niepoprawny adres e-mail');
        
        if(strlen($Telefon)==0)
            $query = 'INSERT INTO KLIENCI VALUES('.$id.', "'. $Login.'", "'.$Haslo.'", "'.$Imie.'", "'.$Nazwisko.'", "'.$Adres.'", "'.$Email.'", "")';
        else
            $query = 'INSERT INTO KLIENCI VALUES('.$id.', "'. $Login.'", "'.$Haslo.'", "'.$Imie.'", "'.$Nazwisko.'", "'.$Adres.'", "'.$Email.'", '. $Telefon.')';
        if(($result = mysql_query($query))==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        
        mysql_close($link);
        return(1);
    }
    
    function Edytuj($idKlienta, $Login, $Imie, $Nazwisko, $Adres, $Email, $Telefon)
    {
        
        if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
            return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db(DB_NAME)==false) 
            return('Nie można połączyć się z bazą danych');

        //Sprawdzenie poprawności danych
        $query = 'SELECT COUNT(*) FROM KLIENCI WHERE idKlienta='.$idKlienta;
        if(($odpowiedz=mysql_query($query))==false)
           return('Baza danych nie odpowiada na zapytanie '. $query);
        
        $result=mysql_fetch_row($odpowiedz);
        if($result[0]!=1)
            return('Nie ma użytkownika o id '.$idKlienta.' lub jest wielu o tym samym id');
        
        $query = 'SELECT COUNT(*) FROM KLIENCI WHERE LOGIN="'.$Login.'"';
        if(($result = mysql_query($query))==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        $NLogin=mysql_fetch_row($result);
        
        if(strlen($Login)<6)
            return('Podane login jest za krótki, proszę podać dłuższy(minimum 6 znaków)');
        
        if (preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/" , $Email))
            return('Wpisano niepoprawny adres e-mail');

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
