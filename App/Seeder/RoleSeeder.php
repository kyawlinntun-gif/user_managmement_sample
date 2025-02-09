<?php
namespace App\Seeder;
require_once __DIR__ . '/../Models/Role.php';
use App\Models\Role;
class RoleSeeder
{
  public function run()
  {
    $roles = [
      ['role_name' => 'admin', 'description' => 'Administrator with full access'],
      ['role_name' => 'editor', 'description' => 'Can edit content'],
      ['role_name' => 'viewer', 'description' => 'Can view content']
    ];
    foreach ($roles as $new_role) {
      $role = new Role();
      $role->role_name = $new_role['role_name'];
      $role->description = $new_role['description'];
      $role->save();
    }
  }
}