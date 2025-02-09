<?php
namespace App\Middleware;

class GuestMiddleware
{
  public static function handle()
  {
    // Start session if not started
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
      
    // Check if the user is not logged in
    if (!isset($_SESSION['user_id'])) {
      // If not, can't go to logout page 
      header('Location: /login');
      exit();
    }
  }
}
