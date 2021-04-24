<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


//------ADMISSION----------
include_once '../config/database.php';
$database = new Database();
$db = $database->getConnection();

$userTable = "CREATE TABLE IF NOT EXISTS users(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
phone VARCHAR(50) NOT NULL,
password VARCHAR(100) NOT NULL,
status VARCHAR(50) NOT NULL,
role VARCHAR(50) NOT NULL,
createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if($db->prepare($userTable)){
	echo"users table created OK ";
}else{
	echo"users table NOT created";
}

$categoryTable = "CREATE TABLE IF NOT EXISTS categories(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL,
delete_status VARCHAR(50) NOT NULL,
createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if($db->prepare($categoryTable)){
	echo"categoryTable table created OK ";
}else{
	echo"categoryTable table NOT created";
}


$products = "CREATE TABLE IF NOT EXISTS products(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL,
SKU VARCHAR(50) NOT NULL,
description VARCHAR(1000) NOT NULL,
categoryId INT(50) NOT NULL,
imagePath VARCHAR(100) NOT NULL,
delete_status VARCHAR(50) NOT NULL,
createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
UNIQUE (SKU),
CONSTRAINT products.categoryId FOREIGN KEY (categoryId) REFERENCES categories(id) ON DELETE CASCADE
) ";

if($db->prepare($products)){
	echo"products table created OK ";
}else{
	echo"products table NOT created";
}


$orders = "CREATE TABLE IF NOT EXISTS orders(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
userId VARCHAR(50) NOT NULL,
productId VARCHAR(50) NOT NULL,
quantity VARCHAR(1000) NOT NULL,
total VARCHAR(1000) NOT NULL,
delete_status VARCHAR(50) NOT NULL,
createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
FOREIGN KEY (userId) REFERENCES users(id),
FOREIGN KEY (productId) REFERENCES products(id),
)";

if($db->prepare($orders)){
	echo"orders table created OK";
}else{
	echo"orders table NOT created";
}



?>

