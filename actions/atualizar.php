
<?php

// Importa a conexão PDO com o MySQL.
require_once __DIR__ . '/../config/database.php';

// Permite apenas requisições pelo método POST.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método não permitido.');
}

// Recebe e valida o ID do agendamento.
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

// Impede a atualização caso o ID seja inválido.
if (!$id || $id <= 0) {
    http_response_code(400);
    exit('ID inválido.');
}

// Recebe os dados enviados pelo formulário de edição.
$nome = trim($_POST['nome_aluno'] ?? '');
$atividade = $_POST['atividade'] ?? '';
$data = $_POST['data_aula'] ?? '';
$horario = $_POST['horario'] ?? '';
$status = $_POST['status'] ?? '';

// Valida o nome, a atividade e o status do agendamento.
if (
    $nome === '' ||
    mb_strlen($nome) > 100 ||
    !in_array($atividade, ['Musculação', 'Pilates', 'Funcional'], true) ||
    !in_array($status, ['agendado', 'concluido', 'cancelado'], true)
) {
    http_response_code(400);
    exit('Dados do agendamento inválidos.');
}

// Verifica se a data informada possui um formato válido.
$dataValida = DateTimeImmutable::createFromFormat('!Y-m-d', $data);

// Valida a data e o horário recebidos.
if (
    !$dataValida ||
    $dataValida->format('Y-m-d') !== $data ||
    !preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $horario)
) {
    http_response_code(400);
    exit('Data ou horário inválido.');
}

// Obtém a data e o horário atuais no fuso de Brasília.
$agora = new DateTimeImmutable(
    'now',
    new DateTimeZone('America/Sao_Paulo')
);

// Impede agendamentos ativos em datas ou horários passados.
// Permite editar registros concluídos ou cancelados.
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
    exit('Não é possível agendar aulas no passado.');
}

// Comando SQL responsável por atualizar o agendamento.
$sql = "UPDATE agendamentos
        SET nome_aluno = ?,
            atividade = ?,
            data_aula = ?,
            horario = ?,
            status = ?
        WHERE id = ?";

// Prepara a consulta para reduzir o risco de SQL Injection.
$stmt = $pdo->prepare($sql);

// Executa a atualização com os dados recebidos.
$stmt->execute([
    $nome,
    $atividade,
    $data,
    $horario,
    $status,
    $id
]);

// Redireciona para a listagem com a mensagem de sucesso.
header('Location: ../pages/lista.php?sucesso=edicao');

// Encerra a execução do script.
exit;
