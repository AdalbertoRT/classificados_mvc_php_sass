<?php
class Anuncios extends model {

    public function getUltimosAnuncios($offset, $perPage, $filtros){
        $array = array();
        
        $filtrostring = array('1=1');
        if(!empty($filtros['categoria'])){
            $filtrostring[] = 'anuncios.id_categoria = :id_categoria';
        }if(!empty($filtros['preco'])){
            $filtrostring[] = 'anuncios.valor BETWEEN :precoi AND :precof';
        }if(!empty($filtros['estado'])){
            $filtrostring[] = 'anuncios.estado = :estado';
        }

        $sql = "SELECT *, (select anuncio_imagens.url_img from anuncio_imagens where id_anuncio = anuncios.id limit 1 ) as url_img, (select nome from categorias where id = id_categoria) as cat FROM anuncios WHERE ".implode(' AND ', $filtrostring)." ORDER BY id DESC LIMIT $perPage OFFSET $offset";
        
        $sql = $this->conn->prepare($sql);
        if(!empty($filtros['categoria'])){
            $sql->bindValue(':id_categoria', $filtros['categoria']);
        }if(!empty($filtros['preco'])){
            $preco = explode('-', $filtros['preco']);
            $sql->bindValue(':precoi', $preco[0]);
            if($preco[1] == ''){
                $preco[1] = 9999999999;
            }
            $sql->bindValue(':precof', $preco[1]);
        }if(!empty($filtros['estado'])){
            $sql->bindValue(':estado', $filtros['estado']);
        }
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function qtdAnuncios($filtros) {
        $filtrostring = array('1=1');
        if(!empty($filtros['categoria'])){
            $filtrostring[] = 'anuncios.id_categoria = :id_categoria';
        }if(!empty($filtros['preco'])){
            $filtrostring[] = 'anuncios.valor BETWEEN :precoi AND :precof';
        }if(!empty($filtros['estado'])){
            $filtrostring[] = 'anuncios.estado = :estado';
        }

        $sql = $this->conn->prepare("SELECT COUNT(*) AS q FROM anuncios WHERE ".implode(' AND ', $filtrostring));
        if(!empty($filtros['categoria'])){
            $sql->bindValue(':id_categoria', $filtros['categoria']);
        }if(!empty($filtros['preco'])){
            $preco = explode('-', $filtros['preco']);
            $sql->bindValue(':precoi', $preco[0]);
            if($preco[1] == ''){
                $preco[1] = 9999999999;
            }
            $sql->bindValue(':precof', $preco[1]);
        }if(!empty($filtros['estado'])){
            $sql->bindValue(':estado', $filtros['estado']);
        }
        $sql->execute();
        $qtd = $sql->fetch();
        return $qtd['q'];
    }

    public function getMeusAnuncios($id) {
        $array = array();
        $sql = "SELECT *, (select anuncio_imagens.url_img from anuncio_imagens where anuncio_imagens.id_anuncio = anuncios.id limit 1) as url_img FROM anuncios WHERE id_usuario = :id_usuario";
        $sql = $this->conn->prepare($sql);
        $sql->bindValue(":id_usuario", $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getAnuncio($id) {
        $array = array();
        $sql = "SELECT *, (select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria, (select usuarios.nome from usuarios where usuarios.id = anuncios.id_usuario) as anunciante, (select usuarios.telefone from usuarios where usuarios.id = anuncios.id_usuario) as telefone FROM anuncios WHERE id = :id";
        $sql = $this->conn->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }

    public function getImagens($id_anuncio) {
        $array = array();
        $sql = "SELECT * FROM anuncio_imagens WHERE id_anuncio = :id_anuncio";
        $sql = $this->conn->prepare($sql);
        $sql->bindValue(':id_anuncio', $id_anuncio);
        $sql->execute();
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        
        return $array;
    }

    public function add_anuncio($id_usuario, $id_categoria, $titulo, $preco, $descricao, $estado) {
        $sql = "INSERT INTO anuncios SET id_usuario = ?, id_categoria = ?, titulo = ?, valor = ?, descricao = ?, estado = ?";
        $sql = $this->conn->prepare($sql);
        $sql->execute(array($id_usuario, $id_categoria, $titulo, $preco, $descricao, $estado));
        //Cadastrar a imagem
        // $id = $this->conn->lastInsertId();
        // $sql = "INSERT INTO anuncio_imagens SET id_anuncio = ?, url_img = ?";
        // $sql = $this->conn->prepare($sql);
        // $sql->execute(array($id, $img));

    }

    public function editAnuncio($id, $id_usuario, $id_categoria, $titulo, $valor, $descricao, $estado, $img) {
        $sql = "UPDATE anuncios SET id_usuario = ?, id_categoria = ?, titulo = ?, valor = ?, descricao = ?, estado = ? WHERE id = ?";
        $sql = $this->conn->prepare($sql);
        $sql->execute(array($id_usuario, $id_categoria, $titulo, $valor, $descricao, $estado, $id));

        if(count($img) > 0) {
            for($q = 0; $q < count($img); $q++) {
                $sql = "INSERT INTO anuncio_imagens SET id_anuncio = ?, url_img = ?";
                $sql = $this->conn->prepare($sql);
                $sql->execute([$id, $img[$q]]);
            }
        }
    }

    public function deleteAnuncio($id) {
        $sql = "DELETE FROM anuncio_imagens WHERE id_anuncio = :id";
        $sql = $this->conn->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();

        $sql = "DELETE FROM anuncios WHERE id = :id";
        $sql = $this->conn->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function excluirImg($id, $anuncio) {
        $sql = $this->conn->prepare('SELECT url_img FROM anuncio_imagens  WHERE id = :id AND id_anuncio = :id_anuncio');
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_anuncio', $anuncio);
        $sql->execute();
        if($sql->rowCount() > 0){
            $img_dir = $sql->fetch();
            unlink("assets/images/anuncios/".$img_dir['url_img']);
        }
        
        $sql = $this->conn->prepare('DELETE FROM anuncio_imagens WHERE id = :id AND id_anuncio = :id_anuncio');
        $sql->bindValue(':id', $id);
        $sql->bindValue(':id_anuncio', $anuncio);
        $sql->execute();

    }
}