<!-- admin/edit_category.php -->
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
    $category_id = $_GET['id'];

    $sql = "SELECT * FROM categories WHERE id = $category_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $category = $result->fetch_assoc();
    } else {
        echo "Category not found.";
        exit;
    }
} else {
    echo "Category ID not provided.";
    exit;
}

// Processar o formulário de edição se for submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_POST['current_image']; // Manter a imagem atual

    // Se um novo arquivo de imagem for enviado, atualizar
    if (!empty($_FILES['image']['name'])) {
        $new_image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "../uploads/categories/" . $new_image;
        move_uploaded_file($image_tmp, $image_path);
        $image = $new_image;
    }

    $sql_update = "UPDATE categories SET name = '$name', description = '$description', image = '$image' WHERE id = $category_id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Category updated successfully";
        // Redirecionar para a página de visualização de categorias após a atualização
        header("Location: view_categories.php");
        exit;
    } else {
        echo "Error updating category: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
</head>
<body>
    <h2>Edit Category</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $category['name']; ?>" required>
        <br>
        <label>Description:</label>
        <textarea name="description" required><?php echo $category['description']; ?></textarea>
        <br>
        <label>Current Image:</label>
        <img src="../uploads/categories/<?php echo $category['image']; ?>" alt="Category Image" style="max-width: 200px;">
        <br>
        <label>New Image:</label>
        <input type="file" name="image" accept="image/*">
        <br>
        <!-- Hidden field to pass current image name -->
        <input type="hidden" name="current_image" value="<?php echo $category['image']; ?>">
        <button type="submit">Update Category</button>
    </form>
</body>
</html>
