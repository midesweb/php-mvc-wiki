<?php

class Contacto extends Controller{
    public function index(){
        //d("estoy en el método index controlador Contacto");
        $this->view->render("contacto/index");
    }
    
    public function directoria(){
        $this->view->render("contacto/directoria");
    }
    
    public function rrhh(){
        $this->view->render("contacto/rrhh");
    }
}