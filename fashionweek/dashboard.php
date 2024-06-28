<?php
session_start();
include 'config/db.php';
include 'navbar.php';

// Verificar se o usuário está logado, redirecionar para login se não estiver
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Recuperar dados do usuário da sessão ou do banco de dados
$user_id = $_SESSION['user_id'];
$user = getUserById($user_id, $conn);

// Verificar se o usuário existe (deve ser verificado sempre por questões de segurança)
if (!$user) {
    // Caso o usuário não exista no banco de dados (situação incomum se a sessão estiver correta)
    // Pode redirecionar para o login ou outro tratamento adequado
    header("Location: login.php");
    exit;
}

// Dados do usuário recuperados do banco de dados
$user_name = $user['name'];
$user_email = $user['email'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Usuário</title>
    <style>
        /* Estilo CSS como no exemplo anterior */
    </style>
</head>
<body>
    <div class="container">
        <h2>Dashboard do Usuário</h2>
        
        <p>Bem-vindo, <?php echo $user_name; ?>!</p>
        <p>Email: <?php echo $user_email; ?></p>
        
        <h3>Opções Disponíveis:</h3>
        <ul>
            <li><a href="user/cart.php">Meu Carrinho</a></li>
            <!-- Adicionar mais links conforme necessário -->
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </div>
</body>
</html>
