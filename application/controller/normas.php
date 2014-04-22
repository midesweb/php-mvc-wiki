<?php

class Normas extends Controller{
    
    public function index(){
        $this->view->title = "Normas de la comunidad";
        $this->view->render("normas/index");
    }
    public function administracion(){
        $this->view->title = "Normas de la comunidad / Admin";
        $this->view->render("normas/administracion");
    }
    public function licencias(){
        $this->view->title = "Normas de la comunidad / Licencia de uso";
        $this->view->render("normas/licencias");
    }
}