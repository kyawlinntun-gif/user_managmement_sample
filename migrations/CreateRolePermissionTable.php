<?php
class CreateRolePermissionTable 
{
  public function up($pdo)
  {
    $sql = "CREATE TABLE IF NOT EXISTS role_permissions (
      role_id INT,
      permission_id INT,
      FOREIGN KEY (role_id) REFERENCES roles(role_id),
      FOREIGN KEY (permission_id) REFERENCES permissions(permission_id),
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