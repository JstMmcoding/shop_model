<?php

include '../config/db.php';
include '../navbar.php';

// Verificar se o usuário está logado
if (!($_SESSION['role'] === 'admin')) {
    // Redirecionar para página de login ou página inicial
    header("Location: /fashionweek/auth/login.php");
    exit;
}

$categories = $conn->query("SELECT * FROM categories");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];
    $target_dir = "../uploads/products/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    $sql = "INSERT INTO products (name, description, price, image, category_id) VALUES ('$name', '$description', '$price', '$image', '$category_id')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="name" required>
        <br>
        <label>Description:</label>
        <textarea name="description" required></textarea>
        <br>
        <label>Product Price:</label>
        <input type="number" name="price" required>
        <br>
        <label>Category:</label>
        <select name="category_id" required>
            <?php while($row = $categories->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <label>Product Image:</label>
        <input type="file" name="image" required>
        <br>
        <button type="submit">Add Product</button>
    </form>

    <h3>Categoria</h3>
    <a href="view_categories.php">Ver e Editar Categorias</a>

    <h3>Produtos</h3>
    <a href="view_products.php">Ver e Editar Produtos</a>

</body>
</html>
