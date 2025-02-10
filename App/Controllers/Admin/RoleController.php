<?php
namespace App\Controllers\Admin;

use App\Models\Role;
use App\Models\Feature;
use App\Models\AdminUser;
use App\Models\Permission;
use App\Validator\Validator;
use App\Models\RolePermission;

class RoleController {
  public function index()
  {
    $admin_user = new AdminUser();
    if(!$admin_user->hasPermission($_SESSION['user_id'], 'read', 'role')) {
      http_response_code(403);
      die("403 - Forbidden - You don't have permissions to access this method!");
    }
    $role = new Role();
    $roles = $role->getAllRoles();
    return view('admin.role.index', ['roles' => $roles]);
  }

  public function create()
  {
    $admin_user = new AdminUser();
    if(!$admin_user->hasPermission($_SESSION['user_id'], 'create', 'role')) {
      http_response_code(403);
      die("403 - Forbidden - You don't have permissions to access this method!");
    }
    return view('admin.role.create');
  }

  public function store($request)
  {
    $data = [
      'role_name' => $request->get('role_name')
    ];
    $rules = [
      'role_name' => 'required|min:3|string|no_special_chars',
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['role_create'] = $validator->getErrors();
      $_SESSION['role_create'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $role = new Role();
    $role->name = htmlspecialchars($data['role_name']);
    if(!$role->save()) {
      $_SESSION['fail'] = "This role was already created!";
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    header("location: /admin/roles");
    exit();
  }

  public function edit($request, $response, $id)
  {
    $admin_user = new AdminUser();
    if(!$admin_user->hasPermission($_SESSION['user_id'], 'update', 'role')) {
      http_response_code(403);
      die("403 - Forbidden - You don't have permissions to access this method!");
    }
    $role = new Role();
    $role->id = $id;
    $getRole = $role->getRoleById();
    return view('admin.role.edit', ['role' => $getRole]);
  }

  public function update($request, $response, $id)
  {
    $data = [
      'role_name' => $request->get('role_name'),
    ];
    $rules  = [
      'role_name' => 'required|min:3|string|no_special_chars',
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['role_update'] = $validator->getErrors();
      $_SESSION['role_update'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $role = new Role();
    $role->id = $id;
    $role->name = htmlspecialchars($data['role_name']);
    if(!$role->update()) {
      $_SESSION['fail'] = "This role was already updated!";
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    header("location: /admin/roles");
    exit();
  }

  public function destroy($request, $response, $id)
  {
    $admin_user = new AdminUser();
    if(!$admin_user->hasPermission($_SESSION['user_id'], 'delete', 'role')) {
      http_response_code(403);
      die("403 - Forbidden - You don't have permissions to access this method!");
    }
    $role = new Role();
    $role->id = $id;
    if(!$role->delete()) {
      $_SESSION['fail'] = "You need to delete user related with this role!";
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    header("location: /admin/roles");
    exit();
  }

  // public function manageRolePermission($request, $response, $id)
  // {
  //   $permission = new Permission();
  //   $permissions = $permission->getAllPermissions();

  //   $role = new Role();
  //   $permissionRole = $role->getPermissionsByRole($id);
  //   $permissionByRole = [];
  //   foreach($permissionRole as $permission) {
  //     $permissionByRole[] = $permission['permission_id'];
  //   }

  //   $getRole = $role->getRoleById($id);

  //   return view('admin.role.manage', ['permissions' => $permissions, 'permissionByRole' => $permissionByRole, 'role' => $getRole]);
  // }

  // public function updateRolePermission($request, $response, $id)
  // {
  //   $permissions = $request->get('permissions');
  //   $role = new Role();
  //   $role->updateRolePermissionsData($id, $permissions);
  //   header("Location: " . $_SERVER['HTTP_REFERER']);
  //   exit();
  // }
}