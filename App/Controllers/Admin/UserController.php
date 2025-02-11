<?php
namespace App\Controllers\Admin;

use App\Middleware\AuthMiddleware;
use App\Models\Role;
use App\Models\AdminUser;
use App\Validator\Validator;
use App\Middleware\PermissionMiddleware;
use App\Middleware\RoleMiddleware;

class UserController {
  public function __construct()
  {
    AuthMiddleware::check();
    RoleMiddleware::checkAnyRole();
  }
  public function index()
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'read', 'user');
    $admin_user = new AdminUser();
    $admin_users = $admin_user->getAllUsers();
    return view('admin.user.index', ['admin_users' => $admin_users]);
  }

  public function edit($id)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'update', 'user');
    $admin_user = new AdminUser();
    if(!$admin_user->hasPermission($_SESSION['user_id'], 'update', 'user')) {
      http_response_code(403);
      die("403 - Forbidden - You don't have permissions to access this method!");
    }
    $admin_user = new AdminUser();
    $getAdminUser = $admin_user->getUserById($id);
    $role = new Role();
    $roles = $role->getAllRoles(); 
    return view('admin.user.edit', ['admin_user' => $getAdminUser, 'roles' => $roles]);
  }

  public function create()
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'create', 'user');
    $admin_user = new AdminUser();
    if(!$admin_user->hasPermission($_SESSION['user_id'], 'create', 'user')) {
      http_response_code(403);
      die("403 - Forbidden - You don't have permissions to access this method!");
    }
    $role = new Role();
    $roles = $role->getAllRoles();
    return view('admin.user.create', ['roles' => $roles]);
  }

  public function store($request)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'create', 'user');
    $data = [
      'name' => $request->get('name'),
      'username' => $request->get('username'),
      'role_id' => $request->get('role_id'),
      'phone' => $request->get('phone'),
      'email' => $request->get('email'),
      'password' => $request->get('password'),
      'address' => $request->get('address'),
      'gender' => $request->get('gender'),
      'is_active' => $request->get('is_active')
    ];
    $rules = [
      'name' => 'required|min:2|string|no_special_chars',
      'username' => 'required|min:2|string',
      'role_id' => 'number',
      'phone' => 'required|phone',
      'email' => 'required|email',
      'password' => 'required|min:8|string',
      'address' => 'required|min:5|string',
      'gender' => 'required|boolean',
      'is_active' => 'required|boolean',
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['user_create'] = $validator->getErrors();
      $_SESSION['user_create'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $admin_user = new AdminUser();
    $admin_user->name = $data['name'];
    $admin_user->username = $data['username'];
    $admin_user->role_id = $data['role_id'];
    $admin_user->phone = $data['phone'];
    $admin_user->email = $data['email'];
    $admin_user->password = password_hash($data['password'], PASSWORD_BCRYPT);
    $admin_user->address = $data['address'];
    $admin_user->gender = $data['gender'];
    $admin_user->is_active = $data['is_active'];
    if(!$admin_user->save()) {
      $_SESSION['fail'] = "This email was already created!";
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    header("location: /admin/users");
    exit();
  }

  public function update($request, $response, $id)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'update', 'user');
    $data = [
      'name' => $request->get('name'),
      'username' => $request->get('username'),
      'role_id' => $request->get('role_id'),
      'phone' => $request->get('phone'),
      'email' => $request->get('email'),
      'address' => $request->get('address'),
      'gender' => $request->get('gender'),
      'is_active' => $request->get('is_active')
    ];
    $rules = [
      'name' => 'required|min:2|string|no_special_chars',
      'username' => 'required|min:2|string',
      'role_id' => 'number',
      'phone' => 'required|phone',
      'email' => 'required|email',
      'address' => 'required|min:5|string',
      'gender' => 'required|boolean',
      'is_active' => 'required|boolean',
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['user_update'] = $validator->getErrors();
      $_SESSION['user_update'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $admin_user = new AdminUser();
    $admin_user->name = $data['name'];
    $admin_user->username = $data['username'];
    $admin_user->role_id = $data['role_id'];
    $admin_user->phone = $data['phone'];
    $admin_user->email = $data['email'];
    $admin_user->address = $data['address'];
    $admin_user->gender = $data['gender'];
    $admin_user->is_active = $data['is_active'];
    if(!$admin_user->update($id)) {
      $_SESSION['fail'] = "This email was already updated!";
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    header("location: /admin/users");
    exit();
  }

  public function destroy($request, $response, $id)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'delete', 'user');
    $admin_user = new AdminUser();
    if(!$admin_user->hasPermission($_SESSION['user_id'], 'delete', 'user')) {
      http_response_code(403);
      die("403 - Forbidden - You don't have permissions to access this method!");
    }
    $admin_user = new AdminUser();
    $admin_user->delete($id);
    header("location: /admin/users");
    exit();
  }
}