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
      header("location: /login");
      exit();
    }
  }

  public static function check()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    if (!isset($_SESSION['user_id'])) {
      header("location: /login");
      exit();
    }
  }
}