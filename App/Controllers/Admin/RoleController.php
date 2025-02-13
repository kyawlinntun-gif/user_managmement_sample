<?php
namespace App\Controllers\Admin;

use App\Middleware\AuthMiddleware;
use App\Models\Role;
use App\Models\Feature;
use App\Models\AdminUser;
use App\Models\Permission;
use App\Validator\Validator;
use App\Models\RolePermission;
use App\Middleware\PermissionMiddleware;
use App\Middleware\RoleMiddleware;

class RoleController {
  public function __construct()
  {
    AuthMiddleware::check();
    RoleMiddleware::checkAnyRole();
  }
  public function index()
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'read', 'role');
    $role = new Role();
    $roles = $role->getAllRoles();
    return view('admin.role.index', ['roles' => $roles]);
  }

  public function create()
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'create', 'role');
    return view('admin.role.create');
  }

  public function store($request)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'create', 'role');
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
    PermissionMiddleware::check($_SESSION['user_id'], 'update', 'role');
    $role = new Role();
    $role->id = $id;
    $getRole = $role->getRoleById();
    return view('admin.role.edit', ['role' => $getRole]);
  }

  public function update($request, $response, $id)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'update', 'role');
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
    PermissionMiddleware::check($_SESSION['user_id'], 'delete', 'role');
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
}