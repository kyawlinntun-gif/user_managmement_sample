<?php
namespace App\Controllers\Admin;

use App\Models\Feature;
use App\Models\Permission;
use App\Validator\Validator;

class FeatureController
{
  public function index()
  {
    $feature = new Feature();
    $features = $feature->getAllFeatures();
    return view('admin.feature.index', ['features' => $features]);
  }

  public function create()
  {
    return view('admin.feature.create');
  }

  public function store($request)
  {
    $data = [
      'feature_name' => $request->get('feature_name'),
      'description' => $request->get('description')
    ];
    $rules = [
      'feature_name' => 'required|min:3|string|no_special_chars',
      'description' => 'required|min:3|string'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['feature_create'] = $validator->getErrors();
      $_SESSION['feature_create'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $feature = new Feature();
    $feature->feature_name = htmlspecialchars($data['feature_name']);
    $feature->description = htmlspecialchars($data['description']);
    $feature->save();
    header("location: /admin/features");
    exit();
  }

  public function edit($request, $response, $id)
  {
    $feature = new Feature();
    $getFeature = $feature->getFeatureById($id);
    return view('admin.feature.edit', ['feature' => $getFeature]);
  }

  public function update($request, $response, $id)
  {
    $data = [
      'feature_name' => $request->get('feature_name'),
      'description' => $request->get('description')
    ];
    $rules  = [
      'feature_name' => 'required|min:3|string',
      'description' => 'required|min:3|string'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['feature_update'] = $validator->getErrors();
      $_SESSION['feature_update'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $feature = new Feature();
    $feature->feature_name = htmlspecialchars($data['feature_name']);
    $feature->description = htmlspecialchars($data['description']);
    $feature->update($id);
    header("location: /admin/features");
    exit();
  }

  public function destroy($id)
  {
    $feature = new Feature();
    $feature->destroy($id);
    header("location: /admin/features");
    exit();
  }

  public function manageFeaturePermission($request, $response, $id)
  {
    $permission = new Permission();
    $permissions = $permission->getAllPermissions();

    $feature = new Feature();
    $permissionFeature = $feature->getPermissionsByFeature($id);
    $permissionByFeature = [];
    foreach($permissionFeature as $permission) {
      $permissionByFeature[] = $permission['permission_id'];
    }
    $getFeature = $feature->getFeatureById($id);

    return view('admin.feature.manage', ['permissions' => $permissions, 'permissionByFeature' => $permissionByFeature, 'feature' => $getFeature]);
  }

  public function updateFeaturePermission($request, $response, $id)
  {
    $permissions = $request->get('permissions');
    $feature = new Feature();
    $feature->updateFeaturePermissionData($permissions, $id);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
  }
}