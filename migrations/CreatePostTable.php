<?php
class CreatePostTable
{
 public function up($pdo)
 {
  $sql = "CREATE TABLE IF NOT EXISTS posts(
    post_id INT PRIMARY KEY AUTO_INCREMENT,
    post_name VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    image VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  )";
  $pdo->exec($sql);
 }

 public function down($pdo)
 {
  $sql = "DROP TABLE IF EXISTS posts";
  $pdo->exec($sql);
 }
}