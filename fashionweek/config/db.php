<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loljape";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// No arquivo db.php (exemplo simplificado)
function getUserById($user_id, $conn) {
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

?> 

