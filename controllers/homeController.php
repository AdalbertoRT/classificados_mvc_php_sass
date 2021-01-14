<?php
class homeController extends controller {

    public function index($p = 1) {
        $p = intval($p);
        $filtros = array(
            'categoria' => '', 'preco' => '', 'estado' => ''
        );
        if(isset($_GET['filtros'])){
            $filtros = $_GET['filtros'];
            $f = strpos($_SERVER['REQUEST_URI'], '?');
            $f = substr($_SERVER['REQUEST_URI'], $f);
            $_SESSION['filtros'] = $f;
        }
        $a = new Anuncios();
        $u = new Usuario();
        $c = new Categoria();
        $perPage = 3;
        $offset = ($p - 1) * $perPage;
        
        $dados = array(
            'qtd_anuncios' => $a->qtdAnuncios($filtros),
            'qtd_usuarios' => $u->qtdUsers(),
            'ultimos_anuncios' => $a->getUltimosAnuncios($offset, $perPage, $filtros),
            'paginas' => ceil($a->qtdAnuncios($filtros) / $perPage),
            'p' => $p,
            'categorias' => $c->getCategorias(),
            'filtros' => $filtros,
        );

        $this->loadTemplate('home', $dados);
    }

}