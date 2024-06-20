<?php
include 'db.php';

if(!$_SESSION['email']){
    header('Location: index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM produtos WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: controle.php');
    } else {
        echo "Erro ao excluir o registro: " . $conn->error;
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
    <title>Excluir Produto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Excluir Produto</h1>
    <p>Tem certeza que deseja excluir este produto?</p>
    <p><?php echo $produto['nome']; ?></p>
    <form action="delete.php" method="post">
        <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
        <input type="submit" value="Excluir">
    </form>
    <a href="controle.php">Voltar para a Página Inicial</a>
</body>
</html>
