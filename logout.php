
<?php

session_start();

// Aceita somente requisições POST.
if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    http_response_code(405);
    header("Allow: POST");
    exit("Método não permitido.");

}

// Recupera o token enviado pelo formulário.
$submittedToken = $_POST["csrf_token"] ?? "";

// Verifica se o token é válido.
if (
    !is_string($submittedToken) ||
    !isset($_SESSION["csrf_token"]) ||
    !is_string($_SESSION["csrf_token"]) ||
    !hash_equals($_SESSION["csrf_token"], $submittedToken)
) {

    http_response_code(403);
    exit("Requisição inválida.");

}

// Limpa os dados da sessão.
$_SESSION = [];

// Solicita a exclusão do cookie da sessão.
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

// Destrói a sessão no servidor.
session_destroy();

// Redireciona para a página de login.
header("Location: login.php");
exit;
