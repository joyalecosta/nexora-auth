
<?php

session_start();

require_once __DIR__ . "/config/database.php";

// Gerar token CSRF, caso ainda não exista
if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 1. Validar token CSRF
    $submittedToken = $_POST["csrf_token"] ?? "";

    if (
            !is_string($submittedToken) ||
            !hash_equals($_SESSION["csrf_token"], $submittedToken)
    ) {
        http_response_code(403);
        exit("Requisição inválida. Atualize a página e tente novamente.");
    }

    // 2. Validar tipos de entrada
    $emailInput = $_POST["email"] ?? "";
    $passwordInput = $_POST["password"] ?? "";

    if (
            !is_string($emailInput) ||
            !is_string($passwordInput)
    ) {
        http_response_code(400);
        exit("Dados inválidos.");
    }

    // 3. Normalizar e-mail
    $email = strtolower(trim($emailInput));
    $password = $passwordInput;

    // 4. Validar campos obrigatórios
    if ($email === "" || $password === "") {

        $message = "Preencha todos os campos.";


    } elseif (
            strlen($email) > 150 ||
            !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        $message = "Informe um e-mail válido.";


    } elseif (strlen($password) > 1024) {

        $message = "Dados inválidos.";

    } else {

        // 5. Identificar endereço IP
        $ipAddress = $_SERVER["REMOTE_ADDR"] ?? "0.0.0.0";

        // 6. Contar tentativas recentes por IP
        $sqlCount = "
            SELECT COUNT(*)
            FROM login_attempts
            WHERE ip_address = :ip_address
            AND attempted_at >= NOW() - INTERVAL 15 MINUTE
        ";

        $stmtCount = $pdo->prepare($sqlCount);

        $stmtCount->execute([
                ":ip_address" => $ipAddress
        ]);

        $totalAttempts = (int) $stmtCount->fetchColumn();

        // 7. Contar tentativas recentes por e-mail
        $sqlAccountCount = "
            SELECT COUNT(*)
            FROM login_attempts
            WHERE email = :email
            AND attempted_at >= NOW() - INTERVAL 15 MINUTE
        ";

        $stmtAccountCount = $pdo->prepare($sqlAccountCount);

        $stmtAccountCount->execute([
                ":email" => $email
        ]);

        $accountAttempts = (int) $stmtAccountCount->fetchColumn();

        // 8. Verificar limite de tentativas
        if ($totalAttempts >= 5 || $accountAttempts >= 5) {

            http_response_code(429);

            // Informa ao cliente um tempo sugerido
            // antes de realizar uma nova tentativa.
            header("Retry-After: 900");

            exit(
            "Muitas tentativas de login. Aguarde 15 minutos e tente novamente."
            );
        }

        // 9. Consultar usuário
        $sql = "
            SELECT id, password
            FROM users
            WHERE email = :email
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
                ":email" => $email
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // 10. Verificar senha
        if (
                $user &&
                password_verify($password, $user["password"])
        ) {

            // Renovar identificador da sessão
            session_regenerate_id(true);

            // Registrar usuário autenticado
            $_SESSION["user_id"] = $user["id"];

            // Redirecionar para o dashboard
            header("Location: dashboard.php");
            exit;

        } else {

            // 11. Registrar tentativa malsucedida
            $sqlAttempt = "
                INSERT INTO login_attempts
                    (email, ip_address)
                VALUES
                    (:email, :ip_address)
            ";

            $stmtAttempt = $pdo->prepare($sqlAttempt);

            $stmtAttempt->execute([
                    ":email" => $email,
                    ":ip_address" => $ipAddress
            ]);

            // Mensagem genérica de segurança
            $message = "E-mail ou senha incorretos.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta
            name="description"
            content="Nexora Auth - Sistema de autenticação"
    >

    <title>Nexora Auth</title>

    <link rel="stylesheet" href="/nexora-auth/assets/css/style.css">
</head>

<body>

<main class="login-container">

    <section class="login-card">

        <header class="login-header">

            <a href="login.php" class="logo">
                <span>N</span>EXORA
            </a>

            <p class="subtitle">
                Sistema de autenticação
            </p>

        </header>

        <div class="login-content">

            <h1>Entrar</h1>

            <p class="login-description">
                Entre na sua conta Nexora.
            </p>

            <?php if ($message !== ""): ?>

                <p class="login-error" role="alert">
                    <?= htmlspecialchars(
                            $message,
                            ENT_QUOTES,
                            "UTF-8"
                    ) ?>
                </p>

            <?php endif; ?>

            <form action="login.php" method="POST">

                <input
                        type="hidden"
                        name="csrf_token"
                        value="<?= htmlspecialchars(
                                $_SESSION["csrf_token"],
                                ENT_QUOTES,
                                "UTF-8"
                        ) ?>"
                >

                <div class="form-group">

                    <label for="email">
                        E-mail
                    </label>

                    <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Digite seu e-mail"
                            autocomplete="username"
                            required
                    >

                </div>

                <div class="form-group">

                    <label for="password">
                        Senha
                    </label>

                    <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Digite sua senha"
                            autocomplete="current-password"
                            required
                    >

                </div>

                <button
                        type="submit"
                        class="login-button"
                >
                    Entrar
                </button>

            </form>

            <p class="register-link">

                Ainda não possui uma conta?

                <a href="register.php">
                    Criar conta
                </a>

            </p>

        </div>

    </section>

</main>

</body>

</html>
