<?php

include 'config/db.php'; 
include 'navbar.php';

// Função para calcular o preço total do carrinho
function calcularPrecoTotal($cart, $conn) {
    $total = 0;
    foreach ($cart as $product_id => $quantity) {
        // Consultar o preço do produto no banco de dados
        $sql = "SELECT price FROM products WHERE id = $product_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $price = $row['price'];
            $total += $price * $quantity;
        }
    }
    return $total;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Carrinho de Compras</title>
</head>
<body>
    <h2>Seu Carrinho de Compras</h2>
    
    <?php
    // Verificar se existe um carrinho na sessão
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            // Consultar o banco de dados para obter os detalhes do produto
            $sql = "SELECT * FROM products WHERE id = $product_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<div>";
                echo "<img src='uploads/products/" . $row['image'] . "' alt='Imagem do Produto' style='width:150px;height:150px;'><br>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p>Quantidade: " . $quantity . "</p>";
                echo "<p>Preço unitário: R$ " . number_format($row['price'], 2, ',', '.') . "</p>";
                echo "</div>";
            }
        }
        // Calcular e exibir o preço total do carrinho
        $total = calcularPrecoTotal($_SESSION['cart'], $conn);
        echo "<p>Preço Total: R$ " . number_format($total, 2, ',', '.') . "</p>";
    } else {
        echo "<p>Seu carrinho está vazio.</p>";
    }
    ?>

</body>
</html>
