<!-- Exemplo de botão "Adicionar ao Carrinho" em index.php -->
<?php
// Exemplo de consulta de produtos do banco de dados
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $product_id = $row['id'];
        $product_name = $row['name'];
        $product_price = $row['price'];
        $product_description = $row['description'];
?>
<div class="product">
    <h2><?php echo $product_name; ?></h2>
    <p><?php echo $product_description; ?></p>
    <p>Preço: R$ <?php echo $product_price; ?></p>
    <a href="add_to_cart.php?id=<?php echo $product_id; ?>">Adicionar ao Carrinho</a>
</div>
<?php
    }
} else {
    echo "Nenhum produto encontrado.";
}
?>


<?php while($row = $result->fetch_assoc()): ?>
            <div class="card">
                <img src="uploads/products/<?= $row['product_image'] ?>" alt="<?= $row['product_name'] ?>">
                <h2><?= $row['product_name'] ?></h2>
                <p><?= $row['product_description'] ?></p>
                <?php echo "<p>Preço: R$ " . number_format($row['product_price'], 2, ',', '.') . "</p>";
                echo "<a style='text-decoration: none; ' href='add_to_cart.php?id=" . $row['product_id'] . "'>Adicionar ao Carrinho</a>";
                ?>
            <!-- <p><strong>Category:</strong> <?= $row['category_name'] ?></p>
                <img src="uploads/categories/<?= $row['category_image'] ?>" alt="<?= $row['category_name'] ?>" style="width:50px;height:50px;">
        não preciso mostrar isso nos cards, duh. mas deixa pra adja ver.-->
            </div>
        <?php endwhile; ?>