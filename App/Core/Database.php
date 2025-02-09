<?php
namespace App\Core;
require_once __DIR__ . '/../../config/config.php';
use PDO;
use PDOException;
class Database
{
  private $host = DB_HOST;
  private $db_name = DB_NAME;
  private $username = DB_USER;
  private $password = DB_PASS;
  private $conn;

  public function __construct()
  {
    $this->conn = null;
    try {
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" .  $this->db_name, $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
      echo "Connection error: " . $exception->getMessage();
    }
  }

  public function getConnection()
  {
    return $this->conn;
  }
}