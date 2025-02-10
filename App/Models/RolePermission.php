<?php 
namespace App\Models;

use PDO;
use PDOException;
use App\Core\Database;

class RolePermission 
{
  private $db;
  public $role_id;
  public $permission_id;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->getConnection();
  }

  public function save()
  {
    try {
      $stmt = $this->db->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)");
      $stmt->bindParam(":role_id", $this->role_id, PDO::PARAM_INT);
      $stmt->bindParam(":permission_id", $this->permission_id, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting role_permissions: " . $e->getMessage();
    }
  }

  // function addRolePermission($role_id, $permission_id) 
  // {
  //   try {
  //     $stmt = $this->db->prepare("SELECT COUNT(*) FROM role_permissions WHERE role_id = :role_id AND permission_id = :permission_id");
  //     $stmt->bindParam(":role_id", $role_id, PDO::PARAM_INT);
  //     $stmt->bindParam(":permission_id", $permission_id, PDO::PARAM_INT);
  //     $stmt->execute();
  //     if ($stmt->fetchColumn() == 0) {
  //       $stmt = $this->db->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)");
  //       $stmt->bindParam(":role_id", $role_id, PDO::PARAM_INT);
  //       $stmt->bindParam(":permission_id", $permission_id, PDO::PARAM_INT);
  //       return $stmt->execute();
  //     } else {
  //       return false;
  //     } 
  //   } catch (PDOException $e) {
  //     echo "Error inserting role_permissions: " . $e->getMessage();
  //   }
  // }
}