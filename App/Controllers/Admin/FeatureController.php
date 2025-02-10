<?php
namespace App\Controllers\Admin;

use App\Models\AdminUser;
use App\Models\Feature;
use App\Models\Permission;
use App\Validator\Validator;

class FeatureController
{
  public function index()
  {
    $admin_user = new AdminUser();
    if(!$admin_user->hasPermission($_SESSION['user_id'], 'read', 'features')) {
      http_response_code(403);
      die("403 - Forbidden - You don't have permissions to access this method!");
    }
    $feature = new Feature();
    $features = $feature->getAllFeatures();
    return view('admin.feature.index', ['features' => $features]);
  }

  public function create()
  {
    $admin_user = new AdminUser();
    if(!$admin_user->hasPermission($_SESSION['user_id'], 'create', 'features')) {
      http_response_code(403);
      die("403 - Forbidden - You don't have permissions to access this method!");
    }
    return view('admin.feature.create');
  }

  public function store($request)
  {
    $data = [
      'feature_name' => $request->get('feature_name')
    ];
    $rules = [
      'feature_name' => 'required|min:3|string|no_special_chars'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['feature_create'] = $validator->getErrors();
      $_SESSION['feature_create'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $feature = new Feature();
    $feature->name = htmlspecialchars($data['feature_name']);
    if(!$feature->save()) {
      $_SESSION['fail'] = "This feature is already exist!";
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    header("location: /admin/features");
    exit();
  }

  public function edit($request, $response, $id)
  {
    $admin_user = new AdminUser();
    if(!$admin_user->hasPermission($_SESSION['user_id'], 'update', 'features')) {
      http_response_code(403);
      die("403 - Forbidden - You don't have permissions to access this method!");
    }
    $feature = new Feature();
    $feature->id = $id;
    $getFeature = $feature->getFeatureById();
    return view('admin.feature.edit', ['feature' => $getFeature]);
  }

  public function update($request, $response, $id)
  {
    $data = [
      'feature_name' => $request->get('feature_name')
    ];
    $rules  = [
      'feature_name' => 'required|min:3|string|no_special_chars'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['feature_update'] = $validator->getErrors();
      $_SESSION['feature_update'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $feature = new Feature();
    $feature->id = $id;
    $feature->name = htmlspecialchars($data['feature_name']);
    if(!$feature->update()) {
      $_SESSION['fail'] = "This feature is already exist!";
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    header("location: /admin/features");
    exit();
  }

  public function destroy($id)
  {
    $admin_user = new AdminUser();
    if(!$admin_user->hasPermission($_SESSION['user_id'], 'delete', 'features')) {
      http_response_code(403);
      die("403 - Forbidden - You don't have permissions to access this method!");
    }
    $feature = new Feature();
    $feature->id = $id;
    if(!$feature->delete()) {
      $_SESSION['fail'] = "This feature is relative with permissions!";
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    header("location: /admin/features");
    exit();
  }

  // public function manageFeaturePermission($request, $response, $id)
  // {
  //   $permission = new Permission();
  //   $permissions = $permission->getAllPermissions();

  //   $feature = new Feature();
  //   $permissionFeature = $feature->getPermissionsByFeature($id);
  //   $permissionByFeature = [];
  //   foreach($permissionFeature as $permission) {
  //     $permissionByFeature[] = $permission['permission_id'];
  //   }
  //   $getFeature = $feature->getFeatureById($id);

  //   return view('admin.feature.manage', ['permissions' => $permissions, 'permissionByFeature' => $permissionByFeature, 'feature' => $getFeature]);
  // }

  // public function updateFeaturePermission($request, $response, $id)
  // {
  //   $permissions = $request->get('permissions');
  //   $feature = new Feature();
  //   $feature->updateFeaturePermissionData($permissions, $id);
  //   header("Location: " . $_SERVER['HTTP_REFERER']);
  //   exit();
  // }
}