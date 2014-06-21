<?php

/**
 * Usługa odpowiedzialny za logowanie i wylogowywanie z programu
 *
 * @author Mateusz Jurasz
 */
class LogowanieService {
    
    function zaloguj($username, $password)
    {
        if($username==DB_EMPLOYEE)
        {
            if(($link = mysql_connect(DB_HOST, DB_EMPLOYEE, $password))==false)
                return('Niepoprawne haslo do konta pracownika');
            $_SESSION['Pracownik']=1;
        }
        else
        {
            if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
                return('Brak dostepu do serwera bazy danych');
             $_SESSION['Pracownik']=0;

            if(mysql_select_db(DB_NAME)==false) 
                return('Nie można połączyć się z bazą danych');

            $query = 'SELECT Haslo FROM Klienci WHERE Login="'.$username.'"';
            if(($result = mysql_query($query))==false)
                    return('Baza danych nie odpowiada na zapytanie '. $query);
            $row = mysql_fetch_object($result);
            if($password==NULL || $row->Haslo!=$password)
                return('Zła nazwa urzytkownika lub hasło');
            mysql_free_result($result);
        }
 
        mysql_close($link);
        return(1);
    }
    
    function wyloguj()
    {
        $_SESSION = array();
        session_destroy();
    }
    
}
