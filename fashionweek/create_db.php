<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loljape";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();



$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(50) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$sql_create_categories_table = "CREATE TABLE IF NOT EXISTS categories (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(100) DEFAULT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql_create_categories_table) === TRUE) {
    echo "Table 'categories' created successfully<br>";
} else {
    echo "Error creating table 'categories': " . $conn->error;
}


$sql_create_table = "CREATE TABLE IF NOT EXISTS products (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    category_id INT(6) UNSIGNED,
    image VARCHAR(255),
    price DECIMAL(10,2) NOT NULL DEFAULT '0.00',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql_create_table) === TRUE) {
    echo "Tabela de produtos criada com sucesso ou já existente<br>";
} else {
    echo "Erro ao criar tabela de produtos: " . $conn->error . "<br>";
}

$conn->close();
?>
