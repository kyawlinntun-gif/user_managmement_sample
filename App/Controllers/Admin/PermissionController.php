<?php
namespace App\Controllers\Admin;

use App\Middleware\AuthMiddleware;
use App\Middleware\PermissionMiddleware;
use App\Middleware\RoleMiddleware;
use App\Models\Feature;
use App\Models\AdminUser;
use App\Models\Permission;
use App\Validator\Validator;

class PermissionController {
  public function __construct()
  {
    AuthMiddleware::check();
    RoleMiddleware::checkAnyRole();
  }
  public function index()
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'read', 'permissions');
    $permission = new Permission();
    $permissions = $permission->getAllPermissionsFeature();
    return view('admin.permission.index', ['permissions' => $permissions]);
  }

  public function create()
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'create', 'permissions');
    $feature = new Feature();
    $features = $feature->getAllFeatures();
    return view('admin.permission.create', ['features' => $features]);
  }

  public function store($request)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'create', 'permissions');
    $data = [
      'permission_name' => $request->get('permission_name'),
      'feature_id' => $request->get('feature_id')
    ];
    $rules = [
      'permission_name' => 'required|min:3|string',
      'feature_id' => 'required|number'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['permission_create'] = $validator->getErrors();
      $_SESSION['permission_create'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $permission = new Permission();
    $permission->name = htmlspecialchars($data['permission_name']);
    $permission->feature_id = $data['feature_id'];
    if(!$permission->save()) {
      $_SESSION['fail'] = "This permission for feature is already created!";
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    header('location: /admin/permissions');
    exit();
  }

  public function edit($request, $response, $id)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'update', 'permissions');
    $permission = new Permission();
    $permission->id = $id;
    $getPermission = $permission->getPermissionById();
    $feature = new Feature();
    $features = $feature->getAllFeatures();
    return view('admin.permission.edit', ['permission' => $getPermission, 'features' => $features]);
  }

  public function update($request, $response, $id)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'update', 'permissions');
    $data = [
      'permission_name' => $request->get('permission_name'),
      'feature_id' => $request->get('feature_id')
    ];
    $rules  = [
      'permission_name' => 'required|min:3|string',
      'feature_id' => 'required|number'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['permission_update'] = $validator->getErrors();
      $_SESSION['permission_update'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $permission = new Permission();
    $permission->id = $id;
    $permission->name = htmlspecialchars($data['permission_name']);
    $permission->feature_id = $data['feature_id'];
    if (!$permission->update()) {
      $_SESSION['fail'] = "This permission for feature is already updated!";
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    header("location: /admin/permissions");
    exit();
  }

  public function destroy($id)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'delete', 'permissions');
    $permission = new Permission();
    $permission->id = $id;
    if(!$permission->delete()) {
      $_SESSION['fail'] = "This permission is related with role!";
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    header("location: /admin/permissions");
    exit();
  }
}