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

    $sql = "DELETE FROM produtos WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: controle.php');
        exit();
    } else {
        echo "Erro ao excluir o registro: " . $conn->error;
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
    <title>Excluir Produto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="delete.php" method="post">
        <h1>Excluir Produto</h1>
        <p id="excluir">Tem certeza que deseja excluir este produto?</p>
        <p><?php echo htmlspecialchars($produto['nome']); ?></p>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($produto['id']); ?>">
        <input type="submit" id="excluir2" value="Excluir">
       
        <a class="btn" href="controle.php">Voltar para a Página Inicial</a>
    </form>
</body>
</html>
