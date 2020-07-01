<?php
Class Pessoa{
    private $pdo;
    public function __construct($dbname, $host, $user, $senha)
    {
        try{
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user,$senha);
        }catch(PDOException $e){
           echo "Erro com banco de dados: ".$e->getMessage();
           exit();
        }catch(Exception $e){
            echo "Erro Genericos: ".$e->getMessage();
            exit();
        }
        
    }
    public function buscarDados()
    {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY id_pessoa DESC");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
        
    }
    public function cadastrarPessoa($nome, $telefone, $email){
        $cmd = $this->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE email = :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();
        if($cmd->rowCount() > 0){ // já existe no banco de dados
            return false;
        }else { // Nao foi encontrado. Cadastre
            $cmd = $this->pdo->prepare("INSERT INTO pessoa (nome, telefone, email) VALUES (:n, :t, :e)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);
            $cmd->execute();
            return true;
        }
    }
    public function excluirPessoa($id){
        $cmd = $this->pdo->prepare("DELETE FROM pessoa  WHERE id_pessoa = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        
    }
    //BUSCAR DADOS DE UMA PESSOA
   public function buscarDadosPessoa($id){
      $res  = array();
      $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id_pessoa = :id");
      $cmd->bindValue(":id", $id);
      $cmd->execute();
      $res = $cmd->fetch(PDO::FETCH_ASSOC);
      return $res;
      
   } 
    //ATUALIZAR DADOS NO BANCO
    public function atualizarDadosPessoa(){
        
    }
}
?>