<?php
namespace App\Models;
use App\Core\Database;
use PDO;
use PDOException;

class Permission
{
  private $db;
  public $permission_name;
  public $description;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->getConnection();
  }

  public function save()
  {
    try {
      $stmt = $this->db->prepare("INSERT INTO permissions (permission_name, description) VALUES (:permission_name, :description)");
      $stmt->bindParam(':permission_name', $this->permission_name);
      $stmt->bindParam(":description", $this->description);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting permissions: " . $e->getMessage();
    }
  }

  public function getAllPermissions()
  {
    try {
      $stmt = $this->db->prepare("SELECT permission_id, permission_name, description FROM permissions");
      $stmt->execute();
      $permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $permissions; 
    } catch (PDOException $e) {
      echo "Error fetching all permissions: " . $e->getMessage();
    }
  }

  public function getPermissionsById($id)
  {
    try {
      $stmt = $this->db->prepare("SELECT permission_id, permission_name, description FROM permissions WHERE permission_id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $permission = $stmt->fetch(PDO::FETCH_ASSOC);
      return $permission;
    } catch (PDOException $e) {
      echo "Error fetching permission: " . $e->getMessage();
    }
  }

  public function update($id)
  {
    try {
      $stmt = $this->db->prepare("UPDATE permissions SET permission_name = :permission_name, description = :description WHERE permission_id = :id");
      $stmt->bindParam(":permission_name", $this->permission_name);
      $stmt->bindParam(":description", $this->description);
      $stmt->bindParam(":id", $id);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting permissions: " . $e->getMessage();
    }
  }

  public function destroy($id)
  {
    try {
      $stmt = $this->db->prepare("DELETE FROM permissions WHERE permission_id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error fetching permission by id: " . $e->getMessage();
    }
  }
}