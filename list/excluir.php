<?php
require_once 'conexao.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "DELETE FROM agendamentos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

// Redireciona de volta para a tela de listagem
header("Location: listar.php");
exit;