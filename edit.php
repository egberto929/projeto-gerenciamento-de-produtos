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
    $id = $conn->real_escape_string($_POST['id']);
    $nome = $conn->real_escape_string($_POST['nome']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $preco = $conn->real_escape_string($_POST['preco']);

    $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco='$preco' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: controle.php');
        exit();
    } else {
        echo "Erro ao atualizar o registro: " . $conn->error;
    }
}

$id = $conn->real_escape_string($_GET['id']);
$sql = "SELECT * FROM produtos WHERE id=$id";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $produto = $resultado->fetch_assoc();
} else {
    echo "Produto não encontrado!";
    exit();
}

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
    <form action="edit.php" method="post">
        <h1>Editar Produto</h1>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($produto['id']); ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required><br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"><?php echo htmlspecialchars($produto['descricao']); ?></textarea><br>
        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" value="<?php echo htmlspecialchars($produto['preco']); ?>" required><br>

        <div class="">
            <input type="submit" value="Atualizar Produto" class="btn">
            <a class="btn" href="controle.php">Voltar para a Página Inicial</a>
        </div>
    </form>
</body>
</html>

