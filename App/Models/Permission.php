<?php
namespace App\Models;
use App\Core\Database;
use PDO;
use PDOException;

class Permission
{
  private $db;
  public $id;
  public $name;
  public $feature_id;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->getConnection();
  }

  public function save()
  {
    try {
      $stmt = $this->db->prepare("SELECT COUNT(*) FROM permissions WHERE name = :name AND feature_id = :feature_id");
      $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
      $stmt->bindParam(":feature_id", $this->feature_id, PDO::PARAM_INT);
      $stmt->execute();
      $count = $stmt->fetchColumn();

      if ($count > 0) {
        return false;
      }

      $stmt = $this->db->prepare("INSERT INTO permissions (name, feature_id) VALUES (:name, :feature_id)");
      $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
      $stmt->bindParam(":feature_id", $this->feature_id, PDO::PARAM_INT);
      return $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting permissions: " . $e->getMessage();
    }
  }

  public function getPermissionById()
  {
    try {
      $stmt = $this->db->prepare("SELECT id, name, feature_id FROM permissions WHERE id = :id");
      $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
      $stmt->execute();
      $permission = $stmt->fetch(PDO::FETCH_ASSOC);
      return $permission;
    } catch (PDOException $e) {
      echo "Error getting permissions: " . $e->getMessage();
    }
  }

  public function getAllPermissions()
  {
    try {
      $stmt = $this->db->prepare("SELECT id, name, feature_id FROM permissions");
      $stmt->execute();
      $permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $permissions;
    } catch (PDOException $e) {
      echo "Error getting permissions: " . $e->getMessage();
    }
  }

  public function getAllPermissionsFeature()
  {
    try {
      $stmt = $this->db->prepare("SELECT permissions.id as permission_id, permissions.name as permission_name, features.name as feature_name FROM permissions LEFT JOIN features ON permissions.feature_id = features.id;");
      $stmt->execute();
      $permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $permissions;
    } catch (PDOException $e) {
      echo "Error getting permissions: " . $e->getMessage();
    }
  }

  public function update() {
    try {
      if ($this->id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM permissions WHERE feature_id = :feature_id AND name = :name AND id != :id");
        $stmt->bindParam(":feature_id", $this->feature_id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $this->name, PDO::PARAM_STMT);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            return false;
        }
        $stmt = $this->db->prepare("UPDATE permissions SET name = :name, feature_id = :feature_id, updated_at = now() WHERE id = :id");
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
        $stmt->bindParam(":feature_id", $this->feature_id, PDO::PARAM_INT);
        return $stmt->execute();
      }
    } catch (PDOException $e) {
      echo "Error saving permission: " . $e->getMessage();
    }
  }

  public function delete() {
    try {
      $stmt = $this->db->prepare("SELECT COUNT(*) FROM role_permissions WHERE permission_id = :id");
      $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
      $stmt->execute();
      if ($stmt->fetchColumn() > 0) {
        return false;
      }
      $stmt = $this->db->prepare("DELETE FROM permissions WHERE id = :id");
      $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
      return $stmt->execute();
    } catch (PDOException $e) {
      echo "Error deleting permission: " . $e->getMessage();
      die();
    }
  }
}