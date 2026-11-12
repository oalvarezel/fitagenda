<?php

$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'fitagenda';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $resultado = $pdo->query(
        "SELECT COUNT(*) FROM agendamentos"
    );

    echo "Conexao realizada com sucesso!\n";
    echo "Tabela agendamentos encontrada.\n";
    echo "Registros encontrados: " . $resultado->fetchColumn() . "\n";

} catch (PDOException $e) {
    fwrite(STDERR, "Erro na conexao. Verifique a configuracao do banco.\n");
    exit(1);
}
