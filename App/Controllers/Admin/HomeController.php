<?php
namespace App\Controllers\Admin;

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use App\Models\Role;
use App\Models\User;
use App\Models\Feature;
use App\Models\AdminUser;
use App\Models\Permission;

class HomeController
{
  public function __construct()
  {
    AuthMiddleware::check();
    RoleMiddleware::checkAnyRole();
  }
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
    $features = $request->get('features') ? $request->get('features') : [];
    $permissions = $request->get('permissions') ? $request->get('permissions') : [];
    $admin_user = new AdminUser();
    $admin_user->updateAllData($request->get('roles'), $features, $permissions);
    header("location: /admin");
    exit();
  }
}