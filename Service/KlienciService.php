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

        $query = 'SELECT * FROM Klienci';
        $result='<table border="5"><td>Id</td><td>Login</td><td>Imie</td><td>Nazwisko</td><td>Adres</td><td>e-mail</td><td>telefon</td></tr>';
        $odpowiedz = mysql_query($query);
        while ($wiersz = mysql_fetch_row($odpowiedz)) 
        {
              $result=$result. '<tr><td>'. $wiersz[0] .'</td><td>'. $wiersz[1] .'</td><td>'. $wiersz[3] .'</td><td>'. $wiersz[4] .'</td><td>'. $wiersz[5] .'</td><td>'. $wiersz[6] .'</td><td>'.$wiersz[7] .'</td></tr>' ;
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
