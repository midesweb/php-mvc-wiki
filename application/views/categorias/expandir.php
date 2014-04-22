<?php
if(count($this->datosCategoria)>0){
    $res = array(
        "categoria" => $this->datosCategoria[0]->categoria,
        "terminos" => $this->datosCategoria
    );    
}else{
    $res = array();
}

echo json_encode($res);