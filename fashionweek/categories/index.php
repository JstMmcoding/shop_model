<?php
include '../config/db.php';
include '../navbar.php';

$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
$categories = $conn->query("SELECT * FROM categories");
$products = null;

if ($category_id) {
    $products = $conn->query("SELECT * FROM products WHERE category_id = $category_id");
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
    <style>
        .card {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 15px;
            border-radius: 5px;
            width: 200px;
        }
        .card img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Categorias</h1>
    <div>
        <?php while($row = $categories->fetch_assoc()): ?>
            <a href="?category_id=<?= $row['id'] ?>">
                <div class="card">
                    <img src="../uploads/categories/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
                    <h2><?= $row['name'] ?></h2>
                </div>
            </a>
        <?php endwhile; ?>
    </div>

    <?php if ($category_id && $products): ?>
        <h1>Produtos na Categoria</h1>
        <div style="display: flex; flex-wrap: wrap;">
            <?php while($row = $products->fetch_assoc()): ?>
                <div class="card">
                    <img src="../uploads/products/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
                    <h2><?= $row['name'] ?></h2>
                    <p><?= $row['description'] ?></p>
                    <p><?= "<p>R$ " . number_format($row['price'], 2, ',', '.') . "</p>"; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</body>
</html>
