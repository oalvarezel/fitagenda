<?php

// Carrega a conexão PDO configurada no projeto.
require_once __DIR__ . '/../config/database.php';

// Lê o ID enviado pelo botão Editar na URL (GET) e valida se é um inteiro.
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Rejeita IDs ausentes, inválidos, zero ou negativos com HTTP 400.
if (!$id || $id <=0) {
    http_response_code(400);
    exit('ID do agendamento inválido');
}

// Busca apenas o agendamento correspondente ao identificador informado.
$sql = "SELECT * FROM agendamentos WHERE id = ?";

// Prepara o SELECT com um parâmetro e executa a consulta com o ID.
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

// fetch com PDO::FETCH_ASSOC retorna os dados indexados pelos nomes das colunas.
$agendamento = $stmt->fetch(PDO::FETCH_ASSOC);

// Se o registro não existir, encerra a página com HTTP 404.
if (!$agendamento) {
    http_response_code(404);
    exit('Agendamento não encontrado.');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento | FitAgenda</title>
    <!-- Carrega os estilos gerais e os estilos dos formulários. -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/forms.css">
</head>

<body>
    <main class="pagina-formulario">
        <h1>Editar Agendamento</h1>

        <!-- Envia os dados alterados por POST ao script atualizar.php. -->
        <form action="../actions/atualizar.php" method="POST" class="formulario-agendamento">

            <!-- Campo invisível que mantém o ID do registro a atualizar. -->
            <input type="hidden"
                   name="id"
                   value="<?= (int) $agendamento['id'] ?>">

            <div>
                <!-- O value recupera o nome do banco; htmlspecialchars escapa caracteres especiais para exibição no HTML. -->
                <label for="nome_aluno">Nome do aluno</label>
                <input type="text"
                       id="nome_aluno"
                       name="nome_aluno"
                       maxlength="100"
                       value="<?= htmlspecialchars($agendamento['nome_aluno'], ENT_QUOTES, 'UTF-8') ?>"
                       required>
            </div>

            <div>
                <!-- O operador ternário aplica selected à atividade que já está salva. -->
                <label for="atividade">Atividade esportiva</label>
                <select id="atividade" name="atividade" required>
                    <option value="Musculação" <?= $agendamento['atividade'] === 'Musculação' ? 'selected' : '' ?>>Musculação</option>
                    <option value="Pilates" <?= $agendamento['atividade'] === 'Pilates' ? 'selected' : '' ?>>Pilates</option>
                    <option value="Funcional" <?= $agendamento['atividade'] === 'Funcional' ? 'selected' : '' ?>>Funcional</option>
                </select>
            </div>

            <div>
                <!-- Preenche a data atual do agendamento no campo do tipo date. -->
                <label for="data_aula">Data da aula</label>
                <input type="date"
                       id="data_aula"
                       name="data_aula"
                       value="<?= htmlspecialchars($agendamento['data_aula'], ENT_QUOTES, 'UTF-8') ?>"
                       required>
            </div>

            <div>
                <!-- substr retira os segundos do horário armazenado, mantendo HH:MM. -->
                <label for="horario">Horário da aula</label>
                <input type="time"
                       id="horario"
                       name="horario"
                       value="<?= htmlspecialchars(substr($agendamento['horario'], 0, 5), ENT_QUOTES, 'UTF-8') ?>"
                       required>
            </div>

            <div>
                <!-- Seleciona automaticamente o status salvo usando a comparação estrita e o operador ternário. -->
                <label for="status">Status do agendamento</label>
                <select id="status" name="status" required>
                    <option value="agendado" <?= $agendamento['status'] === 'agendado' ? 'selected' : '' ?>>Agendado</option>
                    <option value="concluido" <?= $agendamento['status'] === 'concluido' ? 'selected' : '' ?>>Concluído</option>
                    <option value="cancelado" <?= $agendamento['status'] === 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                </select>
            </div>

            <!-- Dispara o envio do formulário para atualizar o registro. -->
            <button type="submit">Salvar Alterações</button>

        </form>
    </main>
</body>
</html>