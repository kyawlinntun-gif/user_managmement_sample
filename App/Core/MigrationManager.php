<?php
namespace App\Core;
use PDO;
class MigrationManager
{
  private $pdo;
  private $migrationPath = __DIR__ . '/../../migrations/';

  public $migrateFiles = [
    'CreateRoleTable.php',
    'CreateAdminUserTable.php',
    'CreateFeatureTable.php',
    'CreatePermissionTable.php',
    'CreateRolePermissionTable.php',
    'CreateProductTable.php'
  ];
  
  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }
  
  public function migrate()
  {

    foreach ($this->migrateFiles as $file) {
      if ($file !== '.' && $file !== '..') {
        include_once $this->migrationPath . $file;
        $className = pathinfo($file, PATHINFO_FILENAME);
        $migration = new $className();
        $migration->up($this->pdo);
      }
    }
  }

  public function rollback()
  {
    $this->pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");

    foreach ($this->migrateFiles as $file) {
      if ($file !== '.' && $file !== '..') {
        include_once $this->migrationPath . $file;
        $className = pathinfo($file, PATHINFO_FILENAME);
        $migration = new $className();
        $migration->down($this->pdo);
      }
    }
  }

  public function refresh()
  {
    // Rollback all migrations
    $this->rollback();
    // Re-run all migrations
    $this->migrate();
  }
}