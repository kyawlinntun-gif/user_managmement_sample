<?php 
class CreateAdminUserTable
{
  public function up($pdo)
  {
    $sql = "CREATE TABLE IF NOT EXISTS admin_users (
      id INT PRIMARY KEY AUTO_INCREMENT,
      name VARCHAR(100) NOT NULL,
      username VARCHAR(255) NOT NULL,
      role_id INT,
      phone VARCHAR(100) NOT NULL,
      email VARCHAR(255) UNIQUE NOT NULL,
      address VARCHAR (255) NOT NULL,
      password VARCHAR(255) NOT NULL,
      gender BOOLEAN NOT NULL,
      is_active BOOLEAN NOT NULL,
      FOREIGN KEY (role_id) REFERENCES roles(id),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
    )";
    $pdo->exec($sql);
  }

  public function down($pdo)
  {
    $sql = "DROP TABLE IF EXISTS admin_users";
    $pdo->exec($sql);
  }
}