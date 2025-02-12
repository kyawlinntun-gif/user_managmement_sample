<?php
namespace App\Models;

use PDO;
use PDOException;
use App\Core\Database;

class Product
{
  private $db;
  public $name;
  public $description;
  public $image;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->getConnection();
  }

  public function save()
  {
    try {
      $stmt = $this->db->prepare("INSERT INTO products (name, description, image) VALUES (:name, :description, :image)");
      $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
      $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
      $stmt->bindParam(':image', $this->image, PDO::PARAM_STR);
      return $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting role: " . $e->getMessage();
    }
  }

  public function getAllProducts()
  {
    try { 
      $stmt = $this->db->prepare("SELECT id, name, description, image FROM products");
      $stmt->execute();
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $products;
    } catch (PDOException $e) {
      echo "Error getting roles: " . $e->getMessage();
    }
  }

  public function getProductById($id)
  {
    try {
      $stmt = $this->db->prepare("SELECT id, name, description, image FROM products WHERE id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $product = $stmt->fetch(PDO::FETCH_ASSOC);
      return $product;
    } catch (PDOException $e) {
      echo "Error getting role: " . $e->getMessage();
    }
  }

  public function update($id)
  {
    try {
      $stmt = $this->db->prepare("UPDATE products SET name = :name, description = :description, updated_at = now() WHERE id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
      $stmt->bindParam(":description", $this->description, PDO::PARAM_STR);
      $stmt->execute();
    } catch (PDOException $e) { 
      echo "Error update role: " . $e->getMessage();
    }
  }

  public function delete($id)
  {
    try {
      $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      return $stmt->execute();
    } catch (PDOException $e) {
      echo "Error delete role: " . $e->getMessage();
    }
  }
}