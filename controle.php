<?php 
include 'db.php';

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['email'])){
    header('Location: index.php');
    exit();
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
        <div class="button-container">
            <a href="create.php" class="button">Adicionar Novo Produto</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM produtos";
                $resultado = $conn->query($sql);

                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while($linha = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td class="center"><?php echo htmlspecialchars($linha['id']); ?></td>
                            <td class="center"><?php echo htmlspecialchars($linha['nome']); ?></td>
                            <td class="center"><?php echo htmlspecialchars($linha['descricao']); ?></td> 
                            <td class="center">R$ <?php echo number_format($linha['preco'], 2, ',', '.'); ?></td>
                            <td class="center">
                                <a href="edit.php?id=<?php echo htmlspecialchars($linha['id']); ?>" class="button">Editar</a>
                                <a href="delete.php?id=<?php echo htmlspecialchars($linha['id']); ?>" class="button">Excluir</a>
                            </td>
                        </tr>
                        <?php endwhile;
                    } else {
                        echo "<tr><td colspan='5' class='center'>Nenhum produto encontrado</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='center'>Erro ao executar a consulta: " . $conn->error . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="button-container">
            <a href="report.php" class="button">Ver Relatório</a>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>

