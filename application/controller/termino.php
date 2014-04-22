<?php

class Termino extends Controller{
    
    public function index(){
        //cargo un modelo
        $model = $this->loadModel("terminosmodel");
        //guardo en la vista los datos que me devuelve el modelo
        $this->view->terminos = $model->getAll();
        
        //otros datos en la vista
        $this->view->title = "Términos";
        
        //muestro la vista
        $this->view->render("termino/index");    
    }

    function ver($id){
        //cargo un modelo
        $model = $this->loadModel("terminosmodel");
        $this->view->detalleTermino = $model->dameTermino($id);
        
        //miro a ver si pille algo
        if($this->view->detalleTermino){
            $this->view->title = "Término: " . $this->view->detalleTermino->titulo;
            //pinto la vista
            $this->view->render("termino/ver");
        }else{
            $this->view->title = "Término no encontrado: ";
            $this->view->error_termino = "Lo sentimos pero no extá el término que buscas.";
            //mando un error 404
            header("HTTP/1.0 404 Not Found");
            header("Status: 404 Not Found");
            //pinto la vista
            $this->view->render("termino/ver_no_encontrado");
        }
    }
    
    function editar($id){
        Auth::handleLogin();
        //modelo de categorias
        $modelCategoria = $this->loadModel("CategoriasModel");
        $this->view->categorias = $modelCategoria->getAll();
        
        //modelo de terminos
        $model = $this->loadModel("terminosmodel");
        $this->view->accion = "Editar Término";
        
        //miro si recibo algo de formulario
        if(!$_POST){
            //recibo los datos del término
            $this->view->termino = $model->dameTermino($id);
        }else{
            //guardo el término
            if(isset($_POST["titulo"], $_POST["cuerpo"], $_POST["id_termino"], $_POST["id_categoria"])){
                $model->updateTermino(
                    array(
                        "titulo"=> $_POST["titulo"],
                        "cuerpo"=> $_POST["cuerpo"],
                        "id_termino"=> $_POST["id_termino"],
                        "id_categoria"=> $_POST["id_categoria"]
                    )
                );
                $this->view->termino["cuerpo"] = $_POST["cuerpo"];
                $this->view->termino["titulo"] = $_POST["titulo"];
                $this->view->termino["id_termino"] = $_POST["id_termino"];
                $this->view->termino["id_categoria"] = $_POST["id_categoria"];
            }else{
                $_SESSION["feedback_negative"][] = "No recibo los datos";
            }
        }
        //muestro el formulario para editarlo.
        $this->view->render("termino/formulario");
    }
    
    function crear(){
        Auth::handleLogin();
        //modelo de categorias
        $modelCategoria = $this->loadModel("categoriasmodel");
        $this->view->categorias = $modelCategoria->getAll();
        
        //modelo de terminos
        $model = $this->loadModel("terminosmodel");
        $this->view->accion = "Crear Término";
        
        //miro si recibo algo de formulario
        if(!$_POST){
            //muestro el formulario para crear.
            $this->view->render("termino/formulario");
        }else{
            //compruebo que recibo todo lo que necesito
            if(isset($_POST["titulo"], $_POST["cuerpo"], $_POST["id_categoria"])){
                if($id = $model->crearTermino(
                    array(
                        "titulo"=> $_POST["titulo"],
                        "cuerpo"=> $_POST["cuerpo"],
                        "id_categoria"=> $_POST["id_categoria"]
                    )
                )){
                    header("location: " . URL . "termino/ver/$id");
                }else{
                    $this->view->termino["cuerpo"] = $_POST["cuerpo"];
                    $this->view->termino["titulo"] = $_POST["titulo"];
                    $this->view->termino["id_categoria"] = $_POST["id_categoria"];
                }
            }else{
                $_SESSION["feedback_negative"][] = "No recibo los datos";
            }
             //muestro el formulario para crear.
            $this->view->render("termino/formulario");
        }
    }
    
    function buscarnormal(){
        //modelo de terminos
        $model = $this->loadModel("terminosmodel");
        if(isset($_POST["busqueda"])){
            $this->view->terminos = $model->buscar($_POST["busqueda"]);
        }else{
            $this->view->terminos = $model->getAll();
        }
        //otros datos en la vista
        $this->view->title = "Términos";
        
        //muestro la vista
        $this->view->render("termino/index");
    }
    function buscarajax($busqueda = null){
        sleep(2);
        //modelo de terminos
        $model = $this->loadModel("terminosmodel");
        if(isset($busqueda)){
            $this->view->terminos = $model->buscar($busqueda);
        }else{
            $this->view->terminos = $model->getAll();
        }        
        //muestro la vista
        $this->view->render("termino/buscarajax", true);
    }
    function buscarajaxjson($busqueda = null){
        //modelo de terminos
        $model = $this->loadModel("terminosmodel");
        $this->view->terminos = $model->buscar($busqueda);
        
        //muestro la vista
        $this->view->render("termino/buscarajaxjson", true);
    }
}