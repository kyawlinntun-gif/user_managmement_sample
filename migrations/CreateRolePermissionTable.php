<?php
class CreateRolePermissionTable 
{
  public function up($pdo)
  {
    $sql = "CREATE TABLE IF NOT EXISTS role_permissions (
      id INT PRIMARY KEY AUTO_INCREMENT,
      role_id INT,
      permission_id INT,
      FOREIGN KEY (role_id) REFERENCES roles(id),
      FOREIGN KEY (permission_id) REFERENCES permissions(id),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
  }

  public function down($pdo)
  {
    $sql = "DROP TABLE IF EXISTS role_permissions";
    $pdo->exec($sql);
  }
}