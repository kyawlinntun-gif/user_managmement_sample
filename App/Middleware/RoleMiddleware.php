<?php

namespace App\Middleware;

class RoleMiddleware
{
  public static function handle(array $allowedRoles)
  {
    // Start session if not started
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    // Check if user is logged in and has a role
    if (!isset($_SESSION['user_id']) || !in_array($_SESSION['user_role'], $allowedRoles)) {
      http_response_code(403);
      die("403 - Forbidden - You need one of the following roles: " . implode(", ", $allowedRoles));
    }
  }
}