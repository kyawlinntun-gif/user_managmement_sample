<?php
namespace App\Models;
use PDO;
use PDOException;
use App\Core\Database;

class Role
{
  private $db;
  public $role_name;
  public $description;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->getConnection();
  }

  public function save()
  {
    try {
      $stmt = $this->db->prepare("INSERT INTO roles (role_name, description) VALUES (:role_name, :description)");
      $stmt->bindParam(':role_name', $this->role_name);
      $stmt->bindParam(':description', $this->description);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting roles: " . $e->getMessage();
    }
  }

  public function getAllRoles()
  {
    try {
      $stmt = $this->db->prepare("SELECT role_id, role_name, description FROM roles");
      $stmt->execute();
      $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $roles;
    } catch (PDOException $e) {
      echo "Error fetching all roles: " . $e->getMessage();
    }
  }

  public function getRoleById($id)
  {
    try {
      $stmt = $this->db->prepare("SELECT role_id, role_name, description FROM roles WHERE role_id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $role = $stmt->fetch(PDO::FETCH_ASSOC);
      return $role;
    } catch (PDOException $e) {
      echo "Error fetching all roles: " . $e->getMessage();
    }
  }

  public function update($id)
  {
    try {
      $stmt = $this->db->prepare("UPDATE roles SET role_name = :role_name, description = :description WHERE role_id = :id");
      $stmt->bindParam(":role_name", $this->role_name);
      $stmt->bindParam(":description", $this->description);
      $stmt->bindParam(":id", $id);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting role: " . $e->getMessage();
    }
  }

  public function destroy($id)
  {
    try {
      $stmt = $this->db->prepare("DELETE FROM roles WHERE role_id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error fetching role by id: " . $e->getMessage();
    }
  }

  public function getPermissionsByRole($id)
  {
    try { 
      $stmt = $this->db->prepare("SELECT permissions.permission_id FROM roles LEFT JOIN role_permissions ON roles.role_id = role_permissions.role_id LEFT JOIN permissions ON role_permissions.permission_id = permissions.permission_id WHERE roles.role_id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $roles;
    } catch (PDOException $e) {
      echo "Error fetching permissions by role: " . $e->getMessage();
    }
  }

  public function updateRolePermissionsData($role_id, $permissions)
  {
    try {
        $stmt = $this->db->prepare("DELETE FROM role_permissions WHERE role_id = :role_id");
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $this->db->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)");
        foreach ($permissions as $permission_id) {
          $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
          $stmt->bindParam(':permission_id', $permission_id, PDO::PARAM_INT);
          $stmt->execute();
        }
    } catch (PDOException $e) {
      echo "Error updating role permissions: " . $e->getMessage();
    }
  }
}








