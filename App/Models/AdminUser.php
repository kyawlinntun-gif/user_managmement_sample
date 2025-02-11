<?php
namespace App\Models;
use App\Core\Database;
use PDO;
use PDOException;

class AdminUser
{
  private $db;
  public $name;
  public $username;
  public $role_id;
  public $phone;
  public $email;
  public $address;
  public $password;
  public $gender;
  public $is_active;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->getConnection();
  }

  public function save()
  {
    try {
      $stmt = $this->db->prepare("INSERT INTO admin_users (name, username, role_id, phone, email, address, password, gender, is_active) VALUES (:name, :username, :role_id, :phone, :email, :address, :password, :gender, :is_active)");
      $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
      $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
      $stmt->bindParam(":role_id", $this->role_id, PDO::PARAM_INT);
      $stmt->bindParam(":phone", $this->phone, PDO::PARAM_STR);
      $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
      $stmt->bindParam(":address", $this->address, PDO::PARAM_STR);
      $stmt->bindParam(':password', $this->password, PDO::PARAM_STR);
      $stmt->bindParam(":gender", $this->gender, PDO::PARAM_BOOL);
      $stmt->bindParam(':is_active', $this->is_active, PDO::PARAM_BOOL);
      return $stmt->execute();
    } catch (PDOException $e) {
      if ($e->getCode() == 23000) {
        return false;
      }
      echo "Error inserting admin users: " . $e->getMessage();
    }
  }

  public function getUserForAuth($email)
  {
    try {
      $stmt = $this->db->prepare("SELECT admin_users.id as admin_user_id, admin_users.name as admin_user_name, email, roles.name as role_name, password, is_active FROM admin_users LEFT JOIN roles ON admin_users.role_id = roles.id WHERE email = :email");
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->execute();
      $admin_user = $stmt->fetch(PDO::FETCH_ASSOC);
      return $admin_user;
    } catch (PDOException $e) {
      echo "Error getting admin user: " . $e->getMessage();
    }
  }

  public function getAllUsers()
  {
    try {
      $stmt = $this->db->prepare("SELECT admin_users.id as admin_user_id, admin_users.name as admin_user_name, username, roles.id as role_id, roles.name as role_name, phone, email, address, gender, is_active FROM admin_users LEFT JOIN roles ON admin_users.role_id = roles.id");
      $stmt->execute();
      $admin_users = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $admin_users;
    } catch (PDOException $e) {
      echo "Error getting admin users: " . $e->getMessage();
    }
  }

  public function getUserById($id)
  {
    try {
      $stmt = $this->db->prepare("SELECT id, name, username, role_id, phone, email, address, gender, is_active FROM admin_users WHERE id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $admin_user = $stmt->fetch(PDO::FETCH_ASSOC);
      return $admin_user;
    } catch (PDOException $e) {
      echo "Error getting admin users: " . $e->getMessage();
    }
  }

  public function update($id)
  {
    try {
      $stmt = $this->db->prepare("UPDATE admin_users SET name = :name, username = :username, role_id = :role_id, phone = :phone, email = :email, address = :address, gender = :gender, is_active = :is_active, updated_at = now() WHERE id = :id");
      $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
      $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
      $stmt->bindParam(":role_id", $this->role_id, PDO::PARAM_INT);
      $stmt->bindParam(":phone", $this->phone, PDO::PARAM_STR);
      $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
      $stmt->bindParam(":address", $this->address, PDO::PARAM_STR);
      $stmt->bindParam(":gender", $this->gender, PDO::PARAM_BOOL);
      $stmt->bindParam(':is_active', $this->is_active, PDO::PARAM_BOOL);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      return $stmt->execute();
    } catch (PDOException $e) {
      if ($e->getCode() == 23000) {
        return false;
      }
      echo "Error inserting admin user: " . $e->getMessage();
    }
  }

  public function delete($id)
  {
    try {
      $stmt = $this->db->prepare("DELETE FROM admin_users WHERE id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error deleting admin user: " . $e->getMessage();
    }
  }

  public function inActive($id)
  {
    try {
      $stmt = $this->db->prepare("UPDATE admin_users SET is_active = 0, updated_at = now() WHERE id = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting admin user: " . $e->getMessage();
    }
  }

  public function getAdminUsersPermissions()
  {
    try {
      $stmt = $this->db->prepare("SELECT admin_users.id as admin_user_id, permissions.id as permission_id FROM admin_users LEFT JOIN roles ON admin_users.role_id = roles.id LEFT JOIN role_permissions ON roles.id = role_permissions.role_id LEFT JOIN permissions ON role_permissions.permission_id = permissions.id;");
      $stmt->execute();
      $getAdminUsersPermissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $getAdminUsersPermissions;
    } catch (PDOException $e) {
      echo "Error getting admin user permission: " . $e->getMessage();
    }
  }

  public function updateAllData($roles, $features, $permissions)
  {
    try {
      foreach ($roles as $user_id => $role_id) {
        $stmt = $this->db->prepare("UPDATE admin_users SET role_id = :role_id WHERE id = :id");
        $stmt->bindParam(":role_id", $role_id, PDO::PARAM_INT);
        $stmt->bindParam(":id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
      }
      foreach ($permissions as $user_id => $permission_ids) {
        $stmt = $this->db->prepare("SELECT role_id FROM admin_users WHERE id = :id");
        $stmt->bindParam(":id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $role_id = $stmt->fetchColumn();
  
        $stmt = $this->db->prepare("DELETE FROM role_permissions WHERE role_id = :role_id");
        $stmt->bindParam(":role_id", $role_id, PDO::PARAM_INT);
        $stmt->execute();
  
        foreach ($permission_ids as $permissionId) {
          $stmt = $this->db->prepare("SELECT feature_id FROM permissions WHERE id = :id");
          $stmt->bindParam(":id", $permissionId, PDO::PARAM_INT);
          $stmt->execute();
          $featureId = $stmt->fetchColumn();

          if (isset($features[$user_id]) && in_array($featureId, $features[$user_id])) {
            $stmt = $this->db->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)");
            $stmt->bindParam(":role_id", $role_id, PDO::PARAM_INT);
            $stmt->bindParam(":permission_id", $permissionId, PDO::PARAM_INT);
            $stmt->execute();
          }
        }
      }
    } catch (PDOException $e) {
      echo "Error updating admin user, role, permission: " . $e->getMessage();
    }
  }

  public function hasPermission($user_id, $permission_name, $feature_name)
  {
    try{
      $stmt = $this->db->prepare("SELECT COUNT(*) FROM admin_users LEFT JOIN role_permissions ON admin_users.role_id = role_permissions.role_id LEFT JOIN permissions ON role_permissions.permission_id = permissions.id LEFT JOIN features ON permissions.feature_id = features.id WHERE admin_users.id = :user_id AND permissions.name = :permission_name AND features.name = :feature_name");
      $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
      $stmt->bindParam(":permission_name", $permission_name, PDO::PARAM_STR);
      $stmt->bindParam(":feature_name", $feature_name, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) { 
      echo "Error checking on permission: " . $e->getMessage();
    }
  }

  public function hasFeature($user_id, $feature_name)
  {
    try {
      $stmt = $this->db->prepare("SELECT COUNT(*) FROM admin_users LEFT JOIN role_permissions ON admin_users.role_id = role_permissions.role_id LEFT JOIN permissions ON role_permissions.permission_id = permissions.id LEFT JOIN features ON permissions.feature_id = features.id WHERE admin_users.id = :user_id AND features.name = :feature_name");
      $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
      $stmt->bindParam(":feature_name", $feature_name, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
      echo "Error checking on roles: " . $e->getMessage();
    }
  }

  public function getAnyRole()
  {
    if (!isset($_SESSION['user_id'])) {
      return false;
    }
    $user_id = (int) $_SESSION['user_id'];
    try {
      $stmt = $this->db->prepare("SELECT role_id FROM admin_users WHERE id = :id");
      $stmt->bindParam(":id", $user_id, PDO::PARAM_INT);
      $stmt->execute();
      $role_id = $stmt->fetchColumn();
      return is_null($role_id);
    } catch (PDOException $e) { 
      error_log("Error checking roles: " . $e->getMessage());
    }
  }

}
