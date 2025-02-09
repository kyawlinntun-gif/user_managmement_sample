<?php
namespace App\Seeder;
require_once __DIR__ . '/../Models/RolePermission.php';
use App\Models\RolePermission;
class RolePermissionSeeder
{
  public function run()
  {
    $role_permissions = [
      ['role_id' => 1, 'permission_id' => 1],
      ['role_id' => 1, 'permission_id' => 2],
      ['role_id' => 1, 'permission_id' => 3],
      ['role_id' => 1, 'permission_id' => 4]
    ];
    foreach ($role_permissions as $new_role_permission) {
      $role_permission = new RolePermission();
      $role_permission->role_id = $new_role_permission['role_id'];
      $role_permission->permission_id = $new_role_permission['permission_id'];
      $role_permission->save();
    }
  }
}