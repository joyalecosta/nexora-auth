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

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do serviço | Nexora</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <main class="service-page">

        <!-- Cole aqui todo o conteúdo atual da service.php,
             começando em "Voltar ao dashboard" -->
        
<a href="dashboard.php" class="back-link">← Voltar ao dashboard</a>

<section class="service-section">
    <div class="section-header">
        <p class="section-label">DETALHES DO SERVIÇO</p>
        <h1>Site institucional</h1>
        <p>Acompanhe as etapas do seu projeto com a Nexora.</p>
    </div>

    <article class="service-card">
        <div class="service-header">
            <div>
                <span class="card-icon">💻</span>

                <div>
                    <p class="service-category">DESENVOLVIMENTO WEB</p>
                    <h2>Site institucional</h2>
                </div>
            </div>

            <span class="service-status">● Em andamento</span>
        </div>

        <div class="service-details">
            <div class="service-field">
                <p>Descrição</p>
                <strong>
                    Desenvolvimento do site institucional da empresa.
                </strong>
            </div>
        </div>
    </article>

    <section class="project-progress" aria-labelledby="progress-title">
    <h2 id="progress-title">Andamento do projeto</h2>

    <ol class="progress-steps">
        <li class="is-complete">Contratação</li>
        <li class="is-complete">Planejamento</li>
        <li class="is-current" aria-current="step">Desenvolvimento</li>
        <li>Revisão</li>
        <li>Entrega</li>
    </ol>
    </section>

    <section class="project-next-step">
        <h2>Próxima etapa</h2>
        <p>Revisão do layout</p>
    </section>
</section>
    </main>
</body>
</html>
