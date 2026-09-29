<?php
session_start();
require_once __DIR__ . "/config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = :email";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":email" => $email
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user["password"])) {

    $_SESSION["user_id"] = $user["id"];

    header("Location: dashboard.php");
    exit;

} else {

    echo "E-mail ou senha incorretos.";

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

                <form action="login.php" method="POST">

                    <div class="form-group">

                        <label for="email">
                            E-mail
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Digite seu e-mail"
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