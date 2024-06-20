<?php

session_start();

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "gerenciamento_produtos";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
