<?php
namespace App\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use App\Validator\Validator;

class RoleController {
  public function index()
  {
    $role = new Role();
    $roles = $role->getAllRoles();
    return view('admin.role.index', ['roles' => $roles]);
  }

  public function edit($request, $response, $id)
  {
    $role = new Role();
    $getRole = $role->getRoleById($id);
    return view('admin.role.edit', ['role' => $getRole]);
  }

  public function create()
  {
    return view('admin.role.create');
  }

  public function store($request)
  {
    $data = [
      'role_name' => $request->get('role_name'),
      'description' => $request->get('description')
    ];
    $rules = [
      'role_name' => 'required|min:3|string|no_special_chars',
      'description' => 'required|min:3|string'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['role_create'] = $validator->getErrors();
      $_SESSION['role_create'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $role = new Role();
    $role->role_name = htmlspecialchars($data['role_name']);
    $role->description = htmlspecialchars($data['description']);
    $role->save();
    header("location: /admin/roles");
    exit();
  }

  public function update($request, $response, $id)
  {
    $data = [
      'role_name' => $request->get('role_name'),
      'description' => $request->get('description')
    ];
    $rules  = [
      'role_name' => 'required|min:3|string|no_special_chars',
      'description' => 'required|min:3|string|no_special_chars'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['role_update'] = $validator->getErrors();
      $_SESSION['role_update'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $role = new Role();
    $role->role_name = htmlspecialchars($data['role_name']);
    $role->description = htmlspecialchars($data['description']);
    $role->update($id);
    header("location: /admin/roles");
    exit();
  }

  public function destroy($request, $response, $id)
  {
    $role = new Role();
    $role->destroy($id);
    header("location: /admin/roles");
    exit();
  }

  public function manageRolePermission($request, $response, $id)
  {
    $permission = new Permission();
    $permissions = $permission->getAllPermissions();

    $role = new Role();
    $permissionRole = $role->getPermissionsByRole($id);
    $permissionByRole = [];
    foreach($permissionRole as $permission) {
      $permissionByRole[] = $permission['permission_id'];
    }

    $getRole = $role->getRoleById($id);

    return view('admin.role.manage', ['permissions' => $permissions, 'permissionByRole' => $permissionByRole, 'role' => $getRole]);
  }

  public function updateRolePermission($request, $response, $id)
  {
    $permissions = $request->get('permissions');
    $role = new Role();
    $role->updateRolePermissionsData($id, $permissions);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
  }
}