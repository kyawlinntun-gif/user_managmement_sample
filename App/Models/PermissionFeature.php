<?php
namespace App\Models;

use App\Core\Database;
use PDOException;

class PermissionFeature
{
  public $permission_id;
  public $feature_id;

  public function save()
  {
    $database = new Database();
    $db = $database->getConnection();
    try {
      $stmt = $db->prepare("INSERT INTO permission_features (permission_id, feature_id) VALUES (:permission_id, :feature_id)");
      $stmt->bindParam(":permission_id", $this->permission_id);
      $stmt->bindParam(":feature_id", $this->feature_id);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting permission_features: " . $e->getMessage();
    }
  }
}