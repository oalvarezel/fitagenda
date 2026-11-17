
<?php

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método não permitido.');
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

$nome = trim($_POST['nome_aluno'] ?? '');
$atividade = $_POST['atividade'] ?? '';
$data = $_POST['data_aula'] ?? '';
$horario = $_POST['horario'] ?? '';
$status = $_POST['status'] ?? '';

if (!$id || $id <= 0 || $nome === '' || mb_strlen($nome) > 100) {
    http_response_code(400);
    exit('ID ou nome inválido.');
}

if (
    !in_array($atividade, ['Musculação', 'Pilates', 'Funcional'], true) ||
    !in_array($status, ['agendado', 'concluido', 'cancelado'], true)
) {
    http_response_code(400);
    exit('Atividade ou status inválido.');
}

$dataValida = DateTimeImmutable::createFromFormat('!Y-m-d', $data);

if (
    !$dataValida ||
    $dataValida->format('Y-m-d') !== $data ||
    !preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $horario)
) {
    http_response_code(400);
    exit('Data ou horário inválido.');
}

$agora = new DateTimeImmutable(
    'now',
    new DateTimeZone('America/Sao_Paulo')
);

if (
    $status === 'agendado' &&
    (
        $data < $agora->format('Y-m-d') ||
        (
            $data === $agora->format('Y-m-d') &&
            $horario <= $agora->format('H:i')
        )
    )
) {
    http_response_code(400);
    exit('Não é possível agendar uma aula no passado.');
}

$sql = "UPDATE agendamentos
        SET nome_aluno = ?,
            atividade = ?,
            data_aula = ?,
            horario = ?,
            status = ?
        WHERE id = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $nome,
    $atividade,
    $data,
    $horario,
    $status,
    $id
]);

header('Location: ../list/lista.php?sucesso=edicao');
exit;
