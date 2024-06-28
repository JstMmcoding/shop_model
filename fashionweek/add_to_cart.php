<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: /fashionweek/auth/login.php");
    exit;
}

// Verificar se o parâmetro 'id' está presente
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Inicializar ou recuperar a variável de sessão para o carrinho
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Adicionar o produto ao carrinho (usando o ID do produto como chave)
    if (!isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = 1; // Quantidade inicial 1
    } else {
        $_SESSION['cart'][$product_id]++; // Incrementar quantidade
    }

    // Redirecionar de volta para a página de produtos
    header("Location: index.php");
    exit;
} else {
    echo "ID do produto não fornecido.";
}
?>
