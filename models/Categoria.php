<?php
class Categoria extends model {

    public function getCategorias() {
        $array = array();
        $sql = "SELECT * FROM categorias";
        $sql = $this->conn->query($sql);
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
}