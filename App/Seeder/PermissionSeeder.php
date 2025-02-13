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
      ['name' => 'create', 'feature_id' => 2],
      ['name' => 'read', 'feature_id' => 2],
      ['name' => 'update', 'feature_id' => 2],
      ['name' => 'delete', 'feature_id' => 2],
      ['name' => 'create', 'feature_id' => 3],
      ['name' => 'read', 'feature_id' => 3],
      ['name' => 'update', 'feature_id' => 3],
      ['name' => 'delete', 'feature_id' => 3],
      ['name' => 'create', 'feature_id' => 4],
      ['name' => 'read', 'feature_id' => 4],
      ['name' => 'update', 'feature_id' => 4],
      ['name' => 'delete', 'feature_id' => 4],
      ['name' => 'create', 'feature_id' => 5],
      ['name' => 'read', 'feature_id' => 5],
      ['name' => 'update', 'feature_id' => 5],
      ['name' => 'delete', 'feature_id' => 5],
    ];
    foreach($permissions as $new_permission) {
      $permission = new Permission();
      $permission->name = $new_permission['name'];
      $permission->feature_id = $new_permission['feature_id'];
      $permission->save();
    }
  }
}