<?php

class Log{
	public static $ar;

	public static function guardaArchivo($ar){
		self::$ar = $ar;
	}
	public static function escribeArchivo($texto){
		fwrite(self::$ar, "Escribo: $texto\r\n");
	}
	public function __destruct(){
		fclose(self::$ar);
	}
}