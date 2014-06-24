<?php

/**
 * Klasa transferowa dla encji klient
 *
 * @author Mateusz Jurasz
 */
class NaprawaDTO
{
    function Dodaj($Stan, $idZlecenia, $idSprzetu, $Opis, $Cena, $idCzesci)
    {
        if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
                return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db(DB_NAME)==false) 
            return('Nie można połączyć się z bazą danych');

        //Ustalam id kolejnego klienta
        $query = 'SELECT COUNT(*) FROM Naprawy';
        if(($result = mysql_query($query))==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        $id=mysql_fetch_row($result);
        $id=$id[0]+1;
        
       if(strlen($idZlecenia)==0)
            return('Należy wybrać klienta');
        
        //Sprawdzenie czy istnieje klient o podanym id
        $query = 'SELECT COUNT(*) FROM Zlecenia WHERE idZlecenia='.$idZlecenia;
        if(($odpowiedz=mysql_query($query))==false)
           return('Baza danych nie odpowiada na zapytanie '. $query);       
        $result=mysql_fetch_row($odpowiedz);
        if($result[0]!=1)
            return('Nie ma zlecenia o id '.$idZlecenia.' lub jest wielu o tym samym id');
        
        //Tworzenie zapytania
        $query = 'INSERT INTO Naprawy VALUES('.$id.', "'. $Stan.'", "'.$idZlecenia.'"';
        
        if(strlen($idSprzetu)==0)
            $query = $query . ', NULL';
        else
            $query = $query . ', ' . $idSprzetu;
        
        $query = $query . ', "' . $Opis .'"';
        
        if(strlen($Cena)==0)
           $query = $query . ',""';
        else
            $query = $query . ', ' . $Cena;
        
        if(strlen($idCzesci)==0)
            $query = $query . ', NULL';
        else
            $query = $query . ', ' . $idCzesci;
        
        $query = $query . ')';
        
        //Wstawiam dane do bazy
        if(($result = mysql_query($query))==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        
        mysql_close($link);
        return(1);
    }
    
    function Edytuj($idNaprawy, $Stan, $idZlecenia, $idSprzetu, $Opis, $Cena, $idCzesci)
    {
        if(($link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))==false)
            return('Brak dostepu do serwera bazy danych');

        if(mysql_select_db(DB_NAME)==false) 
            return('Nie można połączyć się z bazą danych');

        $query = 'SELECT COUNT(*) FROM Naprawy WHERE idNaprawy='.$idNaprawy;
        if(($odpowiedz=mysql_query($query))==false)
           return('Baza danych nie odpowiada na zapytanie '. $query);
        
        $result=mysql_fetch_row($odpowiedz);
        if($result[0]!=1)
            return('Nie ma zlecenia o id '.$idNaprawy.' lub jest wielu o tym samym id');

        //Sprawdzenie czy istnieje zlecenie o podanym id
        $query = 'SELECT COUNT(*) FROM Zlecenia WHERE idZlecenia='.$idZlecenia;
        if(($odpowiedz=mysql_query($query))==false)
           return('Baza danych nie odpowiada na zapytanie '. $query);       
        $result=mysql_fetch_row($odpowiedz);
        if($result[0]!=1)
            return('Nie ma zlecenia o id '.$idZlecenia.' lub jest wielu o tym samym id');
        
        $count=0;
        
        //Tworzenie zapytania
        $query = 'Update Naprawy ';
        
        //Zmiana Stanu
        if(strlen($Stan)>0)
        {
            if(($Stan == 'Przyjete') || ($Stan == 'WToku') || ($Stan == 'Zakonczone'))
            {
                    $query = $query . ' Set Stan = "'.$Stan.'"';
                $count = $count + 1;
            }
        }
        
        //Zmiana ID Zlecenia
        if(strlen($idZlecenia)>0)
        {
            $query = $query . ' Set idZlecenia = "'.$idZlecenia.'"';
            $count = $count + 1;
        }
        
        //Zmiana ID Sprzętu
        if(strlen($idSprzetu)>0)
        {
            $query = $query . ' Set idSprzetu = "'.$idSprzetu.'"';
            $count = $count + 1;
        }
        
        //Zmiana Opisu
        if(strlen($Opis)>0)
        {
            if($count == 0)
                $query = $query . ' Set Opis = "'.$Opis.'"';
            else
            $query = $query . ', Opis = "'.$Opis.'"';
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
        
        //Zmiana ID Części
        if(strlen($idCzesci)>0)
        {
            if($count == 0)
                $query = $query . ' Set idCzesci = "'.$idCzesci.'"';
            else
            $query = $query . ', idCzesci = "'.$idCzesci.'"';
            $count = $count + 1;
        }

        //Zmiana danych klienta w bazie danych
        $query = $query . ' Where idNaprawy = ' . $_GET['idNaprawy'];
        if(mysql_query($query)==false)
            return('Baza danych nie odpowiada na zapytanie '. $query);
        mysql_close($link);
        
        return 1;
    }
}
