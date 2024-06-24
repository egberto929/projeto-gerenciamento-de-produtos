<?php
include 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $conn->real_escape_string($_POST['nome']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $preco = $conn->real_escape_string($_POST['preco']);

    $sql = "INSERT INTO produtos (nome, descricao, preco) VALUES ('$nome', '$descricao', '$preco')";

    if ($conn->query($sql) === TRUE) {
        header('Location: controle.php');
        exit();
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="create.php" method="post">
        <h1>Adicionar Novo Produto</h1>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"></textarea><br>
        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" required><br>
        
        <input class="adicionar" type="submit" value="Adicionar Produto">
       
        <a href="controle.php">Voltar para a Página Inicial</a>
    </form>
</body>
</html>

