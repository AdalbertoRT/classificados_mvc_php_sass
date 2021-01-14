<?php
class anuncioController extends controller {

    public function index() {
        $id = $_SESSION['logado'];
        $id = intval($id['id']);
        // $dados = array("imagem" => "", "titulo" => "", "valor" => "");
        $a = new Anuncios();
        $dados = array("anuncios" => $a->getMeusAnuncios($id));
        $this->loadTemplate('meus_anuncios', $dados);
    }

    public function alerts($a) {
        $id = $_SESSION['logado'];
        $id = $id['id'];
        if($a == 'editado') {
            $a = new Anuncios();
            $dados = array("anuncios" => $a->getMeusAnuncios($id), 'alerta' => 'editado');
            $this->loadTemplate('meus_anuncios', $dados);
        }elseif($a == 'deletado') {
            $a = new Anuncios();
            $dados = array("anuncios" => $a->getMeusAnuncios($id), 'alerta' => 'deletado');
            $this->loadTemplate('meus_anuncios', $dados);
        }elseif($a == 'anunciado') {
            $a = new Anuncios();
            $dados = array("anuncios" => $a->getMeusAnuncios($id), 'alerta' => 'anunciado');
            $this->loadTemplate('meus_anuncios', $dados);
        }
    }

    public function add($user_id) {
        if(empty($user_id)) {
            header("Location: ".BASE_URL."anuncio");
        }
        if(isset($_POST['titulo']) && !empty($_POST['titulo']) && isset($_POST['valor']) && !empty($_POST['valor'])) {
            $categoria = intval(addslashes($_POST['categoria']));
            $titulo = addslashes($_POST['titulo']);
            $valor = floatval(addslashes($_POST['valor']));
            $descricao = addslashes($_POST['descricao']);
            $estado = intval(addslashes($_POST['estado']));

            $a = new Anuncios();
            $a->add_anuncio($user_id, $categoria, $titulo, $valor, $descricao, $estado);
            
            header("Location: ".BASE_URL."anuncio/alerts/anunciado");
        }else {
            $c = new Categoria();
            $dados = array('categoria' => $c->getCategorias());
            $this->loadTemplate('add_anuncio', $dados);
        }
        
    }

    public function edit($id_anuncio, $user_id) {
        if(isset($_POST['titulo']) && !empty($_POST['titulo']) && isset($_POST['valor']) && !empty($_POST['valor'])) {
            
            $categoria = intval(addslashes($_POST['categoria']));
            $titulo = addslashes($_POST['titulo']);
            $valor = floatval(addslashes($_POST['valor']));
            $descricao = addslashes($_POST['descricao']);
            $estado = intval(addslashes($_POST['estado']));
            $img = array();

            // CASO ENVIE IMAGENS
            if(isset($_FILES['imagem'])) {
                if(count($_FILES['imagem']['tmp_name']) > 0){
                    for($q=0; $q < count($_FILES['imagem']['tmp_name']); $q++){
                        $tipo = $_FILES['imagem']['type'][$q];
                        if(in_array($tipo, array('image/jpeg', 'image/png'))){
                            $nomedaimg = md5($_FILES['imagem']['name'][$q].time().rand(0,9999)).'.jpg';
                            move_uploaded_file($_FILES['imagem']['tmp_name'][$q], 'assets/images/anuncios/'.$nomedaimg);

                            // REDIMENSIONAR A IMAGEM PARA UM VALOR PADRONIZADO
                            list($width_orig, $height_orig) = getimagesize('assets/images/anuncios/'.$nomedaimg);
                            $ratio = $width_orig/$height_orig;
                            $width = 500;
                            $height = 500;
                            if($width/$height > $ratio){
                                $width = $height * $ratio;
                            }else {
                                $height = $width/$ratio;
                            }
                            $nova_img = imagecreatetruecolor($width, $height);
                            if($tipo == 'image/jpeg'){
                                $orig = imagecreatefromjpeg('assets/images/anuncios/'.$nomedaimg);
                            }elseif($tipo == 'image/png'){
                                $orig = imagecreatefrompng('assets/images/anuncios/'.$nomedaimg);
                            }
                            imagecopyresampled($nova_img, $orig, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                            imagejpeg($nova_img, 'assets/images/anuncios/'.$nomedaimg, 80);

                            //$img[$q] = BASE_URL.'assets/images/anuncios/'.$nomedaimg;
                            $img[$q] = $nomedaimg;
                        }
                    }
                }
            }
            $a = new Anuncios();
            $a->editAnuncio($id_anuncio, $user_id, $categoria, $titulo, $valor, $descricao, $estado, $img);
            
        }else {
            $a = new Anuncios();
            $c = new Categoria();
            $dados = array('info' => $a->getAnuncio($id_anuncio), 'categoria' => $c->getCategorias(), 'imagens' => $a->getImagens($id_anuncio) );
            $this->loadTemplate('edit_anuncio', $dados);
            exit;
        }
        header("Location: ".BASE_URL."anuncio/alerts/editado");
    }

    public function delete($id_anuncio) {
        if(!empty($id_anuncio)){
            $a = new Anuncios();
            $a->deleteAnuncio($id_anuncio);
            header("Location: ".BASE_URL."anuncio/alerts/deletado");
        }else{
            header("Location: ".BASE_URL."anuncio/alerts/nao_deletou");
        }
       
    }

    public function excluir_img($id, $anuncio) {
        if(isset($id) && !empty($id)){
            $a = new Anuncios();
            $a->excluirImg($id, $anuncio);
            header('Location: '.BASE_URL.'anuncio/edit/'.$anuncio.'/'.$_SESSION['logado']['id']);
        }else{
            header('Location: '.BASE_URL.'anuncio/edit/'.$anuncio.'/'.$_SESSION['logado']['id']);
        }
    }

}