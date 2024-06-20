<?php include 'db.php';


if(!$_SESSION['email']){
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Gerenciamento de Produtos</h1>

        <button>
        <a href="create.php">Adicionar Novo Produto</a>
        </button>
        <table>
       
            <tbody>
                <?php
                $sql = "SELECT * FROM produtos";
                $resultado = $conn->query($sql);
                while($linha = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $linha['id']; ?></td>
                    <td><?php echo $linha['nome']; ?></td>
                    <td><?php echo $linha['descricao']; ?></td>
                    <td>R$ <?php echo number_format($linha['preco'], 2, ',', '.'); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $linha['id']; ?>" class="button">Editar</a>
                        <a href="delete.php?id=<?php echo $linha['id']; ?>" class="button">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="report.php" class="button">Ver Relatório</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
