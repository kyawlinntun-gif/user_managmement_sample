<?php
namespace App\Models;
use App\Core\Database;
use PDO;
use PDOException;

class User
{
  private $db;
  public $name;
  public $email;
  public $password;
  public $role_id;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->getConnection();
  }

  public function save()
  {
    try {
      $stmt = $this->db->prepare("INSERT INTO users (name, email, password, role_id) VALUES (:name, :email, :password, :role_id)");
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':password', $this->password);
      $stmt->bindParam(':role_id', $this->role_id);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting users: " . $e->getMessage();
    }
  }

  public function update($id)
  {
    try {
      $stmt = $this->db->prepare("UPDATE users SET name = :name, email = :email, role_id = :role_id WHERE user_id = :id");
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':role_id', $this->role_id);
      $stmt->bindParam(':id', $id);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting users: " . $e->getMessage();
    }
  }

  public function getUserByEmail($email)
  {
    try {
      $stmt = $this->db->prepare("SELECT user_id, name, email, role_name FROM users LEFT JOIN roles ON users.role_id = roles.role_id WHERE email = :email");
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      return $user;
    } catch (PDOException $e) {
      echo "Error fetching user by email: " . $e->getMessage();
    }
  }

  public function getAllUsers()
  {
    try {
      $stmt = $this->db->prepare("SELECT user_id, name, email, role_name, GROUP_CONCAT(permission_name SEPARATOR ', ') as permission_name FROM users JOIN roles ON users.role_id = roles.role_id LEFT JOIN role_permissions ON roles.role_id = role_permissions.role_id LEFT JOIN permissions ON role_permissions.permission_id = permissions.permission_id GROUP BY user_id, name, email, role_name;");
      $stmt->execute();
      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $users;
    } catch (PDOException $e) {
      echo "Error fetching all users: " . $e->getMessage();
    }
  }

  public function getUserById($id)
  {
    try {
      $stmt = $this->db->prepare("SELECT user_id, name, email, users.role_id, role_name FROM users LEFT JOIN roles ON users.role_id = roles.role_id WHERE users.user_id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      return $user;
    } catch (PDOException $e) {
      echo "Error fetching user by id: " . $e->getMessage();
    }
  }

  public function destroy($id)
  {
    try {
      $stmt = $this->db->prepare("DELETE FROM users WHERE user_id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error fetching user by id: " . $e->getMessage();
    }
  }

  public function hasAnyRole(array $roles)
  {
    return isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], $roles);
  }

  public function hasAnyPermission(array $permissions)
  {
    if (!isset($_SESSION['user_id'])) {
      return false;
    }
    // Get user permissions from the database
    $stmt = $this->db->prepare("SELECT permissions.permission_name FROM permissions JOIN role_permissions ON permissions.permission_id = role_permissions.permission_id JOIN roles ON role_permissions.role_id = roles.role_id JOIN users ON users.role_id = roles.role_id WHERE users.user_id = :user_id");
    $stmt->bindParam(":user_id", $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $userPermissions = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Check if any of the given permissions exist in the user's permissions
    return !empty(array_intersect($permissions, $userPermissions));
  }
}