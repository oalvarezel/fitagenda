<?php
require_once __DIR__ . '/../config/database.php';

// Permite apenas requisições POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método não permitido.');
}

// Recebe e valida o ID do agendamento
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id <= 0) {
    http_response_code(400);
    exit('ID inválido.');
}

// Prepara a exclusão do registro
$sql = "DELETE FROM agendamentos WHERE id = ?";

$stmt = $pdo->prepare($sql);

// Executa a exclusão utilizando o ID recebido
$stmt->execute([$id]);

// Redireciona para a listagem
header("Location: lista.php");
exit;