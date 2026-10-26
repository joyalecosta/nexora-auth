
-- Nexora Auth
-- Estrutura do banco de dados
-- Não contém dados de usuários nem credenciais.

CREATE DATABASE IF NOT EXISTS nexora_auth
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE nexora_auth;

CREATE TABLE IF NOT EXISTS users (
                                     id INT NOT NULL AUTO_INCREMENT,
                                     name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE KEY email (email)
    ) ENGINE=InnoDB
    DEFAULT CHARSET=utf8mb4
    COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS login_attempts (
                                              id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                              email VARCHAR(150) NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    attempted_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    KEY idx_email_time (email, attempted_at),
    KEY idx_ip_time (ip_address, attempted_at)
    ) ENGINE=InnoDB
    DEFAULT CHARSET=utf8mb4
    COLLATE=utf8mb4_general_ci;
