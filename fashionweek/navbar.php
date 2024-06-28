<?php

// Inicializar variável para contar itens no carrinho
$cart_count = 0;

// Verificar se existe um carrinho na sessão
if (isset($_SESSION['cart'])) {
    // Contar o número total de itens no carrinho
    $cart_count = array_sum($_SESSION['cart']);
}
?>




<!DOCTYPE html>
<html>
    <head>
        <title>Navbar</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/fashionweek/static/css/main.css">
        

    </head>
<body>

<nav class="navbar">
    <div class="logo">
        <a href="/fashionweek/index.php">
            <img src='/fashionweek/static/img/logo.png' alt="Logo Tim Maia" width='100%'>
            <h1> Froppy </h1>
        </a>
    </div>

    <div class="menu">
        <a href="/fashionweek/index.php" class="bi bi-house-fill"> Home </a>
        <a href="/fashionweek/categories/index.php" class="bi bi-box2-heart-fill"> Catálogo</a>
        

        <?php if (isset($_SESSION['username'])): ?>
            <?php if ($_SESSION['role'] === 'admin'):?>
                <a href="/fashionweek/admin/add_category.php" class="admin-btn">Add Categoria</a>;
                <a href="/fashionweek/admin/add_product.php" class="admin-btn">Add Produto</a>;
            <?php endif; ?>

            <a href="/fashionweek/cart.php"> <i class="bi bi-cart-fill"></i> (<?php echo $cart_count; ?>)</a>

            <a id="botao-login" href="/fashionweek/auth/logout.php">
                Logout (<?= $_SESSION['username'] ?>)
                <i class="bi bi-person-fill"></i>
            </a>
            <?php else: ?>
                <a id="botao-login" href="/fashionweek/auth/login.php">
                    Login <i class="bi bi-person-fill"></i>
                </a>
        <?php endif; ?>
      
    </div>
</nav>

</body>
</html>

