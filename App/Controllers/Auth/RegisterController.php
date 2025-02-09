<?php
namespace App\Controllers\Auth;

use App\Core\Request;
use App\Models\User;
use App\Validator\Validator;

class RegisterController
{
  public function showRegisterForm()
  {
    return view('auth.register');
  }

  public function register(Request $request)
  {
    // Get input data
    $name = $request->get('name');
    $email = $request->get('email');
    $password = $request->get('password');
    $passwordConfirmation = $request->get('password_confirmation');

    $data = [
      'name' => $name,
      'email' => $email,
      'password' => $password,
      'password_confirmation' => $passwordConfirmation
    ];

    // Validation rules
    $rules = [
      'name' => 'required|min:2|string|no_special_chars',
      'email' => 'required|email',
      'password' => 'required|min:8|string',
      'password_confirmation' => 'required|confirmed:password'
    ];
    // Initialize the validator
    $validator = new Validator($data);

    // Run validation;
    if (!$validator->validate($rules)) {
      session_start();
      // Store errors in session
      $_SESSION['errors']['register'] = $validator->getErrors();
      $_SESSION['register'] = $data;
      // Redirect back to the registration form
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit;
    }
    // Create a new user
    $user = new User();
    $user->name = htmlspecialchars($name);
    $user->email = $email;
    $user->password = password_hash($request->get('password'), PASSWORD_BCRYPT);
    $user->role_id = 3;
    $user->save();
    header("location: /login");
    exit();
  }
}