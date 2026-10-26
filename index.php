<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

$isLoggedIn = isset($_SESSION["user_id"]);
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
        content="Nexora - Desenvolvimento web e soluções de tecnologia para pessoas e empresas, transformando necessidades em soluções simples e funcionais."
    >

    <!-- Open Graph -->

    <meta
        property="og:title"
        content="Nexora | Tecnologia para pessoas e empresas"
    >

    <meta
        property="og:description"
        content="Desenvolvimento web e soluções de tecnologia para pessoas e empresas, transformando necessidades em soluções simples e funcionais."
    >

    <meta
        property="og:type"
        content="website"
    >

    <title>Nexora | Tecnologia para pessoas e empresas</title>

    <!-- Google Fonts -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Favicon -->

    <link
        rel="icon"
        type="image/png"
        href="assets/images/favicon.png"
    >

    <!-- CSS -->

    <link
        rel="stylesheet"
        href="assets/css/landing.css"
    >

</head>

<body>
<header class="header">

    <div class="container">
        <a href="#inicio" class="logo" aria-label="Nexora - Início">
        <img
        src="assets/images/nexora-logo.png"
        alt="Nexora"
        class="logo-image"
        >
        </a>

    <nav class="nav" aria-label="Navegação principal">

        <ul class="nav-list">
            <li><a href="#sobre">Sobre</a></li>

            <li class="nav-mobile-only">
                <a href="#servicos">Serviços</a>
            </li>

            <li><a href="#projetos">Projetos</a></li>

            <?php if ($isLoggedIn): ?>

                <li class="nav-mobile-only">
                    <a href="dashboard.php">Meu painel</a>
                </li>

            <?php else: ?>

                <li class="nav-mobile-only">
                    <a href="login.php">Entrar</a>
                </li>

                <li class="nav-mobile-only">
                    <a href="register.php">Criar conta</a>
                </li>

            <?php endif; ?>
        </ul>

    <a href="#contato" class="nav-cta">
        Falar com a Nexora
    </a>

    </nav>

    <button
        class="menu-toggle"
        type="button"
        aria-label="Abrir menu"
        aria-expanded="false"
        >
        <span></span>
        <span></span>
        <span></span>
    </button>

        <div class="header-actions">

            <?php if ($isLoggedIn): ?>

                <a href="dashboard.php" class="btn btn-secondary">
                    Meu painel
                </a>

            <?php else: ?>

                <a href="login.php" class="btn btn-secondary">
                    Entrar
                </a>

            <?php endif; ?>

            <a href="#contato" class="btn btn-header">
                Falar com a Nexora
            </a>

        </div>
    </div>
</header>

<main>

    <section class="hero" id="inicio">
        <div class="container hero-container">

            <div class="hero-content">

                <span class="hero-label">
                    Soluções digitais & tecnologia
                </span>

                <h1>
                    Tecnologia que transforma
                    <span>ideias em soluções.</span>
                </h1>

                <p class="hero-description">
                    Desenvolvimento web e soluções de tecnologia
                    para pessoas e empresas que querem transformar
                    ideias em resultados.
                </p>
            </div>
        </div>
    </section>

    <section class="services" id="servicos">

    <div class="container">

        <header class="section-header">

            <span class="section-label">
                Nossos serviços
            </span>

            <h2>
                Tecnologia para transformar necessidades em soluções.
            </h2>

            <p>
                Soluções digitais e de tecnologia pensadas para
                pessoas, profissionais e empresas.
            </p>

        </header>

        <div class="services-grid">

            <article class="service-card">

                <span class="service-number">01</span>

                <h3>Nexora Digital</h3>

                <p>
                    Desenvolvimento de soluções digitais para fortalecer
                    sua presença e seus negócios na internet.
                </p>

                <ul>
                    <li>Landing pages</li>
                    <li>Sites institucionais</li>
                    <li>Desenvolvimento web</li>
                    <li>Manutenção de páginas</li>
                </ul>

            </article>

            <article class="service-card">

                <span class="service-number">02</span>

                <h3>Nexora IT</h3>

                <p>
                    Soluções de infraestrutura e suporte para ambientes
                    de tecnologia mais organizados e confiáveis.
                </p>

                <ul>
                    <li>Suporte técnico</li>
                    <li>Infraestrutura de TI</li>
                    <li>Redes e servidores</li>
                    <li>Monitoramento</li>
                </ul>

            </article>

            <article class="service-card">

                <span class="service-number">03</span>

                <h3>Nexora Tech</h3>

                <p>
                    Suporte e soluções tecnológicas para dispositivos
                    utilizados no dia a dia.
                </p>

                <ul>
                    <li>Configuração de dispositivos</li>
                    <li>Diagnóstico técnico</li>
                    <li>Manutenção</li>
                    <li>Suporte ao usuário</li>
                </ul>

            </article>

        </div>

    </div>

    </section>
    <section class="about" id="sobre">

    <div class="container about-container">

        <div class="about-content">

            <span class="section-label">
                Sobre a Nexora
            </span>

            <h2>
                Tecnologia simples.
                <span>Soluções que fazem sentido.</span>
            </h2>

            <p>
                A Nexora nasceu com o propósito de aproximar tecnologia
                de pessoas e empresas por meio de soluções funcionais,
                organizadas e desenvolvidas de acordo com cada necessidade.
            </p>

            <p>
                Unimos desenvolvimento web, infraestrutura e suporte
                técnico para transformar problemas em soluções que
                realmente agregam valor.
            </p>

        </div>

        <div class="about-values">

            <article class="value-item">
                <span>01</span>

                <div>
                    <h3>Simplicidade</h3>
                    <p>
                        Tecnologia deve resolver problemas,
                        não criar novos.
                    </p>
                </div>
            </article>

            <article class="value-item">
                <span>02</span>

                <div>
                    <h3>Proximidade</h3>
                    <p>
                        Comunicação clara durante todo o
                        desenvolvimento da solução.
                    </p>
                </div>
            </article>

            <article class="value-item">
                <span>03</span>

                <div>
                    <h3>Qualidade</h3>
                    <p>
                        Atenção aos detalhes e soluções
                        construídas para funcionar.
                    </p>
                </div>
            </article>

        </div>

    </div>
    </section>
    <section class="projects" id="projetos">

    <div class="container">

        <header class="section-header">

            <span class="section-label">
                Projetos
            </span>

            <h2>
                Soluções construídas na prática.
            </h2>

            <p>
                Projetos desenvolvidos para aplicar tecnologia,
                resolver problemas e criar experiências funcionais.
            </p>

        </header>

        <div class="projects-grid">

            <article class="project-card">
                <div class="project-visual">
                    <img
                        src="assets/images/projects/nexora-auth-preview.webp"
                        alt="Interface de login do sistema Nexora Auth"
                        loading="lazy"
                    >
                </div>

                <div class="project-content">

                    <span class="project-category">
                        Aplicação Web
                    </span>

                    <h3>Nexora Auth</h3>

                    <p>
                        Sistema de autenticação com cadastro, login,
                        gerenciamento de sessão e área protegida
                        para usuários.
                    </p>

                    <ul class="project-tech">
                        <li>HTML</li>
                        <li>CSS</li>
                        <li>PHP</li>
                        <li>MySQL</li>
                    </ul>

                </div>

            </article>


            <article class="project-card">


                <div class="project-visual">
                    <img
                        src="assets/images/projects/prisma-preview.webp"
                        alt="Página inicial do site Prisma, consultoria fiscal e tributária"
                        loading="lazy"
                    >
                </div>


                <div class="project-content">

                    <span class="project-category">
                        Site Institucional
                    </span>

                    <h3>Prisma</h3>

                    <p>
                        Landing page institucional desenvolvida
                        para apresentar serviços de consultoria
                        fiscal e tributária, transmitir confiança
                        e facilitar o contato com potenciais clientes.
                    </p>

                    <ul class="project-tech">
                        <li>HTML</li>
                        <li>CSS</li>
                        <li>JavaScript</li>
                        <li>Responsividade</li>
                    </ul>

                </div>

            </article>


        </div>

    </div>
    </section>
    <section class="process">

    <div class="container">

        <header class="section-header">

            <span class="section-label">
                Como trabalhamos
            </span>

            <h2>
                Da necessidade à solução.
            </h2>

            <p>
                Um processo simples e transparente para transformar
                ideias em soluções funcionais.
            </p>

        </header>

        <div class="process-grid">

            <article class="process-item">
                <span>01</span>
                <h3>Entendemos</h3>
                <p>
                    Conhecemos sua necessidade, seus objetivos
                    e o problema que precisa ser resolvido.
                </p>
            </article>

            <article class="process-item">
                <span>02</span>
                <h3>Planejamos</h3>
                <p>
                    Definimos a melhor solução, estrutura
                    e caminho para o projeto.
                </p>
            </article>

            <article class="process-item">
                <span>03</span>
                <h3>Desenvolvemos</h3>
                <p>
                    Transformamos o planejamento em uma
                    solução funcional e organizada.
                </p>
            </article>

            <article class="process-item">
                <span>04</span>
                <h3>Entregamos</h3>
                <p>
                    Revisamos os detalhes e entregamos
                    a solução pronta para utilização.
                </p>
            </article>

        </div>

    </div>
  </section>
   <section class="contact" id="contato">

    <div class="container">

        <div class="contact-content">

            <span class="section-label">
                Vamos conversar?
            </span>

            <h2>
                Sua próxima ideia pode começar aqui.
            </h2>

            <p>
                Conte para a Nexora o que você precisa.
                Vamos entender seu projeto e encontrar
                uma solução que faça sentido.
            </p>

            <a
            href="https://wa.me/5511976217392?text=Olá!%20Conheci%20a%20Nexora%20pelo%20site%20e%20gostaria%20de%20conversar."
            class="btn btn-primary whatsapp-btn"
            target="_blank"
            rel="noopener noreferrer"
             >
        <svg
        viewBox="0 0 24 24"
        aria-hidden="true"
        >
        <path
            fill="currentColor"
            d="M12 2a10 10 0 00-8.51 15.25L2 22l4.88-1.44A10 10 0 1012 2zm0 18a7.93 7.93 0 01-4.07-1.11l-.29-.17-2.89.85.86-2.81-.19-.29A8 8 0 1112 20zm4.39-5.53c-.24-.12-1.42-.7-1.64-.78-.22-.08-.38-.12-.54.12-.16.24-.62.78-.76.94-.14.16-.28.18-.52.06-.24-.12-1.01-.37-1.92-1.18-.71-.63-1.19-1.41-1.33-1.65-.14-.24-.02-.37.1-.49.11-.11.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.54-1.3-.74-1.78-.19-.47-.39-.41-.54-.42h-.46c-.16 0-.42.06-.64.3-.22.24-.84.82-.84 2s.86 2.32.98 2.48c.12.16 1.69 2.58 4.1 3.62.57.25 1.02.4 1.37.51.58.18 1.1.16 1.51.1.46-.07 1.42-.58 1.62-1.14.2-.56.2-1.04.14-1.14-.06-.1-.22-.16-.46-.28z"
        />
        </svg>

         WhatsApp
        </a>
        </div>
    </div>

    </section>
    </main>

    <footer class="footer">

    <div class="container">

        <div class="footer-brand">

            <img
                src="assets/images/nexora-logo.png"
                alt="Nexora"
                class="footer-logo"
            >

            <p>
                Tecnologia para pessoas e empresas.
            </p>

            <div class="footer-social">

                <a
                    href="https://www.instagram.com/nexora.dservices/"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Instagram da Nexora"
                    class="social-link"
                >
                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            fill="currentColor"
                            d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.66 0 3 1.34 3 3v10c0 1.66-1.34 3-3 3H7c-1.66 0-3-1.34-3-3V7c0-1.66 1.34-3 3-3h10zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm5.5-3.25a1.25 1.25 0 100 2.5 1.25 1.25 0 000-2.5z"
                        />
                    </svg>
                </a>
                <a
                    href="https://www.linkedin.com/company/nexora-dservices"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="LinkedIn da Nexora"
                    class="social-link"
                >
                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            fill="currentColor"
                            d="M20.45 20.45h-3.56v-5.57c0-1.33-.03-3.04-1.85-3.04-1.85 0-2.14 1.45-2.14 2.94v5.67H9.34V8.99h3.42v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.29zM5.32 7.43a2.06 2.06 0 110-4.12 2.06 2.06 0 010 4.12zM7.1 20.45H3.54V8.99H7.1v11.46zM22.23 0H1.77C.79 0 0 .77 0 1.72v20.56C0 23.23.79 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.21 0 22.23 0z"
                        />
                    </svg>
                </a>
            </div>
        </div>

        <div class="footer-bottom">

            <p>
                © 2026 Nexora. Todos os direitos reservados.
            </p>

            <p>
                A project by <span>Ada's Legacy.</span>
            </p>

        </div>

    </div>

</footer>
    <script src="assets/js/main.js"></script>
</body>

</html>
