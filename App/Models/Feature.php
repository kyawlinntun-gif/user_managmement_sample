<?php
namespace App\Models;
use App\Core\Database;
use PDO;
use PDOException;
class Feature
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
      $stmt = $this->db->prepare("INSERT INTO features (name) VALUES (:name)");
      $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
      return $stmt->execute();
    } catch (PDOException $e) {
      if ($e->getCode() == 23000) {
        return false;
      }
      echo "Error inserting features: " . $e->getMessage();
    }
  }

  public function getAllFeatures()
  {
    try {
      $stmt = $this->db->prepare("SELECT id, name FROM features");
      $stmt->execute();
      $features = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $features;
    } catch (PDOException $e) {
      echo "Error getting features: " . $e->getMessage();
    }
  }

  public function getFeatureById()
  {
    try {
      $stmt = $this->db->prepare("SELECT id, name FROM features WHERE id = :id");
      $stmt->bindParam(':id', $this->id);
      $stmt->execute();
      $features = $stmt->fetch(PDO::FETCH_ASSOC);
      return $features;
    } catch (PDOException $e) {
      echo "Error getting features: " . $e->getMessage();
    }
  }

  public function update()
  {
    try {
      $stmt = $this->db->prepare("UPDATE features SET name = :name, updated_at = now() WHERE id = :id");
      $stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':name', $this->name);
      return $stmt->execute();
    } catch (PDOException $e) {
      if ($e->getCode() == 23000) {
        return false;
      }
      echo "Error getting features: " . $e->getMessage();
    }
  }

  function delete() 
  {
    try {
    $stmt = $this->db->prepare("SELECT COUNT(*) FROM permissions WHERE feature_id = :id");
    $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    if ($count > 0) {
        return false;
    }
    $stmt = $this->db->prepare("DELETE FROM features WHERE id = :id");
    $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
    return $stmt->execute();
    } catch (PDOException $e) {
        echo "Error deleting feature: " . $e->getMessage();
        return false;
    }
  }

}