<?php
class sairController extends controller{
    public function index() {
        unset($_SESSION['logado']);
        $this->loadTemplate('home');
    }
}

