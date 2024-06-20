<?php
include 'db.php';

if(!$_SESSION['email']){
    header('Location: index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    $sql = "INSERT INTO produtos (nome, descricao, preco) VALUES ('$nome', '$descricao', '$preco')";

    if ($conn->query($sql) === TRUE) {
        header('Location: controle.php');
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
    <h1>Adicionar Novo Produto</h1>
    <form action="create.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"></textarea><br>
        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" required><br>
        <input type="submit" value="Adicionar Produto">
    </form>
    <a href="controle.php">Voltar para a Página Inicial</a>
</body>
</html>
