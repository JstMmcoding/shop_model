<?php
session_start();
include 'config/db.php';

// Verificar se há produtos no carrinho
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho</title>
    <style>
        /* Estilos CSS */
    </style>
</head>
<body>
    <h2>Meu Carrinho</h2>
    <div class="cart">
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $subtotal = $item['price'] * $item['quantity'];
                    $total_price += $subtotal;
                ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td>R$ <?php echo $item['price']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>R$ <?php echo number_format($subtotal, 2); ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="3"><strong>Total:</strong></td>
                    <td><strong>R$ <?php echo number_format($total_price, 2); ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
} else {
    echo "<p>Carrinho vazio.</p>";
}
?>
