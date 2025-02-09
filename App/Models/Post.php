<?php
namespace App\Models;
use PDO;
use PDOException;
use App\Core\Database;

class Post
{
  private $db;
  public $post_name;
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
      $stmt = $this->db->prepare("INSERT INTO posts (post_name, description, image) VALUES (:post_name, :description, :image)");
      $stmt->bindParam(':post_name', $this->post_name);
      $stmt->bindParam(':description', $this->description);
      $stmt->bindParam(':image', $this->image);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting posts: " . $e->getMessage();
    }
  }

  public function getAllPosts()
  {
    try {
      $stmt = $this->db->prepare("SELECT post_id, post_name, description, image FROM posts");
      $stmt->execute();
      $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $posts;
    } catch (PDOException $e) {
      echo "Error getting posts: " . $e->getMessage();
    }
  }

  public function getPostById($id)
  {
    try {
      $stmt = $this->db->prepare("SELECT post_id, post_name, description, image FROM posts WHERE post_id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $post = $stmt->fetch(PDO::FETCH_ASSOC);
      return $post;
    } catch (PDOException $e) { 
      echo "Error getting post: " . $e->getMessage();
    }
  }

  public function update($id)
  {
    try {
      $stmt = $this->db->prepare("UPDATE posts SET post_name = :post_name, description = :description WHERE post_id = :id");
      $stmt->bindParam(":post_name", $this->post_name);
      $stmt->bindParam(":description", $this->description);
      $stmt->bindParam(":id", $id);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error inserting post: " . $e->getMessage();
    }
  }

  public function destroy($id)
  {
    try {
      $stmt = $this->db->prepare("SELECT image FROM posts WHERE post_id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $post = $stmt->fetch(PDO::FETCH_ASSOC);
      $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/upload/' . $post['image'];
      if(file_exists($imagePath)) {
        unlink($imagePath);
      }
      $stmt = $this->db->prepare("DELETE FROM posts WHERE post_id = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error deleting post: " . $e->getMessage();
      die();
    }
  }
}