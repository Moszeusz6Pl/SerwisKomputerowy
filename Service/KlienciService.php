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
        if(($link = mysql_connect('localhost', 'System', 'vfJhDDQ2PNXHsdq8'))==false)
            return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db('baza1')==false) 
            return('Nie można połączyć się z bazą danych');

        $query = 'SELECT * FROM Klienci';
        $result='<table>';
        $odpowiedz = mysql_query($query);
        while ($wiersz = mysql_fetch_row($odpowiedz)) 
        {
              $result=$result. '<tr><td>'. $wiersz[0] .'</td><td>'. $wiersz[1] .'</td><td>'. $wiersz[2] .'</td><td>'. $wiersz[3] .'</td></tr>'. $wiersz[4] .'</td><td>'. $wiersz[5] .'</td><td>'. $wiersz[6] .'</td><td>'.$wiersz[7] .'</td></tr>' ;
        }
        $result=$result. '<table>';
        mysql_free_result($odpowiedz);
 
        mysql_close($link);
        return $result;
    }
}
