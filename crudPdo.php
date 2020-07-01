<?php
try{
	$pdo = new PDO("mysql:dbname=homerang_dbphp7;host=localhost","homerang_nsinfo","nsinfo@1972");
} catch (PDOException $e){
	echo "Erro com banco de dados: ".$e->getMessage();
} catch (Exception $e){
	echo "Erro generico: ".$e->getMessage();
}
// primeira forma 
//$res = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email) values(:n, :t, :e)");
//$res->bindValue(":n","Neto");
//$res->bindValue(":t","36472250");
//$res->bindValue(":e","contato@netosales.com.br");
//$res->execute();

//segunda forma
//$pdo->query("INSERT INTO pessoa(nome, telefone, email) values('Rubinalvo', '991222146','netocazuza@hotmail.com')");

//DELETE
//primeira forma
//$res = $pdo->prepare("DELETE FROM pessoa WHERE id_pessoa = :id");
//$id = 3;
//$res->bindValue(":id", $id);
//$res->execute();
//UPDATE
//$cmd = $pdo->prepare("UPDATE pessoa SET email = :e WHERE id_pessoa = :id");
//$cmd->bindValue(":e", "miriam@gmail.com");
//$cmd->bindValue(":id", 1);
//$cmd->execute();
//segunda forma
//$res = $pdo->query("UPDATE pessoa SET email = 'contato@netosales.com.br' WHERE id_pessoa = '2'");

$cmd = $pdo->prepare("SELECT * FROM pessoa WHERE id_pessoa = :id");
$cmd->bindValue(":id", 2);
$cmd->execute();
$resultado = $cmd->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($resultado);
echo "</pre>";
//ou
//$cmd->fetchAll();

foreach ($resultado as $key => $value)
{
	echo $key.": ".$value."<br>";
}

?>