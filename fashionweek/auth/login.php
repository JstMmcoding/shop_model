<?php
include '../config/db.php';
include '../navbar.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Se autenticação for bem-sucedida
            $result_role = $conn->query("SELECT role FROM users WHERE username = '$username'");
        
            // Atribui o result_role da consulta à variável $role
            $role = strval($result_role->fetch_assoc()["role"]);
        
            // Atribui o valor da variável $nome_cliente à variável de sessão nome_do_cliente
            $_SESSION['role'] = strval($role);

            $_SESSION['username'] = $username; // Definir o username do usuário na sessão
            $_SESSION['user_id'] = strval($user_id); // Definir o ID do usuário na sessão

            
            

            // Redirecionar para página de destino após login
            header('Location: /fashionweek/index.php');
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Nenhum usuário encontrado.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/fashionweek/static/css/login.css">
</head>
<body>

    <div class="page">
        <form method="POST" class="formLogin" action="">
            <h1>Login</h1>
            <p>Digite os seus dados de acesso no campo abaixo </p>
            <label for="username">Nome</label>
            <input type="text" name="username" id="username" placeholder="Digite seu nome" />
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" placeholder="Digite sua senha" />

            <!-- NÃO FIZ ESSA FUNCTION <a href="./esqueci.html">Esqueci senha</a> -->
            <a href="/fashionweek/auth/register.php">Não tenho uma conta</a>
            <input id="botao-login" type="submit" value="Entrar" class="btn" />
        </form>
    </div>
</body>
</html>
