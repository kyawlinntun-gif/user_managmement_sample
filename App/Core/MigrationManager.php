<?php
namespace App\Core;
use PDO;
class MigrationManager
{
  private $pdo;
  private $migrationPath = __DIR__ . '/../../migrations/';

  public $migrateFiles = [
    'CreateRoleTable.php',
    'CreateUserTable.php',
    'CreatePermissionTable.php',
    'CreateFeatureTable.php',
    'CreateRolePermissionTable.php',
    'CreatePermissionFeatureTable.php',
    'CreatePostTable.php'
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
    // For foreign key dropdown
    $migrateFiles = array_reverse($this->migrateFiles);

    foreach ($migrateFiles as $file) {
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