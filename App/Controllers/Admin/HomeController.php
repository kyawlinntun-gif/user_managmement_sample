<?php
namespace App\Controllers\Admin;
use App\Models\User;
class HomeController
{
  public function index()
  {
    return view('admin.home');
  }

  public function profile()
  {
    $email = $_SESSION['user_email'];
    $user = new User();
    $data = $user->getUserByEmail($email);
    return view('admin.profile.index', ['data' => $data]);
  }
}