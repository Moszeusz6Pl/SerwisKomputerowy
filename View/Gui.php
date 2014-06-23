<?php

/**
 * Klasa do generowania i wyświetlania kodu HTML
 *
 * @author Mateusz Jurasz
 */
class Gui {
    
    function show($strona, $wynik, $error=NULL)
    {
        $html=file_get_contents($strona);
        $search = array(":wynik:");
        $replace = array($wynik.$error);
        $html = str_replace($search, $replace, $html);
        echo $html;
    }
}
