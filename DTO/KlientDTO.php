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
        if(($link = mysql_connect('DB_HOST', 'DB_USER', 'DB_PASSWORD'))==false)
                return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db('DB_NAME')==false) 
            return('Nie można połączyć się z bazą danych');

        $query = 'SELECT COUNT(*) FROM "KLIENCI"';
        if(($result = mysql_query($query))==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        $query = 'INSERT INTO KLIENCI VALUES('.mysql_fetch_field($result).', '. $Login.', '.$Haslo.', '.$Imie.', '.$Nazwisko.', '.$Adres.', '.$Email.', '. $Telefon.')';
        mysql_free_result($result);
        if(($result = mysql_query($query))==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        mysql_free_result($result);
        
        mysql_close($link);
        return(1);
    }
    
    function Modyfikuj()
    {
        
    }
    
    function Usun()
    {
        
    }
}
