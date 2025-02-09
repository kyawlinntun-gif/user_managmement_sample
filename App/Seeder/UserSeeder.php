<?php
namespace App\Seeder;
require_once __DIR__ . '/../Models/User.php';
use App\Models\User;
class UserSeeder
{
  public function run()
  {
    $users = [
      ['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => password_hash('password', PASSWORD_BCRYPT), 'role_id' => 1],
      ['name' => 'editor', 'email' => 'editor@gmail.com', 'password' => password_hash('password', PASSWORD_BCRYPT), 'role_id' => 2],
      ['name' => 'user', 'email' => 'user@gmail.com', 'password' => password_hash('password', PASSWORD_BCRYPT), 'role_id' => 3],
    ];
    foreach ($users as $new_user) {
      $user = new User();
      $user->name = $new_user['name'];
      $user->email = $new_user['email'];
      $user->password = $new_user['password'];
      $user->role_id = $new_user['role_id'];
      $user->save();
    }
  }
}