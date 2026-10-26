<?php

/**
 * Nexora Auth — Exemplo de configuração do banco de dados.
 *
 * Copie este arquivo para config/database.php
 * e configure as credenciais do seu ambiente local.
 *
 * Nunca publique credenciais reais no repositório.
 */

$host = "127.0.0.1";
$dbname = "nexora_auth";
$username = "SEU_USUARIO";
$password = "SUA_SENHA";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );

} catch (PDOException $e) {
    error_log("Falha na conexão com o banco de dados.");

    http_response_code(500);
    exit("Erro interno ao conectar ao banco de dados.");
}