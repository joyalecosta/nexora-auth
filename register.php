
<?php

session_start();

require_once __DIR__ . "/config/database.php";

// 1. Gerar token CSRF caso ainda não exista.
if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 2. Validar token CSRF.
    $submittedToken = $_POST["csrf_token"] ?? "";

    if (
            !is_string($submittedToken) ||
            !hash_equals($_SESSION["csrf_token"], $submittedToken)
    ) {
        http_response_code(403);
        exit("Requisição inválida. Atualize a página e tente novamente.");
    }

    // 3. Receber dados do formulário.
    $nameInput = $_POST["name"] ?? "";
    $emailInput = $_POST["email"] ?? "";
    $passwordInput = $_POST["password"] ?? "";

    // 4. Validar tipos de entrada.
    if (
            !is_string($nameInput) ||
            !is_string($emailInput) ||
            !is_string($passwordInput)
    ) {
        http_response_code(400);
        exit("Dados inválidos.");
    }

    // 5. Normalizar dados.
    $name = trim($nameInput);
    $email = strtolower(trim($emailInput));
    $password = $passwordInput;

    // 6. Validar campos.
    if ($name === "" || $email === "" || $password === "") {

        $message = "Preencha todos os campos.";
        $messageType = "error";

    } elseif (
            strlen($email) > 150 ||
            !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {

        $message = "Informe um e-mail válido com até 150 caracteres.";
        $messageType = "error";

    } elseif (mb_strlen($name, "UTF-8") > 100) {

        $message = "O nome deve ter no máximo 100 caracteres.";
        $messageType = "error";

    } elseif (
            strlen($password) < 8 ||
            strlen($password) > 1024
    ) {

        $message = "A senha deve ter entre 8 e 1024 bytes.";
        $messageType = "error";

    } else {

        // 7. Gerar hash seguro da senha.
        $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
        );

        // 8. Inserir usuário com consulta preparada.
        $sql = "
            INSERT INTO users (name, email, password)
            VALUES (:name, :email, :password)
        ";

        try {

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                    ":name" => $name,
                    ":email" => $email,
                    ":password" => $hashedPassword
            ]);

            $message = "Conta criada com sucesso!";
            $messageType = "success";

        } catch (PDOException $e) {

            // MySQL 1062: valor duplicado em campo UNIQUE.
            if (
                    $e->getCode() === "23000" &&
                    (int) ($e->errorInfo[1] ?? 0) === 1062
            ) {

                $message = "Este e-mail já está cadastrado.";

            } else {

                error_log("Falha ao cadastrar usuário.");
                $message = "Não foi possível criar a conta.";
            }

            $messageType = "error";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
    >

    <meta
            name="description"
            content="Crie sua conta no Nexora Auth"
    >

    <title>Criar conta | Nexora Auth</title>

    <link
            rel="stylesheet"
            href="/nexora-auth/assets/css/style.css"
    >
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

        <!-- Conteúdo principal do cadastro -->
        <div class="login-content">

            <h1>Criar conta</h1>

            <p class="login-description">
                Cadastre-se para acessar sua conta Nexora.
            </p>

            <?php if ($message !== ""): ?>

                <p
                        class="register-message <?= htmlspecialchars($messageType, ENT_QUOTES, "UTF-8") ?>"
                        role="status"
                >
                    <?= htmlspecialchars(
                            $message,
                            ENT_QUOTES,
                            "UTF-8"
                    ) ?>
                </p>

            <?php endif; ?>

            <form action="register.php" method="POST">

                <!-- Token CSRF -->
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

                    <label for="name">Nome</label>

                    <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Digite seu nome"
                            autocomplete="name"
                            maxlength="100"
                            required
                    >

                </div>

                <div class="form-group">

                    <label for="email">E-mail</label>

                    <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Digite seu e-mail"
                            autocomplete="email"
                            maxlength="150"
                            required
                    >

                </div>

                <div class="form-group">

                    <label for="password">Senha</label>

                    <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Digite sua senha"
                            autocomplete="new-password"
                            minlength="8"
                            required
                    >

                </div>

                <button
                        type="submit"
                        class="login-button"
                >
                    Criar conta
                </button>

            </form>

            <p class="register-link">
                Já possui uma conta?
                <a href="login.php">Entrar</a>
            </p>

        </div>

    </section>

</main>

</body>
</html>
