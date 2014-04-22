<?php

class LoginModel extends Model{
    
    public function login(){
        if(!isset($_POST["email"]) || !isset($_POST["clave"])){
            //es que no recibo datos del form.
            $_SESSION["error_login"] = "No recibo datos del form";
            return false;
        }
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $_SESSION["error_login"] = "Debes indicar un email válido como login";
            return false;
        }
        if($_POST["clave"]==""){
            $_SESSION["error_login"] = "Debes escribir una clave";
            return false;
        }
        
        $sql = "SELECT nombre, id_usuario, id_perfil FROM usuario WHERE login=:email and pass=:clave";
        $query = $this->db->prepare($sql);
        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
        $query->bindValue(":clave", sha1($_POST["clave"]), PDO::PARAM_STR);
        //$query->debugDumpParams();
        $query->execute();
        
        //miro cuántos registros tengo
        $cuantos =  $query->rowCount();
        if($cuantos != 1){
            $_SESSION["error_login"] = "No he encontrado el usuario y clave que se corresponden";
            return false;
        }
        
        //estoy aquí es que todo ha ido bien
        $usuario = $query->fetch();
        $_SESSION["usuario_logueado"] = true;
        
        $_SESSION["email"] = $_POST["email"];
        //$_SESSION["clave"] = sha1($_POST["clave"]);
        $_SESSION["nombre"] = $usuario->nombre;
        $_SESSION["id_usuario"] = $usuario->id_usuario;
        //$_SESSION["perfil"] = $usuario->perfil;
        $_SESSION["id_perfil"] = $usuario->id_perfil;
        
        //miro si tengo que recordar este usuario
        if(isset($_POST["recordarme"]) && $_POST["recordarme"]==="1"){
            //tengo que realizar el proceso para recordar al usuario
            // generate 64 char random string
            $random_token_string = hash('sha256', mt_rand());
            //Escribo el token en la base de datos
            $sql = "update usuario set token_recordarme = :token_recordarme where id_usuario = :id_usuario";
            $query = $this->db->prepare($sql);
            $query->bindValue(":token_recordarme", $random_token_string);
            $query->bindValue(":id_usuario", $usuario->id_usuario);
            $query->execute();
            
            // generate cookie string that consists of user id, random string and combined hash of both
            $cookie_string_first_part = $usuario->id_usuario . ':' . $random_token_string;
            $cookie_string_hash = hash('sha256', $cookie_string_first_part);
            $cookie_string = $cookie_string_first_part . ':' . $cookie_string_hash;
            
            //d($cookie_string);
            //exit();
            
            // set cookie
            setcookie('rememberme', $cookie_string, time() + COOKIE_RUNTIME, "/", COOKIE_DOMAIN);
        }
        
        return true;
    }
    
    public function salir(){
        session_unset();
        $_SESSION = array();
        session_destroy();
        $this->deleteCookie();
    }
    
    // va a intentar generar una sesión de login por medio de una cookie
    //devolverá simplemente un true o un false, igual que el método que genera el login del POST
    public function loginWithCookie(){
        $cookie = isset($_COOKIE["rememberme"]) ? $_COOKIE["rememberme"] : "";
        
        if(!$cookie){
            return false;
        }
        
        //separo los datos de la cookie
        list ($user_id, $token, $hash) = explode(':', $cookie);
        
        //compruebo que el hash del final es el que debe de ser
        if ($hash !== hash('sha256', $user_id . ':' . $token)) {
            $_SESSION["error_login"] = "La cookie está corrupta";
            return false;
        }
        
        // do not log in when token is empty
        if (empty($token)) {
            d("Token esta vacio"); exit();
            return false;
        }
        
        $sql = "SELECT id_usuario, nombre, login, id_perfil from usuario where id_usuario=:id_usuario and token_recordarme=:token and token_recordarme is not null";
        $query = $this->db->prepare($sql);
        $query->execute(array(":id_usuario" =>$user_id, ":token"=>$token));
        $count =  $query->rowCount();
        if ($count == 1) {
            // fetch one row (we only have one result)
            $result = $query->fetch();
            // TODO: this block is same/similar to the one from login(), maybe we should put this in a method
            // write data into session
            $_SESSION["usuario_logueado"] = true;
            $_SESSION['id_usuario'] = $result->id_usuario;
            $_SESSION['nombre'] = $result->nombre;
            $_SESSION["email"] = $result->login;
            return true;
        }
        $_SESSION["error_login"] = "La cookie no concuerda con un usuario";
        return false;
    }
    
    //borro la cookie de "recordarme"
    public function deleteCookie()
    {
        // set the rememberme-cookie to ten years ago (3600sec * 365 days * 10).
        // that's obviously the best practice to kill a cookie via php
        // @see http://stackoverflow.com/a/686166/1114320
        setcookie('rememberme', false, time() - (3600 * 3650), '/', COOKIE_DOMAIN);
    }
}