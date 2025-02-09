<?php 
namespace App\Models;

use App\Core\Database;
use PDOException;

class RolePermission 
{
  public $role_id;
  public $permission_id;

  public function save()
  {
    $database = new Database();
    $db = $database->getConnection();
    try {
      $stmt = $db->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)");
      $stmt->bindParam(":role_id", $this->role_id);
      $stmt->bindParam(":permission_id", $this->permission_id);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting role_permissions: " . $e->getMessage();
    }
  }
}