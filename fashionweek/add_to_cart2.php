<?php
session_start();
include 'config/db.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = $_GET['id'];

    // Verificar se o produto existe no banco de dados (exemplo básico)
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Recuperar informações do produto
        $product = $result->fetch_assoc();

        // Adicionar o produto ao carrinho (simulado com sessão por enquanto)
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Verificar se o produto já está no carrinho
        $product_already_in_cart = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $product_id) {
                $item['quantity']++;
                $product_already_in_cart = true;
                break;
            }
        }

        // Se o produto não estiver no carrinho, adicionar como novo item
        if (!$product_already_in_cart) {
            $_SESSION['cart'][] = [
                'id' => $product_id,
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }

        // Redirecionar de volta para a página de onde veio (index.php neste caso)
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    } else {
        echo "Produto não encontrado.";
    }
} else {
    echo "ID do produto não fornecido.";
}
?>
