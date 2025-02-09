<?php
namespace App\Middleware;

class RedirectIfAuthenticate
{
  public static function handle()
  {
    // Start session if not started
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
      
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
      // If not, redirect them to the login page
      header('Location: /');
      exit();
    }
  }
}