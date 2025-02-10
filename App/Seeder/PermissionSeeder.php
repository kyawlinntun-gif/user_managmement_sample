<?php
namespace App\Seeder;
require_once __DIR__ . '/../Models/Permission.php';
use App\Models\Permission;
class PermissionSeeder
{
  public function run()
  {
    $permissions = [
      ['name' => 'create', 'feature_id' => 1],
      ['name' => 'read', 'feature_id' => 1],
      ['name' => 'update', 'feature_id' => 1],
      ['name' => 'delete', 'feature_id' => 1],
    ];
    foreach($permissions as $new_permission) {
      $permission = new Permission();
      $permission->name = $new_permission['name'];
      $permission->feature_id = $new_permission['feature_id'];
      $permission->save();
    }
  }
}