<?php 
class CreateUserTable
{
  public function up($pdo)
  {
    $sql = "CREATE TABLE IF NOT EXISTS users (
      user_id INT PRIMARY KEY AUTO_INCREMENT,
      name VARCHAR(100) NOT NULL,
      email VARCHAR(255) UNIQUE NOT NULL,
      password VARCHAR(255) NOT NULL,
      role_id INT,
      FOREIGN KEY (role_id) REFERENCES roles(role_id),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
    )";
    $pdo->exec($sql);
  }

  public function down($pdo)
  {
    $sql = "DROP TABLE IF EXISTS users";
    $pdo->exec($sql);
  }
}