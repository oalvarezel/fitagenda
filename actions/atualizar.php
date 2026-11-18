
<?php

// Importa a conexão PDO com o MySQL. __DIR__ indica a pasta deste arquivo.
require_once __DIR__ . '/../config/database.php';

// Aceita apenas POST, o método usado pelo formulário. Caso contrário, retorna HTTP 405.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método não permitido.');
}

// Recebe e valida o ID inteiro enviado pelo campo oculto do formulário de edição.
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

// Recebe os campos enviados pelo formulário. ?? usa um valor vazio se o campo não existir; trim remove espaços nas extremidades do nome.
$nome = trim($_POST['nome_aluno'] ?? '');
$atividade = $_POST['atividade'] ?? '';
$data = $_POST['data_aula'] ?? '';
$horario = $_POST['horario'] ?? '';
$status = $_POST['status'] ?? '';

// Rejeita identificadores inválidos, nomes vazios ou acima do limite de 100 caracteres.
if (!$id || $id <= 0 || $nome === '' || mb_strlen($nome) > 100) {
    http_response_code(400);
    exit('ID ou nome inválido.');
}

// Confere se atividade e status pertencem às opções aceitas pelo sistema.
if (
    !in_array($atividade, ['Musculação', 'Pilates', 'Funcional'], true) ||
    !in_array($status, ['agendado', 'concluido', 'cancelado'], true)
) {
    http_response_code(400);
    exit('Atividade ou status inválido.');
}

// Interpreta a data no formato ano-mês-dia. A comparação abaixo detecta datas inexistentes; a expressão regular verifica horas e minutos válidos.
$dataValida = DateTimeImmutable::createFromFormat('!Y-m-d', $data);

if (
    !$dataValida ||
    $dataValida->format('Y-m-d') !== $data ||
    !preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $horario)
) {
    http_response_code(400);
    exit('Data ou horário inválido.');
}

// Obtém a data e o horário atuais no fuso de Brasília para comparar com o agendamento.
$agora = new DateTimeImmutable(
    'now',
    new DateTimeZone('America/Sao_Paulo')
);

// Impede agendamentos ativos no passado, mas permite concluir ou cancelar um registro antigo.
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

// UPDATE altera os campos existentes; WHERE id = ? limita a alteração ao registro escolhido.
$sql = "UPDATE agendamentos
        SET nome_aluno = ?,
            atividade = ?,
            data_aula = ?,
            horario = ?,
            status = ?
        WHERE id = ?";

// Prepara a consulta de forma parametrizada: os dados não são concatenados diretamente ao SQL, reduzindo o risco de SQL Injection.
$stmt = $pdo->prepare($sql);

// Executa a consulta, associando os valores aos marcadores ? na ordem em que aparecem no SQL.
$stmt->execute([
    $nome,
    $atividade,
    $data,
    $horario,
    $status,
    $id
]);

// Redireciona para a listagem com o parâmetro de sucesso. exit encerra o script.
header('Location: ../list/lista.php?sucesso=edicao');
exit;
