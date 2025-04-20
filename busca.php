<?php
if (!isset($_GET['nome_filme'])) {
  header("Location: index.php");
  exit;
}

$nome = "%".trim($_GET['nome_filme'])."%";

$dbh = new PDO('mysql:host=127.0.0.1;dbname=buscaphp', 'root', 'imfelipegomes');

$sth = $dbh->prepare('SELECT * FROM `filmes` WHERE `nome` LIKE :nome');
$sth->bindParam(':nome', $nome, PDO::PARAM_STR);
$sth->execute();

$resultados = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Resultado da busca</title>
</head>
<body>
  <h2>Resultado da busca</h2>
  <?php
  if (count($resultados)) {
    foreach($resultados as $Resultado) {
  ?>
    <label><?php echo $Resultado['id']; ?> - <?php echo $Resultado['nome']; ?></label>
    <br>
  <?php
    }
  } else {
  ?>
    <label>Não foram encontrados resultados pelo termo buscado.</label>
  <?php
  }
  ?>
</body>
</html>