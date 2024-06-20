<?php
include 'db.php';

if(!$_SESSION['email']){
    header('Location: index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco='$preco' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: controle.php');
    } else {
        echo "Erro ao atualizar o registro: " . $conn->error;
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE id=$id";
$resultado = $conn->query($sql);
$produto = $resultado->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Editar Produto</h1>
    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $produto['nome']; ?>" required><br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"><?php echo $produto['descricao']; ?></textarea><br>
        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" value="<?php echo $produto['preco']; ?>" required><br>
        <input type="submit" value="Atualizar Produto">
    </form>
    <a href="controle.php">Voltar para a Página Inicial</a>
</body>
</html>
