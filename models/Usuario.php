<?php
class Usuario extends model {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $telefone;

    // public function __construct($email = '', $senha = ''){
    //     $this->conn = null;
    //     if(!empty($email) && !empty($senha)) {
    //         $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
    //         $sql = $this->conn->prepare($sql);
    //         $sql->execute(array($email, $senha));
    //         if($sql->rowCount() > 0) {
    //             $dados = $sql->fetch();
    //             $this->id = $dados['id'];
    //             $this->nome = $dados['nome'];
    //             $this->email = $dados['email'];
    //             $this->senha = $dados['senha'];
    //             $this->telefone = $dados['telefone'];
    //         }
    //     }
    // }

    public function getId() {
        return $this->id;
    }
    public function setNome($n){
        $this->nome = $n;
    }    
    public function getNome() {
        return $this->nome;
    }
    public function setEmail($e){
        $this->email = $e;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setSenha($s){
        $this->senha = md5($s);
    }
    public function setTelefone($t){
        $this->telefone = $t;
    }
    public function getTelefone() {
        return $this->telefone;
    }

    public function existe($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $sql = $this->conn->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    
    public function add($nome, $email, $senha, $telefone){
        if ($this->existe($email)) {
            header("Location: ".BASE_URL."cadastro?msg=existe");
        }else{
            $sql = "INSERT INTO usuarios (nome, email, senha, telefone) VALUES (?, ?, ?, ?)";
            $sql = $this->conn->prepare($sql);
            $sql->execute(array($nome, $email, md5($senha), $telefone));
            $this->login($email, md5($senha));
            header("Location: ".BASE_URL);
        }
    }

    public function login($email, $senha) {
        if(!empty($email) && !empty($senha)) {
            $sql = "SELECT id, nome, email, telefone FROM usuarios WHERE email = ? AND senha = ?";
            $sql = $this->conn->prepare($sql);
            $sql->execute([$email, md5($senha)]);
            if($sql->rowCount() > 0){
                $_SESSION['logado'] = $sql->fetch();
                header("Location: ".BASE_URL."home");
            }else{
                header("Location: ".BASE_URL."login?msg=invalido");
            }
        }
    }
     public function qtdUsers(){
         $sql = $this->conn->query("SELECT COUNT(*) AS q FROM usuarios");
         $qtd = $sql->fetch();
         return $qtd['q'];
     }
}