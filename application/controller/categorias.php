<?php

class Categorias extends Controller{
    
    public function index(){
        //debe mostrar un listado de todas las categorias
        $this->view->title = "Categorias de términos";
        $this->view->render("categorias/index");
    }
    
    public function vertodas(){
        $model = $this->loadModel("CategoriasModel");
        $this->view->categorias = $model->getAll();
        $this->view->render("categorias/vertodas", true);
    }
    
    public function expandir($id_cat){
        $model = $this->loadModel("CategoriasModel");
        if(isset($id_cat)){
            $this->view->datosCategoria = $model->expandir($id_cat);
            $this->view->render("categorias/expandir", true);
        }
    }
    
    public function editar($id_cat){
        $model = $this->loadModel("CategoriasModel");
        if(isset($id_cat)){
            $this->view->datosCategoria = $model->get($id_cat);
            $this->view->render("categorias/get", true);
        }
    }
    
    /*
     * Esta es una alternativa para que te muestres con el ajax el resultado de ejecutar esto
     * 
     *public function salvaredicion(){
        if(isset($_POST["id_categoria"], $_POST["categoria"])){
            $model = $this->loadModel("CategoriasModel");
            if($model->salvaredicion($_POST["id_categoria"], $_POST["categoria"]))
                echo "Salvado con éxito";
            else
                echo "Error al salvar";
        }else{
            echo "No tengo datos";
        }
    }
    */
    
    public function salvaredicion(){
        if(isset($_POST["id_categoria"], $_POST["categoria"])){
            $model = $this->loadModel("CategoriasModel");
            if($model->salvaredicion($_POST["id_categoria"], $_POST["categoria"]))
                 $_SESSION["feedback_positive"][] = "Salvado con éxito";
            else
                $_SESSION["feedback_negative"][] = "Error al salvar";
        }else{
            $_SESSION["feedback_negative"][] = "No tengo datos";
        }
        header("location: " . URL . "categorias");
    }
}