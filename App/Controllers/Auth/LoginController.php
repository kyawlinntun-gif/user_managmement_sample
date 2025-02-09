<?php

namespace App\Controllers\Auth;

use App\Core\Database;
use App\Validator\Validator;
use PDO;

class LoginController
{
  private $db;

  public function __construct()
  {
    $database = new Database;
    $this->db = $database->getConnection();
  }

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

    $stmt = $this->db->prepare("SELECT user_id, name, email, password, role_name FROM users LEFT JOIN roles ON users.role_id = roles.role_id WHERE email = :email");
    $stmt->execute(['email' => $request->get('email')]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($request->get('password'), $user['password'])) {
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['user_name'] = $user['name'];
      $_SESSION['user_email'] = $user['email'];
      $_SESSION['user_role'] = $user['role_name'];
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
    // Start the session
    session_start();

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
