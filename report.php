<?php
include 'db.php';

if(!$_SESSION['email']){
    header('Location: index.php');
}

$sql = "SELECT * FROM produtos";
$resultado = $conn->query($sql);

$total_produtos = 0;
$valor_total = 0.00;

while ($linha = $resultado->fetch_assoc()) {
    $total_produtos++;
    $valor_total += $linha['preco'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Produtos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Relatório de Produtos</h1>
    <p>Total de Produtos: <?php echo $total_produtos; ?></p>
    <p>Valor Total: R$<?php echo number_format($valor_total, 2); ?></p>
    <a href="controle.php">Voltar para a Página Inicial</a>
</body>
</html>
