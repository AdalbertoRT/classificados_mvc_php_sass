<?php
class cadastroController extends controller {
    
    public function index() {
        if(isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){
            $usuario = new Usuario();
            $usuario->add($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['telefone']);
            $this->loadTemplate('home');
        }
        $this->loadTemplate('cadastro');
    }
}