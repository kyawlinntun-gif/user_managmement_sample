<?php
namespace App\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Feature;
use App\Models\AdminUser;
use App\Models\Permission;

class HomeController
{
  public function index()
  {
    $admin_user = new AdminUser();
    $admin_users = $admin_user->getAllUsers();
    $role = new Role();
    $roles = $role->getAllRoles();
    $feature = new Feature();
    $features = $feature->getAllFeatures();
    $permission = new Permission();
    $permissions = $permission->getAllPermissions();
    return view('admin.home', [
      'admin_users' => $admin_users,
      'roles' => $roles,
      'features' => $features,
      'permissions' => $permissions
    ]);
  }

  public function updateAllData($request)
  {
    $admin_user = new AdminUser();
    $admin_user->updateAllData($request->get('roles'), $request->get('features'), $request->get('permissions'));
    header("location: /admin");
    exit();
  }

  // public function profile()
  // {
  //   $email = $_SESSION['user_email'];
  //   $user = new User();
  //   $data = $user->getUserByEmail($email);
  //   return view('admin.profile.index', ['data' => $data]);
  // }
}