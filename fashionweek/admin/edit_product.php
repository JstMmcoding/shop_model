<!-- admin/edit_product.php -->
<?php

include '../config/db.php';
include '../navbar.php';

// Verificar se o usuário está logado
if (!($_SESSION['role'] === 'admin')) {
    // Redirecionar para página de login ou página inicial
    header("Location: /fashionweek/auth/login.php");
    exit;
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "Product ID not provided.";
    exit;
}

// Processar o formulário de edição se for submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $image = $_POST['current_image']; // Manter a imagem atual

    // Se um novo arquivo de imagem for enviado, atualizar
    if (!empty($_FILES['image']['name'])) {
        $new_image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "../uploads/products/" . $new_image;
        move_uploaded_file($image_tmp, $image_path);
        $image = $new_image;
    }

    $sql_update = "UPDATE products SET name = '$name', description = '$description', category_id = '$category_id', image = '$image' WHERE id = $product_id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Product updated successfully";
        // Redirecionar para a página de visualização de produtos após a atualização
        header("Location: view_products.php");
        exit;
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

// Query para selecionar todas as categorias
$sql_categories = "SELECT * FROM categories";
$result_categories = $conn->query($sql_categories);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
        <br>
        <label>Description:</label>
        <textarea name="description" required><?php echo $product['description']; ?></textarea>
        <br>
        <label>Category:</label>
        <select name="category_id" required>
            <?php
            if ($result_categories->num_rows > 0) {
                while ($row = $result_categories->fetch_assoc()) {
                    $selected = ($row['id'] == $product['category_id']) ? 'selected' : '';
                    echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                }
            } else {
                echo "<option value=''>No categories found</option>";
            }
            ?>
        </select>
        <br>
        <label>Current Image:</label>
        <img src="../uploads/products/<?php echo $product['image']; ?>" alt="Product Image" style="max-width: 200px;">
        <br>
        <label>New Image:</label>
        <input type="file" name="image" accept="image/*">
        <br>
        <!-- Hidden field to pass current image name -->
        <input type="hidden" name="current_image" value="<?php echo $product['image']; ?>">
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
