<?php

namespace App\Middleware;

class AuthMiddleware
{
  public static function handle()
  {
    // Start session if not started
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    if (!isset($_SESSION['user_id'])) {
      // http_response_code(401);
      // die("401 Unauthorized - Please login.");
      header("location: /login");
      exit();
    }
  }
}