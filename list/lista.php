<?php
// Inclui a conexão com o banco de dados fornecida pela Pessoa 4
require_once __DIR__ . '/../config/database.php';

// Captura os valores de busca (nome) e filtro (status) enviados via GET
$busca = $_GET['busca'] ?? '';
$status_filtro = $_GET['status'] ?? '';

// Montagem dinâmica da query SQL de forma segura
$sql = "SELECT * FROM agendamentos WHERE 1=1";
$params = [];

if (!empty($busca)) {
    $sql .= " AND nome_aluno LIKE ?";
    $params[] = "%$busca%";
}

if (!empty($status_filtro)) {
    $sql .= " AND status = ?";
    $params[] = $status_filtro;
}

$sql .= " ORDER BY id DESC";

// Executa a consulta
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>FitAgenda - Gerenciamento de Agendamentos</title>
    <!-- Substitua ou adapte conforme o CSS oficial da Pessoa 1 -->
    <a link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gerenciamento de Agendamentos</h2>
            <!-- Botão para o formulário de cadastro (Parte 2) -->
            <a href="cadastrar.php" class="btn btn-success">+ Novo Agendamento</a>
        </div>

        <!-- Formulário de Pesquisa e Filtros -->
        <form method="GET" action="" class="row g-3 mb-4">
            <div class="col-md-5">
                <input type="text" name="busca" class="form-control" placeholder="Pesquisar por nome do aluno..."
                    value="<?php echo htmlspecialchars($busca); ?>">
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">Todos os status</option>
                    <option value="Agendado" <?php echo ($status_filtro == 'Agendado') ? 'selected' : ''; ?>>Agendado
                    </option>
                    <option value="Concluído" <?php echo ($status_filtro == 'Concluído') ? 'selected' : ''; ?>>Concluído
                    </option>
                    <option value="Cancelado" <?php echo ($status_filtro == 'Cancelado') ? 'selected' : ''; ?>>Cancelado
                    </option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </form>

        <!-- Tabela de Resultados -->
        <div class="card shadow-sm">
            <div class="card-body">
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
                                <tr>
                                    <td><?php echo $item['id']; ?></td>
                                    <td><?php echo htmlspecialchars($item['nome_aluno']); ?></td>
                                    <td><?php echo htmlspecialchars($item['atividade_esportiva']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($item['data_aula'])); ?></td>
                                    <td><?php echo $item['horario']; ?></td>
                                    <td>
                                        <span class="badge 
                                        <?php
                                        if ($item['status'] == 'Agendado')
                                            echo 'bg-warning text-dark';
                                        elseif ($item['status'] == 'Concluído')
                                            echo 'bg-success';
                                        else
                                            echo 'bg-danger';
                                        ?>">
                                            <?php echo $item['status']; ?>
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <!-- Botão de Edição (Aponta para o arquivo da Parte 2) -->
                                        <a href="editar.php?id=<?php echo $item['id']; ?>"
                                            class="btn btn-sm btn-warning">Editar</a>

                                        <!-- Botão de Exclusão (Chama o seu arquivo de exclusão com confirmação JS) -->
                                        <a href="excluir.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Tem certeza que deseja excluir o agendamento de <?php echo htmlspecialchars($item['nome_aluno'], ENT_QUOTES); ?>?');">
                                            Excluir
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Nenhum agendamento encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>