<?php
    require_once __DIR__ . "/config/database.php";

    $message = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password)
                VALUES (:name, :email, :password)";

        $stmt = $pdo->prepare($sql);

        try {

            $stmt->execute([
                ":name" => $name,
                ":email" => $email,
                ":password" => $hashedPassword
            ]);

            $message = "Usuário cadastrado com sucesso!";

        } catch (PDOException $e) {

            if ($e->errorInfo[1] == 1062) {

                $message = "Este e-mail já está cadastrado.";

            } else {

                $message = "Erro ao cadastrar usuário.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Criar conta | Nexora Auth</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <main>

        <h1>Criar conta</h1>

        <p>Crie sua conta na Nexora.</p>

        <?php if ($message !== ""): ?>

            <p>
                <?= htmlspecialchars($message) ?>
            </p>

        <?php endif; ?>

        <form action="register.php" method="POST">

            <div>
                <label for="name">Nome</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Digite seu nome"
                    required
                >
            </div>

            <div>
                <label for="email">E-mail</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Digite seu e-mail"
                    required
                >
            </div>

            <div>
                <label for="password">Senha</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Digite sua senha"
                    required
                >
            </div>

            <button type="submit">
                Criar conta
            </button>

        </form>

        <p>
            Já possui uma conta?
            <a href="index.php">Entrar</a>
        </p>

    </main>

</body>

</html>
