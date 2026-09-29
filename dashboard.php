<?php

session_start();

$accountStatus = "Autenticada";

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit;

}

require_once __DIR__ . "/config/database.php";

$sql = "SELECT name, email FROM users WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":id" => $_SESSION["user_id"]
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!-- Estrutura da página do dashboard-->

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

    <header class="dashboard-header">

        <a href="dashboard.php" class="logo">
            <span>N</span>EXORA
        </a>

        <a href="logout.php" class="logout-button">
            Sair
        </a>

    </header>


    <main class="dashboard">

        <section class="welcome">

            <p class="welcome-label">
                NEXORA AUTH
            </p>

            <h1>
                Olá, <?= htmlspecialchars($user["name"]) ?>! 👋
            </h1>

            <p class="welcome-text">
                Bem-vindo ao seu painel Nexora.
                Você está autenticado com sucesso.
            </p>

        </section>


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
        ● Conta <?= strtolower($accountStatus) ?>
    </span>

</div>


        <div class="profile-info">

            <div class="profile-field">

                <p>
                    Nome
                </p>

                <strong>
                    <?= htmlspecialchars($user["name"]) ?>
                </strong>

            </div>


            <div class="profile-field">

                <p>
                    E-mail
                </p>

                <strong>
                    <?= htmlspecialchars($user["email"]) ?>
                </strong>

            </div>

        </div>

    </article>
</section>
<section class="service-section">

    <div class="section-header">
        <p class="section-label">SEU SERVIÇO</p>

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

                <p>
                    Próxima etapa
                </p>

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