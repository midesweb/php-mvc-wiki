<?php

class Auth{
    //esta función se encarga de asegurar que el usuario está autenticado
    //si no está autenticado, envia al usuario a la página de login
     public static function handleLogin()
    {
        // if user is still not logged in, then destroy session, handle user as "not logged in" and
        // redirect user to login page
        if (!isset($_SESSION['usuario_logueado'])) {
            session_unset();
            $_SESSION["origen"] = $_SERVER['REQUEST_URI'];
            header('location: ' . URL . 'login');
            exit();
        }
    }
    
    public static function autenticado(){
        if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado']===true)
            return true;
        return false;
    }
}
