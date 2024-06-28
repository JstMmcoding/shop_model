<?php
include 'config/db.php';
include 'navbar.php';

$sql = "SELECT products.id AS product_id, products.name AS product_name, 
        products.description AS product_description, products.price AS product_price,
        products.image AS product_image, categories.name AS category_name,
        categories.image AS category_image 
        FROM products 
        JOIN categories ON products.category_id = categories.id";
$result = $conn->query($sql);

if (!$result) {
    die("Erro na consulta: " . $conn->error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link rel="stylesheet" href="/fashionweek/static/css/cards.css">
</head>
<body>
    <h1>Product List</h1>
    
    <div class="cardsme">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="cardme">
                <img src="uploads/products/<?= $row['product_image'] ?>" alt="<?= $row['product_name'] ?>">
                <div class="container">

                    <h5><?= $row['product_name'] ?></h5>
                    <p><?= $row['product_description'] ?></p>
                    <div class="compra">
                        <p><?php echo "R$" . number_format($row['product_price'], 2, ',', '.');?></p>
                        <a style='text-decoration: none; color: #000; ' href='<?php echo "add_to_cart.php?id=" . $row['product_id'];?>'><i class='bi bi-cart'></i></a>
                    </div>
                    <!-- <p><strong>Category:</strong> <?= $row['category_name'] ?></p>
                    <img src="uploads/categories/<?= $row['category_image'] ?>" alt="<?= $row['category_name'] ?>" style="width:50px;height:50px;">
                    não preciso mostrar isso nos cards, duh. mas deixa pra adja ver.-->
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

<?php

$conn->close();
?>