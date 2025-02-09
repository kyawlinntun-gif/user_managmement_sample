<?php
namespace App\Models;
use App\Core\Database;
use PDO;
use PDOException;
class Feature
{
  private $db;
  public $feature_name;
  public $description;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->getConnection();
  }

  public function save()
  {
    try {
      $stmt = $this->db->prepare("INSERT INTO features (feature_name, description) VALUES (:feature_name, :description)");
      $stmt->bindParam(":feature_name", $this->feature_name);
      $stmt->bindParam(":description", $this->description);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting features: " . $e->getMessage();
    }
  }

  public function getAllFeatures()
  {
    try {
      $stmt = $this->db->prepare("SELECT feature_id, feature_name, description FROM features");
      $stmt->execute();
      $features = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $features;
    } catch (PDOException $e) {
      echo "Error getting features: " . $e->getMessage();
    }
  }

  public function getFeatureById($id)
  {
    try {
      $stmt = $this->db->prepare("SELECT feature_id, feature_name, description FROM features WHERE feature_id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $feature = $stmt->fetch(PDO::FETCH_ASSOC);
      return $feature;
    } catch (PDOException $e) {
      echo "Error getting feature: " . $e->getMessage();
    }
  }

  public function update($id)
  {
    try {
      $stmt = $this->db->prepare("UPDATE features SET feature_name = :feature_name, description = :description WHERE feature_id = :id");
      $stmt->bindParam(":feature_name", $this->feature_name);
      $stmt->bindParam(":description", $this->description);
      $stmt->bindParam(":id", $id);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting feature: " . $e->getMessage();
    }
  }
  
  public function destroy($id)
  {
    try {
      $stmt = $this->db->prepare("DELETE FROM features WHERE feature_id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error deleting feature: " . $e->getMessage();
    }
  }

  public function getPermissionsByFeature($id)
  {
    try { 
      $stmt = $this->db->prepare("SELECT permissions.permission_id FROM features LEFT JOIN permission_features ON features.feature_id = permission_features.feature_id LEFT JOIN permissions ON permission_features.permission_id = permissions.permission_id WHERE features.feature_id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $roles;
    } catch (PDOException $e) {
      echo "Error fetching permissions by feature: " . $e->getMessage();
    }
  }

  public function updateFeaturePermissionData($permissions, $feature_id)
  {
    try {
        $stmt = $this->db->prepare("DELETE FROM permission_features WHERE feature_id = :feature_id");
        $stmt->bindParam(':feature_id', $feature_id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $this->db->prepare("INSERT INTO permission_features (permission_id, feature_id) VALUES (:permission_id, :feature_id)");
        foreach ($permissions as $permission_id) {
          $stmt->bindParam(':permission_id', $permission_id, PDO::PARAM_INT);
          $stmt->bindParam(':feature_id', $feature_id, PDO::PARAM_INT);
          $stmt->execute();
        }
    } catch (PDOException $e) {
      echo "Error updating feature permissions: " . $e->getMessage();
      die();
    }
  }
}