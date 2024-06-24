<?php
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
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

<div class="container">
    <h1>Relatório de Produtos</h1>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Total de Produtos:</th>
                <th scope="col">Valor Total:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="center"><?php echo $total_produtos; ?></td>
                <td class="center">R$ <?php echo number_format($valor_total, 2, ',', '.'); ?></td> 
            </tr>
        </tbody>
    </table>

    <a class="btn" href="controle.php">Voltar para a Página Inicial</a>
</div>

</body>
</html>

