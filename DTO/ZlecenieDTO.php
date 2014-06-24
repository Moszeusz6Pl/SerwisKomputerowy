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

        //Ustalam id kolejnego zlecenia
        $query = 'SELECT COUNT(*) FROM Zlecenia';
        if(($result = mysql_query($query))==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        $id=mysql_fetch_row($result);
        $id=$id[0]+1;
        
        if(strlen($idKlienta)==0)
            return('Należy wybrać klienta');
        
        //Sprawdzenie czy istnieje klient o podanym id
        $query = 'SELECT COUNT(*) FROM Klienci WHERE idKlienta='.$idKlienta;
        if(($odpowiedz=mysql_query($query))==false)
           return('Baza danych nie odpowiada na zapytanie '. $query);       
        $result=mysql_fetch_row($odpowiedz);
        if($result[0]!=1)
            return('Nie ma klienta o id '.$idZlecenia.' lub jest wielu o tym samym id');
        
        //Tworzenie zapytania
        $query = 'INSERT INTO Zlecenia VALUES('.$id.', "'. $Data.'", "'.$Status.'", "'.$idKlienta.'"';
        
        if(strlen($CzasNaprawy)==0)
            $query = $query . ', NULL';
        else
            $query = $query . ', ' . $CzasNaprawy;
        
        if(strlen($Cena)==0)
            $query = $query . ', NULL';
        else
            $query = $query . ', ' . $Cena;
        
        if(strlen($Rabat)==0)
           $query = $query . ', 0';
        else
            $query = $query . ', ' . $Rabat;
        
        $query = $query . ')';
        
        //Wstawiam dane do bazy
        if(($result = mysql_query($query))==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        
        mysql_close($link);
        return(1);
    }
    
    function Edytuj($idZlecenia, $Data, $Status, $idKlienta, $Cena, $CzasNaprawy, $Rabat)
    {
        if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
            return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db(DB_NAME)==false) 
            return('Nie można połączyć się z bazą danych');

        $query = 'SELECT COUNT(*) FROM Zlecenia WHERE idZlecenia='.$idZlecenia;
        if(($odpowiedz=mysql_query($query))==false)
           return('Baza danych nie odpowiada na zapytanie '. $query);
        
        $result=mysql_fetch_row($odpowiedz);
        if($result[0]!=1)
            return('Nie ma zlecenia o id '.$idZlecenia.' lub jest wielu o tym samym id');

        //Sprawdzenie czy istnieje klient o podanym id
        $query = 'SELECT COUNT(*) FROM Klienci WHERE idKlienta='.$idKlienta;
        if(($odpowiedz=mysql_query($query))==false)
           return('Baza danych nie odpowiada na zapytanie '. $query);       
        $result=mysql_fetch_row($odpowiedz);
        if($result[0]!=1)
            return('Nie ma klienta o id '.$idZlecenia.' lub jest wielu o tym samym id');
        
        $count=0;
        
        //Tworzenie zapytania
        $query = 'Update Zlecenia ';
        
        //Zmiana Daty
        if(strlen($Data)>0)
        {
            $query = $query . ' Set Data = "'.$Data.'"';
            $count = $count + 1;
        }
        
        //Zmiana Statusu
        if(strlen($Status)>0)
        {
            $Status = strtolower($Status);
            $Status[0] = strtoupper($Status[0]);
            if($Status == 'Przyjete' || $Status == Zakonczone || $Status == CzekaNaOdbior)
            {
                if($count == 0)
                    $query = $query . ' Set Status = "'.$Status.'"';
                else
                $query = $query . ', Status = "'.$Status.'"';
                $count = $count + 1;
            }
            else
            {
                
            }
        }
        
        //Zmiana ID Klienta
        if(strlen($idKlienta)>0)
        {
            if($count == 0)
                $query = $query . ' Set idKlienta = "'.$idKlienta.'"';
            else
            $query = $query . ', idKlienta = "'.$idKlienta.'"';
            $count = $count + 1;
        }
        
        //Zmiana Ceny
        if(strlen($Cena)>0)
        {
            if($count == 0)
                $query = $query . ' Set Cena = "'.$Cena.'"';
            else
            $query = $query . ', Cena = "'.$Cena.'"';
            $count = $count + 1;
        }
        
        //Zmiana Czasu Naprawy
        if(strlen($CzasNaprawy)>0)
        {
            if($count == 0)
                $query = $query . ' Set CzasNaprawy = "'.$CzasNaprawy.'"';
            else
            $query = $query . ', CzasNaprawy = "'.$CzasNaprawy.'"';
            $count = $count + 1;
        }
        
        //Zmiana Rabatu
        if(strlen($Rabat)>0)
        {
            if($count == 0)
                $query = $query . ' Set Rabat = '.$Rabat;
            else
            $query = $query . ', Rabat = '.$Rabat;
            $count = $count + 1;
        }

        //Zmiana danych klienta w bazie danych
        $query = $query . ' Where idZlecenia = ' . $_GET['idZlecenia'];
        if(mysql_query($query)==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        mysql_close($link);
        
        return 1;
    }
}
