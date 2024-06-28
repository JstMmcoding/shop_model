<?php
include '../config/db.php';
include '../navbar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $senha = $_POST['password'];
    $re_senha = $_POST['re-password'];

    if ($senha == $re_senha) {
        
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $email = $_POST['email'];
        $role = 'user'; // Definindo o papel como usuário comum por padrão
    
        $sql = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$password', '$email', '$role')";
    
        if ($conn->query($sql) === TRUE) {
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
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Senha inválida.";
    }

}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="/fashionweek/static/css/login.css">
</head>
<body>

    <div class="page">
        <form method="POST" class="formLogin">
            <h1>Cadastro</h1>
            <p>Digite os seus dados de acesso no campo abaixo </p>
            <label for="username">Nome</label>
            <input type="text" name="username" id="username" placeholder="Digite seu nome" required/>
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="Digite seu e-mail" required/>
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" placeholder="Digite sua senha" required/>
            <label for="re-password">Confirmar senha</label>
            <input type="password" name="re-password" id="re-password" placeholder="Confirme sua senha" required/>
            
            <a href="/fashionweek/auth/login.php">Já tenho uma conta</a>
            <input id="botao-login" type="submit" value="Cadastrar" class="btn" />
        </form>
  </div>
</body>
</html>
