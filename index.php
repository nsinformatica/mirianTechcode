<?php
require_once 'pessoa.php';
$p = new Pessoa("banco","localhost", "root", "senha");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Cadastro Pessoa - contato@netosales.com.br</title>
	<link rel="stylesheet" href="estilo.css">
</head>
<body>
    <?php
    if(isset($_POST['nome'])){
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        if(!empty($nome) && !empty($telefone) && !empty($email)){
            //Caso tenha preenchido, enviar para a função cadastrar
            if(!$p->cadastrarPessoa($nome, $telefone, $email)){
                   
            echo "Email já está cadastrado!";
            }
            
        }else {
            echo "Preencha todos os campos!!!";
        }
    }
    ?>
	<?php
	    if(isset($_GET['$id_up'])){
	        $id_update = addslashes($_GET['$id_up']);
	        $res = $p->buscarDadosPessoa($id_update);
	        
	        
	    }
	?>
	<section id="esquerda">
		<form method="POST">
			<h2>Cadastrar Pessoa</h2>
			<label for="nome">Nome</label>
			<input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['nome'];}?>">
			<label for="telefone">Telefone</label>
			<input type="text" name="telefone" id="telefone" value="<?php if(isset($res)){echo $res['telefone'];}?>">
			<label for="email">Email</label>
			<input type="email" name="email" id="email" value="<?php if(isset($res)){echo $res['email'];}?>">
			<input type="submit" value="<?php if(isset($res)){echo "Atualizar";}else{echo "Cadastrar";}?>">
		</form>
	</section>
	<section id="direita">
	    <table>
			<tr id="titulo">
				<td>NOME</td>
				<td>TELEFONE</td>
				<td colspan="2">EMAIL</td>
			</tr>
	    <?php
	        $dados = $p->buscarDados();
	        if(count($dados) > 0){
	            for($i=0;$i<count($dados);$i++){
	                echo "<tr>";
	                foreach($dados[$i] as $k => $v){
	                    if($k != "id_pessoa"){
	                       echo "<td>".$v."</td>"; 
	                    }
	                }
	                ?><td><a href="index.php?id_up=<?php echo $dados[$i]['id_pessoa']?>">Editar</a><a href="index.php?id=<?php echo $dados[$i]['id_pessoa']?>">Excluir</a></td><?php
	                echo "</tr>";
	            }
	            
	        }else {//O BANCO DE DADOS ESTÁ VAZIO
	            echo "Ainda não há pessoas cadastradas";    
	        }
	    ?>
		
			
				
				
			
		</table>
	</section>

</body>
</html>
<?php
    if(isset($_GET['id'])){
        $id_pessoa2 = addslashes($_GET['id']);
        $p->excluirPessoa($id_pessoa2);
        header("Location: index.php");
    }
    
?>