<?php
class Fechas {
    public static function fecha_corta_espanol($tiempo){
        return date("d/m/Y", $tiempo);
    }
}