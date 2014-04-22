<?php

class Cadenas{
    public static function cadena_romper_sin_cortar_palabra($cadena, $longitud){
        if(strlen($cadena) <= $longitud)
            return $cadena;
        $lineas = wordwrap ($cadena, $longitud, "-###-");
        $lineas = substr($lineas, 0, strpos($lineas, "-###-"));
        return $lineas;
    }
}
