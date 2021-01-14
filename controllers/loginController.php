<?php
class loginController extends controller {

    public function index() {
        if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
            $usuario = new Usuario();
            $usuario->login(addslashes($_POST['email']), $_POST['senha']);
            $this->loadTemplate('home');
        }else{
            $this->loadTemplate('login');
        }
    }
}