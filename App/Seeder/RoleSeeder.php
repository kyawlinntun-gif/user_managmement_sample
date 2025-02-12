<?php
namespace App\Seeder;
require_once __DIR__ . '/../Models/Role.php';
use App\Models\Role;
class RoleSeeder
{
  public function run()
  {
    $roles = [
      ['name' => 'admin'],
      ['name' => 'operator'],
      ['name' => 'cashier'],
      ['name' => 'manage'],
    ];
    foreach ($roles as $new_role) {
      $role = new Role();
      $role->name = $new_role['name'];
      $role->save();
    }
  }
}