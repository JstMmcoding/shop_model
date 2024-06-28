<!-- admin/view_categories.php -->
<?php

include '../config/db.php';
include '../navbar.php';

// Verificar se o usuário está logado
if (!($_SESSION['role'] === 'admin')) {
    // Redirecionar para página de login ou página inicial
    header("Location: /fashionweek/auth/login.php");
    exit;
}

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<img src='../uploads/categories/" . $row['image'] . "' alt='Category Image' style='max-width: 200px;'>";
        echo "<a href='edit_category.php?id=" . $row['id'] . "'>Edit</a>";
        echo "</div>";
    }
} else {
    echo "No categories found.";
}

$conn->close();
?>

<body>
    
    <h3>Categoria</h3>
    <a href="add_category.php">Cadastrar Categorias</a>

    <h3>Produtos</h3>
    <a href="add_product.php">Cadastrar Produtos</a>


</body>