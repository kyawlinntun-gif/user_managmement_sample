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
      ['role_id' => 1, 'permission_id' => 4],
      ['role_id' => 1, 'permission_id' => 5],
      ['role_id' => 1, 'permission_id' => 6],
      ['role_id' => 1, 'permission_id' => 7],
      ['role_id' => 1, 'permission_id' => 8],
      ['role_id' => 1, 'permission_id' => 9],
      ['role_id' => 1, 'permission_id' => 10],
      ['role_id' => 1, 'permission_id' => 11],
      ['role_id' => 1, 'permission_id' => 12],
      ['role_id' => 1, 'permission_id' => 13],
      ['role_id' => 1, 'permission_id' => 14],
      ['role_id' => 1, 'permission_id' => 15],
      ['role_id' => 1, 'permission_id' => 16],
      ['role_id' => 1, 'permission_id' => 17],
      ['role_id' => 1, 'permission_id' => 18],
      ['role_id' => 1, 'permission_id' => 19],
      ['role_id' => 1, 'permission_id' => 20],
    ];
    foreach ($role_permissions as $new_role_permission) {
      $role_permission = new RolePermission();
      $role_permission->role_id = $new_role_permission['role_id'];
      $role_permission->permission_id = $new_role_permission['permission_id'];
      $role_permission->save();
    }
  }
}