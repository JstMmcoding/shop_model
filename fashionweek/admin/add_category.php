<?php

include '../config/db.php';
include '../navbar.php';

// Verificar se o usuário está logado
if (!($_SESSION['role'] === 'admin')) {
    // Redirecionar para página de login ou página inicial
    header("Location: /fashionweek/auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Processando o upload da imagem
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "../uploads/categories/" . $image; // Diretório onde a imagem será armazenada
    
    move_uploaded_file($image_tmp, $image_path);

    $sql = "INSERT INTO categories (name, description, image) VALUES ('$name', '$description', '$image')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Category added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
</head>
<body>
<h2>Add Category</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Nome da Categoria:</label>
        <input type="text" name="name" required>
        <br>
        <label>Descrição da Categoria:</label>
        <textarea name="description" required></textarea>
        <br>
        <label>Imagem da Categoria:</label>
        <input type="file" name="image" accept="image/*" required>
        <br>
        <button type="submit">Add Categoria</button>
    </form>

    <h3>Categoria</h3>
    <a href="view_categories.php">Ver e Editar Categorias</a>

    <h3>Produtos</h3>
    <a href="view_products.php">Ver e Editar Produtos</a>
</body>
</html>
