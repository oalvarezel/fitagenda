<?php

// Inclui a conexão com o banco de dados.
require_once __DIR__ . '/../config/database.php';

// Permite a exclusão somente pelo método POST.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método não permitido.');
}

// Recebe e valida o ID do agendamento.
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

// Impede a exclusão caso o ID seja inválido.
if (!$id || $id <= 0) {
    http_response_code(400);
    exit('ID inválido.');
}

// Comando SQL para excluir apenas o agendamento selecionado.
$sql = "DELETE FROM agendamentos WHERE id = ?";

// Prepara a consulta para reduzir o risco de SQL Injection.
$stmt = $pdo->prepare($sql);

// Executa a exclusão utilizando o ID recebido.
$stmt->execute([$id]);

// Redireciona o usuário para o gerenciamento de agendamentos.
header('Location: ../pages/lista.php');

// Encerra a execução do script.
exit;
