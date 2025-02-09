<?php
class CreatePermissionTable 
{
  public function up($pdo)
  {
    $sql = "CREATE TABLE IF NOT EXISTS permissions (
      permission_id INT PRIMARY KEY AUTO_INCREMENT,
      permission_name VARCHAR(100) UNIQUE NOT NULL,
      description TEXT,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
  }

  public function down($pdo)
  {
    $sql = "DROP TABLE IF EXISTS permissions";
    $pdo->exec($sql);
  }
}