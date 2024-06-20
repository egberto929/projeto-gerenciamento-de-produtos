<?php
    

    if(isset($_POST['submit'])) {
        include 'db.php';

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "select * from usuarios where email = '$email' and senha = '$senha'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $_SESSION['email'] = $email;

            header('Location: controle.php');
        } else {
            echo "Senha incorreta " . $conn->error;
        }

    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de index</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h1>index</h1>
        <form id="indexForm" action="index.php" method="POST" type="submit">
            <label for="usuario">Email:</label>
            <input type="text" id="usuario" name="email" required>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <button  name="submit" >Entrar</button>
        </form>
        <div id="mensagem1"></div>
        <div id="mensagem2"></div>
    </div>

    <div>
        <img id="dragao"  height="100px" width="100px" src="imagens/dragao.png" alt="">
    </div>

</body>
</html>