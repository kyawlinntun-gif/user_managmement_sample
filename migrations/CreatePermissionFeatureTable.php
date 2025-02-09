<?php
class CreatePermissionFeatureTable 
{
  public function up($pdo)
  {
    $sql = "CREATE TABLE IF NOT EXISTS permission_features (
      permission_id INT,
      feature_id INT,
      FOREIGN KEY (permission_id) REFERENCES permissions(permission_id),
      FOREIGN KEY (feature_id) REFERENCES features(feature_id),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
  }

  public function down($pdo)
  {
    $sql = "DROP TABLE IF EXISTS permission_features";
    $pdo->exec($sql);
  }
}