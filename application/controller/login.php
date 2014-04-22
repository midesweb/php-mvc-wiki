<?php
class Login extends Controller{
    
    function index(){
        if(Auth::autenticado()){
           $this->view->title = "Login realizado";
           $this->view->render("login/login_correcto"); 
        }else{
            $this->cargaDatosFeedback();
            $this->view->title = "Login de usuarios";
            $this->view->render("login/index");
        }
    }
    
    public function dologin(){
        
        $loginModel = $this->loadModel("loginmodel");
        $exito = $loginModel->login();
        
        if($exito){
            $this->view->title = "Login realizado";
            if(isset($_SESSION["origen"])){
                $origen = $_SESSION["origen"];
                $_SESSION["origen"] = null;
                header("location: " . $origen);
                exit();
            }
            $this->view->render("login/login_correcto");
        }else{
            //d($_SESSION);
            header("location: " . URL . "login");
            exit();
        }
    }
    
    public function salir(){
        $loginModel = $this->loadModel("loginmodel");
        $loginModel->salir();
        header("location: " . URL);
        exit();
    }
    
    private function cargaDatosFeedback(){
        if(isset($_SESSION["error_login"]) && !is_null($_SESSION["error_login"])){
            $this->view->error_login = $_SESSION["error_login"];
            $_SESSION["error_login"] = null;
        }
    }
    
    public function loginWithCookie()
    {
        // run the loginWithCookie() method in the login-model, put the result in $login_successful (true or false)
        $login_model = $this->loadModel('loginmodel');
        $login_successful = $login_model->loginWithCookie();

        if (!$login_successful) {
            Log::escribeArchivo("No hubo login con cookie");
            // delete the invalid cookie to prevent infinite login loops
            $login_model->deleteCookie();
            // if NO, then move user to login/index (login form) (this is a browser-redirection, not a rendered view)
            header('location: ' . URL . 'login/index');
        }else{
            Log::escribeArchivo("Sí hice el login con cookie");
            header('location: ' . URL . 'dashboard/index');
        }
        
        exit();
    }
}