<?php

class TerminosModel extends Model
{
    public function getAll(){
        $sql = "SELECT id_termino, titulo FROM termino";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function buscar($busqueda){
        $sql = "SELECT id_termino, titulo FROM termino where titulo LIKE :busqueda";
        $query = $this->db->prepare($sql);
        $query->bindValue(":busqueda", "%$busqueda%", PDO::PARAM_STR);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function dameTermino($id){
        $id = (int) $id;
        if($id != 0){
            $sql = "SELECT * FROM termino, categoria where termino.id_categoria = categoria.id_categoria and id_termino=:id";
            $query = $this->db->prepare($sql);
            $query->bindValue(":id", $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
        }else{
            return false;
        }
    }
    
    public function updateTermino($data){
        if(!isset($data["id_termino"]) || !isset($data["titulo"]) || !isset($data["cuerpo"]) || !isset($data["id_categoria"]) || $data["id_termino"]=="" || $data["titulo"]=="" || $data["cuerpo"]==""){
            $_SESSION["feedback_negative"][] = "No tengo todos los datos a actualizar";
            return false;
        }
        $data["titulo"] = strip_tags($data["titulo"]);
        $data["cuerpo"] = strip_tags($data["cuerpo"]);
        
        $sql = "UPDATE termino SET cuerpo=:cuerpo, titulo=:titulo, actualizacion=:time, id_categoria=:id_categoria WHERE id_termino=:id";
        $query = $this->db->prepare($sql);
        $query->bindValue(":id", $data["id_termino"], PDO::PARAM_INT);
        $query->bindValue(":id_categoria", $data["id_categoria"], PDO::PARAM_INT);
        $query->bindValue(":time", time(), PDO::PARAM_INT);
        $query->bindValue(":cuerpo", $data["cuerpo"], PDO::PARAM_STR);
        $query->bindValue(":titulo", $data["titulo"], PDO::PARAM_STR);
        $query->execute();
        
        $count =  $query->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_positive"][] = "Editado correctamente";
            return true;
        }
        
        $_SESSION["feedback_negative"][] = "Error al intentar guardar en la base de datos";
        return false;        
    }
    
    public function crearTermino($data){
        if(!isset($data["cuerpo"]) || !isset($data["titulo"]) || !isset($data["id_categoria"]) || $data["cuerpo"]=="" || $data["titulo"]=="" || $data["id_categoria"]==""){
            $_SESSION["feedback_negative"][] = "No tengo todos los datos a actualizar";
            return false;
        }
        if(!is_numeric($data["id_categoria"])){
            $_SESSION["feedback_negative"][] = "El identificador de la categoria no me gusta";
            return false;
        }
        $data["titulo"] = strip_tags($data["titulo"]);
        $data["cuerpo"] = strip_tags($data["cuerpo"]);
        
        $sql = "INSERT INTO termino (titulo, cuerpo, actualizacion, id_categoria) VALUES (:titulo, :cuerpo, :time, :id_categoria)";
        $query = $this->db->prepare($sql);
        $query->bindValue(":time", time(), PDO::PARAM_INT);
        $query->bindValue(":id_categoria", $data["id_categoria"], PDO::PARAM_INT);
        $query->bindValue(":cuerpo", $data["cuerpo"], PDO::PARAM_STR);
        $query->bindValue(":titulo", $data["titulo"], PDO::PARAM_STR);
        $query->execute();
        
        $count =  $query->rowCount();
        if ($count == 1) {
            //$_SESSION["feedback_positive"][] = "Creado correctamente";
            return $this->db->lastInsertId();
        }
        
        $_SESSION["feedback_negative"][] = "Error al intentar crear el registro en la base de datos";
        return false;  
    }
}