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

        $count=0;
        
        //Zmiana danych klienta w bazie danych
        $query = 'Update Zlecenia ';
        
        //Zmiana Daty
        if(strlen($Data)>0)
        {
            $query = $query . ' Set $Data = "'.$_GET['$Data'].'"';
            $count = $count + 1;
        }
        
        //Zmiana Imienia
        if(strlen($Status>0))
        {
            if($count == 0)
                $query = $query . ' Set Status = "'.$_GET['$Status'].'"';
            else
            $query = $query . ', Status = "'.$_GET['$Status'].'"';
            $count = $count + 1;
        }
        
        //Zmiana Nazwiska
        if(strlen($Nazwisko>0))
        {
            if($count == 0)
                $query = $query . ' Set Nazwisko = "'.$_GET['Nazwisko'].'"';
            else
            $query = $query . ', Nazwisko = "'.$_GET['Nazwisko'].'"';
            $count = $count + 1;
        }
        
        //Zmiana Adresu
        if(strlen($Adres>0))
        {
            if($count == 0)
                $query = $query . ' Set Adres = "'.$_GET['Adres'].'"';
            else
            $query = $query . ', Adres = "'.$_GET['Adres'].'"';
            $count = $count + 1;
        }
        
        //Zmiana e-mailu
        if(strlen($Email>0))
        {
            if($count == 0)
                $query = $query . ' Set Email = "'.$_GET['Email'].'"';
            else
            $query = $query . ', Email = "'.$_GET['Email'].'"';
            $count = $count + 1;
        }
        
        //Zmiana Telefonu
        if(strlen($Telefon>0))
        {
            if($count == 0)
                $query = $query . ' Set Telefon = '.$_GET['Telefon'];
            else
            $query = $query . ', Telefon = '.$_GET['Telefon'];
            $count = $count + 1;
        }
        
        $query = $query . ' Where idKlienta = ' . $_GET['idKlienta'];
        
        if(mysql_query($query)==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        mysql_close($link);
        
        return 1;
    }

}
