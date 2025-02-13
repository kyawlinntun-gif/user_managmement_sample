<?php
class CreateProductTable
{
 public function up($pdo)
 {
  $sql = "CREATE TABLE IF NOT EXISTS products(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  )";
  $pdo->exec($sql);
 }

 public function down($pdo)
 {
  $sql = "DROP TABLE IF EXISTS products";
  $pdo->exec($sql);
 }
}