
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

} catch (PDOException $e) {
    error_log('Falha ao conectar ao banco de dados. Verifique as variaveis DB_HOST, DB_NAME, DB_USER e DB_PASSWORD.');
    die('Erro ao conectar ao banco de dados. Verifique a configuracao.');
}
