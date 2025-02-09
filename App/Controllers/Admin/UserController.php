<?php
namespace App\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Validator\Validator;

class UserController {
  public function index()
  {
    $user = new User();
    $users = $user->getAllUsers();
    return view('admin.user.index', ['users' => $users]);
  }

  public function edit($id)
  {
    $user = new User();
    $getUser = $user->getUserById($id);
    $role = new Role();
    $roles = $role->getAllRoles(); 
    return view('admin.user.edit', ['user' => $getUser, 'roles' => $roles]);
  }

  public function update($request, $response, $id)
  {
    $data = [
      'user_id' => $id,
      'name' => $request->get('name'),
      'email' => $request->get('email'),
      'role_id' => $request->get('role_id')
    ];
    $rules = [
      'user_id' => 'required',
      'name' => 'required|min:2|string|no_special_chars',
      'email' => 'required|email',
      'role_id' => 'required'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['user_update'] = $validator->getErrors();
      $_SESSION['user_update'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $user = new User();
    $user->name = htmlspecialchars($data['name']);
    $user->email = $data['email'];
    $user->role_id = $data['role_id'];
    $user->update($data['user_id']);
    header("location: /admin/users");
    exit();
  }

  public function destroy($request, $response, $id)
  {
    $user = new User();
    $user->destroy($id);
    header("location: /admin/users");
    exit();
  }
}