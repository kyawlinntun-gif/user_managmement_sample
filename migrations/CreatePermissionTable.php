<?php
class CreatePermissionTable 
{
  public function up($pdo)
  {
    $sql = "CREATE TABLE IF NOT EXISTS permissions (
      id INT PRIMARY KEY AUTO_INCREMENT,
      name VARCHAR(100) NOT NULL,
      feature_id INT,
      FOREIGN KEY (feature_id) REFERENCES features(id),
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