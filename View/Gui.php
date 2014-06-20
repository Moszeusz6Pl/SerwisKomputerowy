<?php

/**
 * Klasa do generowania i wyświetlania kodu HTML
 *
 * @author Mateusz Jurasz
 */
class Gui {
    
    function show($strona, $wynik)
    {
        $html=file_get_contents($strona);
        $search = array(":wynik:");
        $replace = array($wynik);
        $html = str_replace($search, $replace, $html);
        echo $html;
    }
}
