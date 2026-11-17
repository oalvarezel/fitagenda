<?php

require_once __DIR__ . '/../config/database.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id <=0) {
    http_response_code(400);
    exit('ID do agendamento inválido');
}

$sql = "SELECT * FROM agendamentos WHERE id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$agendamento = $stmt->fetch(PDO::FETCH_ASSOC);

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

<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/forms.css">
</head>

<body>
    <main class="pagina-formulario">
        <h1>Editar Agendamento</h1>

        <form action="../actions/atualizar.php" method="POST" class="formulario-agendamento">

            <input type="hidden"
                   name="id"
                   value="<?= (int) $agendamento['id'] ?>">

            <div>
                <label for="nome_aluno">Nome do aluno</label>
                <input type="text"
                       id="nome_aluno"
                       name="nome_aluno"
                       maxlength="100"
                       value="<?= htmlspecialchars($agendamento['nome_aluno'], ENT_QUOTES, 'UTF-8') ?>"
                       required>
            </div>

            <div>
                <label for="atividade">Atividade esportiva</label>
                <select id="atividade" name="atividade" required>
                    <option value="Musculação" <?= $agendamento['atividade'] === 'Musculação' ? 'selected' : '' ?>>Musculação</option>
                    <option value="Pilates" <?= $agendamento['atividade'] === 'Pilates' ? 'selected' : '' ?>>Pilates</option>
                    <option value="Funcional" <?= $agendamento['atividade'] === 'Funcional' ? 'selected' : '' ?>>Funcional</option>
                </select>
            </div>

            <div>
                <label for="data_aula">Data da aula</label>
                <input type="date"
                       id="data_aula"
                       name="data_aula"
                       value="<?= htmlspecialchars($agendamento['data_aula'], ENT_QUOTES, 'UTF-8') ?>"
                       required>
            </div>

            <div>
                <label for="horario">Horário da aula</label>
                <input type="time"
                       id="horario"
                       name="horario"
                       value="<?= htmlspecialchars(substr($agendamento['horario'], 0, 5), ENT_QUOTES, 'UTF-8') ?>"
                       required>
            </div>

            <div>
                <label for="status">Status do agendamento</label>
                <select id="status" name="status" required>
                    <option value="agendado" <?= $agendamento['status'] === 'agendado' ? 'selected' : '' ?>>Agendado</option>
                    <option value="concluido" <?= $agendamento['status'] === 'concluido' ? 'selected' : '' ?>>Concluído</option>
                    <option value="cancelado" <?= $agendamento['status'] === 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                </select>
            </div>

            <button type="submit">Salvar Alterações</button>

        </form>
    </main>
</body>
</html>