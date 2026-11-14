<?php
// Inclui a conexão com o banco de dados fornecida pela Pessoa 4
require_once __DIR__ . '/../config/database.php';

// Recebe os filtros enviados pelo formulário
$busca = isset($_GET['busca']) && is_string($_GET['busca'])
    ? trim($_GET['busca'])
    : '';

$status_filtro = isset($_GET['status']) && is_string($_GET['status'])
    ? $_GET['status']
    : '';

// Valores aceitos pelo banco de dados
$statusPermitidos = ['agendado', 'concluido', 'cancelado'];

if (
    $status_filtro !== '' &&
    !in_array($status_filtro, $statusPermitidos, true)
) {
    $status_filtro = '';
}

// Montagem da consulta SQL
$sql = "SELECT * FROM agendamentos WHERE 1=1";
$params = [];

// Filtro de pesquisa por nome
if ($busca !== '') {
    $sql .= " AND nome_aluno LIKE ?";
    $params[] = "%$busca%";
}

// Filtro por status
if ($status_filtro !== '') {
    $sql .= " AND status = ?";
    $params[] = $status_filtro;
}

// Ordena pelos registros mais recentes
$sql .= " ORDER BY id DESC";

// Executa a consulta com PDO
$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Textos apresentados ao usuário
$rotulosStatus = [
    'agendado' => 'Agendado',
    'concluido' => 'Concluído',
    'cancelado' => 'Cancelado'
];

// Cores dos status no Bootstrap
$coresStatus = [
    'agendado' => 'bg-warning text-dark',
    'concluido' => 'bg-success',
    'cancelado' => 'bg-danger'
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gerenciamento de Agendamentos | FitAgenda</title>

    <!-- Bootstrap temporário até o CSS oficial da Pessoa 1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

    <main class="container my-5">

        <!-- Cabeçalho -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <h1 class="h2">Gerenciamento de Agendamentos</h1>

            <a href="../pages/cadastro.php" class="btn btn-success">
                + Novo Agendamento
            </a>

        </div>

        <!-- Pesquisa e filtros -->
        <form method="GET" action="lista.php" class="row g-3 mb-4">

            <div class="col-md-5">

                <input
                    type="text"
                    name="busca"
                    class="form-control"
                    placeholder="Pesquisar por nome do aluno..."
                    value="<?= htmlspecialchars($busca, ENT_QUOTES, 'UTF-8') ?>"
                >

            </div>

            <div class="col-md-4">

                <select name="status" class="form-select">

                    <option value="">Todos os status</option>

                    <option value="agendado"
                        <?= $status_filtro === 'agendado' ? 'selected' : '' ?>>
                        Agendado
                    </option>

                    <option value="concluido"
                        <?= $status_filtro === 'concluido' ? 'selected' : '' ?>>
                        Concluído
                    </option>

                    <option value="cancelado"
                        <?= $status_filtro === 'cancelado' ? 'selected' : '' ?>>
                        Cancelado
                    </option>

                </select>

            </div>

            <div class="col-md-3">

                <button type="submit" class="btn btn-primary w-100">
                    Filtrar
                </button>

            </div>

        </form>

        <!-- Tabela de agendamentos -->
        <div class="card shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-striped align-middle">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Aluno</th>
                                <th>Atividade</th>
                                <th>Data</th>
                                <th>Horário</th>
                                <th>Status</th>
                                <th class="text-end">Ações</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (count($agendamentos) > 0): ?>

                                <?php foreach ($agendamentos as $item): ?>

                                    <?php
                                    $status = $item['status'];

                                    $rotulo = $rotulosStatus[$status] ?? $status;

                                    $cor = $coresStatus[$status] ?? 'bg-secondary';
                                    ?>

                                    <tr>

                                        <td>
                                            <?= (int) $item['id'] ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($item['nome_aluno'], ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($item['atividade'], ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <?= date('d/m/Y', strtotime($item['data_aula'])) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(substr($item['horario'], 0, 5), ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <span class="badge <?= $cor ?>">
                                                <?= htmlspecialchars($rotulo, ENT_QUOTES, 'UTF-8') ?>
                                            </span>
                                        </td>

                                        <td class="text-end">

                                            <div class="d-flex gap-2 justify-content-end">

                                                <!-- Botão de edição -->
                                                <a
                                                    href="../pages/editar.php?id=<?= (int) $item['id'] ?>"
                                                    class="btn btn-sm btn-warning"
                                                >
                                                    Editar
                                                </a>

                                                <!-- Formulário de exclusão -->
                                                <form
                                                    action="excluir.php"
                                                    method="POST"
                                                    onsubmit="return confirm('Tem certeza que deseja excluir este agendamento?');"
                                                >

                                                    <input
                                                        type="hidden"
                                                        name="id"
                                                        value="<?= (int) $item['id'] ?>"
                                                    >

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm btn-danger"
                                                    >
                                                        Excluir
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        Nenhum agendamento encontrado.
                                    </td>
                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </main>

</body>
</html>
