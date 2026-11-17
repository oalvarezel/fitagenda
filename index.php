
<?php

require_once __DIR__ . '/config/database.php';

$sql = "SELECT
            COUNT(*) AS total,
            COALESCE(SUM(status = 'agendado'), 0) AS agendados,
            COALESCE(SUM(status = 'concluido'), 0) AS concluidos,
            COALESCE(SUM(status = 'cancelado'), 0) AS cancelados
        FROM agendamentos";

$stmt = $pdo->query($sql);
$resumo = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início | FitAgenda</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="hero" aria-hidden="true"></div>

    <div class="container">

        <nav class="sidebar">
            <h2>Menu</h2>

            <a href="index.php">Início</a>
            <a href="pages/cadastro.php">Novo Agendamento</a>
            <a href="list/lista.php">Gerenciar Agendamentos</a>
        </nav>

        <main class="dashboard">

        <h1 class="dashboard-title">FitAgenda</h1>

            <h2>Visão geral</h2>
            <p>Acompanhe os agendamentos do FitAgenda.</p>

            <section class="cards">

                <div class="card">
                    <h3>Total de agendamentos</h3>
                    <p><?= (int) $resumo['total'] ?></p>
                </div>

                <div class="card">
                    <h3>Agendados</h3>
                    <p><?= (int) $resumo['agendados'] ?></p>
                </div>

                <div class="card">
                    <h3>Concluídos</h3>
                    <p><?= (int) $resumo['concluidos'] ?></p>
                </div>

                <div class="card">
                    <h3>Cancelados</h3>
                    <p><?= (int) $resumo['cancelados'] ?></p>
                </div>

            </section>

            <div class="dashboard-actions">
                <a href="pages/cadastro.php">
                    + Novo Agendamento
                </a>

                <a href="list/lista.php" class="secondary">
                    Ver Agendamentos
                </a>
            </div>

        </main>

    </div>

</body>
</html>
