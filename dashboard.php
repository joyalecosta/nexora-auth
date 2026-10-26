
<?php

session_start();

// Impede o armazenamento do dashboard em cache.
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Verifica se o usuário está autenticado
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Carrega a conexão com o banco de dados
require_once __DIR__ . "/config/database.php";

// Busca os dados do usuário autenticado
$sql = "SELECT name, email FROM users WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
        ":id" => $_SESSION["user_id"]
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Encerra a sessão se o usuário não existir mais
if (!$user) {

    $_SESSION = [];

    if (ini_get("session.use_cookies")) {

        $params = session_get_cookie_params();

        setcookie(
                session_name(),
                "",
                [
                        "expires" => time() - 42000,
                        "path" => $params["path"],
                        "domain" => $params["domain"],
                        "secure" => $params["secure"],
                        "httponly" => $params["httponly"],
                        "samesite" => $params["samesite"] ?? "Lax"
                ]
        );
    }

    session_destroy();

    header("Location: login.php");
    exit;
}

// Gera o token CSRF, caso ainda não exista
if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}

// Define o status após validar a autenticação
$accountStatus = "Autenticada";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta
            name="description"
            content="Dashboard do Nexora Auth"
    >

    <title>Nexora Auth - Dashboard</title>

    <link rel="stylesheet" href="/nexora-auth/assets/css/style.css">
</head>

<body>

<!-- Cabeçalho -->
<header class="dashboard-header">

    <a href="dashboard.php" class="logo">
        <span>N</span>EXORA
    </a>
    <form action="logout.php" method="POST" class="logout-form">

        <input
                type="hidden"
                name="csrf_token"
                value="<?= htmlspecialchars(
                        $_SESSION["csrf_token"],
                        ENT_QUOTES,
                        "UTF-8"
                ) ?>"
        >

        <button type="submit" class="logout-button">
            Sair
        </button>

    </form>
</header>

<!-- Conteúdo principal -->
<main>

    <!-- Boas-vindas -->
    <section class="welcome-section">

        <h1>
            Olá, <?= htmlspecialchars($user["name"], ENT_QUOTES, "UTF-8") ?>! 👋
        </h1>

        <p class="welcome-text">
            Bem-vindo ao seu painel Nexora.
            Você está autenticado com sucesso.
        </p>

    </section>

    <!-- Perfil -->
    <section class="dashboard-cards">

        <article class="dashboard-card profile-card">

            <div class="profile-header">

                <div>

                        <span class="card-icon">
                            👤
                        </span>

                    <h2>Perfil</h2>

                </div>

                <span class="account-status">
                        ● Conta <?= htmlspecialchars(strtolower($accountStatus), ENT_QUOTES, "UTF-8") ?>
                    </span>

            </div>

            <div class="profile-info">

                <div class="profile-field">

                    <p>Nome</p>

                    <strong>
                        <?= htmlspecialchars($user["name"], ENT_QUOTES, "UTF-8") ?>
                    </strong>

                </div>

                <div class="profile-field">

                    <p>E-mail</p>

                    <strong>
                        <?= htmlspecialchars($user["email"], ENT_QUOTES, "UTF-8") ?>
                    </strong>

                </div>

            </div>

        </article>

    </section>

    <!-- Serviço contratado -->
    <section class="service-section">

        <div class="section-header">

            <p class="section-label">
                SEU SERVIÇO
            </p>

            <h2>
                Acompanhe seu projeto
            </h2>

            <p>
                Veja o andamento do serviço contratado com a Nexora.
            </p>

        </div>

        <article class="service-card">

            <div class="service-header">

                <div>

                        <span class="card-icon">
                            💻
                        </span>

                    <div>

                        <p class="service-category">
                            DESENVOLVIMENTO WEB
                        </p>

                        <h3>
                            Site institucional
                        </h3>

                    </div>

                </div>

                <span class="service-status">
                        ● Em andamento
                    </span>

            </div>

            <div class="service-details">

                <div class="service-field">

                    <p>Próxima etapa</p>

                    <strong>
                        Revisão do layout
                    </strong>

                </div>

            </div>

            <div class="service-actions">

                <a href="service.php" class="service-button">
                    Ver serviço →
                </a>

            </div>

        </article>

    </section>

</main>

</body>

</html>
