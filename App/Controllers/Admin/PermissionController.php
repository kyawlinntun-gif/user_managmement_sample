<?php
namespace App\Controllers\Admin;

use App\Models\Permission;
use App\Validator\Validator;

class PermissionController {
  public function index()
  {
    $permission = new Permission();
    $permissions = $permission->getAllPermissions();
    return view('admin.permission.index', ['permissions' => $permissions]);
  }

  public function create()
  {
    return view('admin.permission.create');
  }

  public function store($request)
  {
    $data = [
      'permission_name' => $request->get('permission_name'),
      'description' => $request->get('description')
    ];
    $rules = [
      'permission_name' => 'required|min:3|string',
      'description' => 'required|min:3|string|no_special_chars'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['permission_create'] = $validator->getErrors();
      $_SESSION['permission_create'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $permission = new Permission();
    $permission->permission_name = htmlspecialchars($data['permission_name']);
    $permission->description = htmlspecialchars($data['description']);
    $permission->save();
    header('location: /admin/permissions');
    exit();
  }

  public function edit($request, $response, $id)
  {
    $permission = new Permission();
    $getPermission = $permission->getPermissionsById($id);
    return view('admin.permission.edit', ['permission' => $getPermission]);
  }

  public function update($request, $response, $id)
  {
    $data = [
      'permission_name' => $request->get('permission_name'),
      'description' => $request->get('description')
    ];
    $rules  = [
      'permission_name' => 'required|min:3|string',
      'description' => 'required|min:3|string'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['permission_update'] = $validator->getErrors();
      $_SESSION['permission_update'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $permission = new Permission();
    $permission->permission_name = htmlspecialchars($data['permission_name']);
    $permission->description = htmlspecialchars($data['description']);
    $permission->update($id);
    header("location: /admin/permissions");
    exit();
  }

  public function destroy($id)
  {
    $permission = new Permission();
    $permission->destroy($id);
    header("location: /admin/permissions");
    exit();
  }
}