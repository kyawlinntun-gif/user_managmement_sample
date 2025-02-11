<?php
namespace App\Models;
use PDO;
use PDOException;
use App\Core\Database;

class Role
{
  private $db;
  public $id;
  public $name;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->getConnection();
  }

  public function save()
  {
    try {
      $stmt = $this->db->prepare("INSERT INTO roles (name) VALUES (:name)");
      $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);

      return $stmt->execute();
    } catch (PDOException $e) {
      if ($e->getCode() == 23000) {
        return false;
      }
      echo "Error inserting role: " . $e->getMessage();
    }
  }

  public function getAllRoles()
  {
    try { 
      $stmt = $this->db->prepare("SELECT id, name FROM roles");
      $stmt->execute();
      $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $roles;
    } catch (PDOException $e) {
      echo "Error getting roles: " . $e->getMessage();
    }
  }

  public function getRoleById()
  {
    try {
      $stmt = $this->db->prepare("SELECT id, name FROM roles WHERE id = :id");
      $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
      $stmt->execute();
      $role = $stmt->fetch(PDO::FETCH_ASSOC);
      return $role;
    } catch (PDOException $e) {
      echo "Error getting role: " . $e->getMessage();
    }
  }

  public function getRoleByName()
  {
    try {
      $stmt = $this->db->prepare("SELECT id, name FROM roles WHERE name = :name");
      $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
      $stmt->execute();
      $role = $stmt->fetch(PDO::FETCH_ASSOC);
      return $role;
    } catch (PDOException $e) {
      echo "Error getting role: " . $e->getMessage();
    }
  }

  public function update()
  {
    try {
      $stmt = $this->db->prepare("UPDATE roles SET name = :name, updated_at = now() WHERE id = :id");
      $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
      $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
      return $stmt->execute();
    } catch (PDOException $e) {
      if ($e->getCode() == 23000) {
        return false;
      }
      echo "Error getting role: " . $e->getMessage();
    }
  }


  // public function delete()
  // {
  //   try {
  //     $stmt = $this->db->prepare("DELETE FROM role_permissions WHERE role_id = :id");
  //     $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
  //     $stmt->execute();

  //     $stmt = $this->db->prepare("DELETE FROM roles WHERE id = :id");
  //     $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
  //     $stmt->execute();
  //     die();
  //   } catch (PDOException $e) {
  //     // if ($e->getCode() == 23000) {
  //     //   return false;
  //     // }
  //     echo "Error getting role: " . $e->getMessage();
  //     die();
  //   }
  // }

  public function delete()
{
    try {
        $stmt = $this->db->prepare("DELETE FROM role_permissions WHERE role_id = :role_id");
        $stmt->bindParam(":role_id", $this->id, PDO::PARAM_INT);
        $stmt->execute();
        
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM admin_users WHERE role_id = :role_id");
        $stmt->bindParam(":role_id", $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $userCount = $stmt->fetchColumn();

        if ($userCount > 0) {
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM roles WHERE id = :role_id");
        $stmt->bindParam(":role_id", $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        return "Error deleting role: " . $e->getMessage();
    }
}


  // public function getAllRolesPermissionsFeatures()
  // {
  //   try {
  //     $stmt = $this->db->prepare("SELECT roles.id AS role_id, roles.name AS role_name, GROUP_CONCAT(permissions.name SEPARATOR ', ') AS permissions, features.name AS feature_name FROM roles LEFT JOIN role_permissions ON roles.id = role_permissions.role_id LEFT JOIN permissions ON role_permissions.permission_id = permissions.id LEFT JOIN features ON permissions.feature_id = features.id GROUP BY roles.id, features.id");
  //     $stmt->execute();
  //     $rolesPermissionsFeatures = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //     return $rolesPermissionsFeatures;
  //   } catch (PDOException $e) {
  //     echo "Error getting rolesPermissionsFeatures: " . $e->getMessage();
  //   }
  // }
}








