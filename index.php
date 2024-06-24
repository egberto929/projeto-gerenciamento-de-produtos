<?php
session_start(); 

if (isset($_POST['submit'])) {
    include 'db.php';
    
    $email = $conn->real_escape_string($_POST['email']); 
    $senha = $conn->real_escape_string($_POST['senha']); 

    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        header('Location: controle.php'); 
        exit(); 
    } else {
        echo "Senha incorreta."; 
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h1>LOGIN</h1>
        <form id="indexForm" action="index.php" method="POST">
            <label for="usuario">Email:</label>
            <input placeholder="Digite o email cadastrado" type="text" id="usuario" name="email" required>
            <label for="senha">Senha:</label>
            <input placeholder="Digite a senha cadastrada" type="password" id="senha" name="senha" required>
            <button type="submit" name="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
