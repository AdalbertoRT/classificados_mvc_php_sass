<?php
class itemController extends controller {

    public function index($i){
        $a = new Anuncios();
        
        $dados = array('imagens' => $a->getImagens(addslashes($i)),
                        'info' => $a->getAnuncio(addslashes($i)) );
        $this->loadTemplate('item', $dados);
    }
}