<?php

namespace App\Controllers\Auth;

use App\Models\AdminUser;
use App\Validator\Validator;

class LoginController
{
  public function showLoginForm()
  {
    return view('auth.login');
  }

  public function login($request)
  {
    // Get input data from the request
    $data = [
      'email' => $request->get('email'),
      'password' => $request->get('password')
    ];
    // Validation rules
    $rules = [
      'email' => 'required',
      'password' => 'required'
    ];
    // Initialize the validator
    $validator = new Validator($data);
    // Run validation;
    if (!$validator->validate($rules)) {
      session_start();
      // Store errors in session
      $_SESSION['errors']['login'] = $validator->getErrors();
      $_SESSION['email'] = $data['email'];
      // Redirect back to the registration form
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit;
    }

    $admin_user = new AdminUser();
    $get_admin_user = $admin_user->getUserForAuth($request->get('email'));
    if (!$get_admin_user['is_active']) {
      $_SESSION['email'] = $data['email'];
      $_SESSION['fail'] = "Your account is disabled!";
      header("Location: /login");
      exit;
    }
    if ($get_admin_user && password_verify($request->get('password'), $get_admin_user['password'])) {
      $_SESSION['user_id'] = $get_admin_user['admin_user_id'];
      $_SESSION['user_name'] = $get_admin_user['admin_user_name'];
      $_SESSION['user_email'] = $get_admin_user['email'];
      $_SESSION['user_role'] = $get_admin_user['role_name'];
      header("location: /");
      exit;
    } else {
      $_SESSION['email'] = $data['email'];
      $_SESSION['fail'] = "Username or password is wrong!";
      header("location: /login");
      exit;
    }
  }

  public function logout()
  {
    // Destroy the session
    session_unset(); 
    session_destroy();
    // Remove the session cookie
    setcookie(session_name(), '', time() - 3600, '/');
    // Redirect to the login page after logout
    header('Location: /login');
    exit();
  }
}
