<?php
namespace App\Controllers\Admin;

use App\Middleware\AuthMiddleware;
use App\Middleware\PermissionMiddleware;
use App\Middleware\RoleMiddleware;
use App\Models\AdminUser;
use App\Models\Feature;
use App\Models\Permission;
use App\Validator\Validator;

class FeatureController
{
  public function __construct()
  {
    AuthMiddleware::check();
    RoleMiddleware::checkAnyRole();
  }
  public function index()
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'read', 'features');
    $feature = new Feature();
    $features = $feature->getAllFeatures();
    return view('admin.feature.index', ['features' => $features]);
  }

  public function create()
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'create', 'features');
    return view('admin.feature.create');
  }

  public function store($request)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'create', 'features');
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
    PermissionMiddleware::check($_SESSION['user_id'], 'update', 'features');
    $feature = new Feature();
    $feature->id = $id;
    $getFeature = $feature->getFeatureById();
    return view('admin.feature.edit', ['feature' => $getFeature]);
  }
  public function update($request, $response, $id)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'update', 'features');
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
    PermissionMiddleware::check($_SESSION['user_id'], 'delete', 'features');
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
}