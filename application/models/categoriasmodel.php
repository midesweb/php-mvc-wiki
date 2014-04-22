<?php

class CategoriasModel extends Model{
    
    function getAll(){
        $sql = "SELECT * from categoria where 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    
    function expandir($id){
        $id = (int) $id;
        $sql = "SELECT categoria.categoria, categoria.id_categoria, termino.id_termino, termino.titulo from categoria,termino where categoria.id_categoria=termino.id_categoria and termino.id_categoria=:id";
        $query = $this->db->prepare($sql);
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
    }
    
    function get($id){
        $id = (int) $id;
        $sql = "SELECT categoria.categoria, categoria.id_categoria from categoria where categoria.id_categoria=:id";
        $query = $this->db->prepare($sql);
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch();
    }
    
    function salvaredicion($id, $cat){
        $id = (int) $id;
        if($id==0)
            return false;
        if(strlen($cat)<2)
            return false;
        $sql = "UPDATE categoria set categoria=:categoria where id_categoria=:id";
        $query = $this->db->prepare($sql);
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->bindValue(":categoria", $cat, PDO::PARAM_STR);
        return $query->execute();
    }
}