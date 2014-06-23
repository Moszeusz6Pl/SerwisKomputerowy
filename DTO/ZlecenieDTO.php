<?php

/**
 * Klasa transferowa dla encji zlecenie
 *
 * @author Mateusz Jurasz
 */
class ZlecenieDTO
{
    function Dodaj($Data, $Status, $idKlienta, $Cena, $CzasNaprawy, $Rabat)
    {
        if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
                return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db(DB_NAME)==false) 
            return('Nie można połączyć się z bazą danych');

        $query = 'SELECT COUNT(*) FROM Zlecenia';
        if(($result = mysql_query($query))==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        $id=mysql_fetch_row($result);
        $id=$id[0]+1;
        $query = 'INSERT INTO Zlecenia VALUES('.$id.', "'. $Data.'", "'.$Status.'", "'.$idKlienta.'", "'.$Cena.'", "'.$CzasNaprawy.'", "'.$Rabat.')';
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
