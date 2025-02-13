<?php
namespace App\Middleware;

use App\Models\AdminUser;

class PermissionMiddleware
{
  public static function check($userId, $action, $resource)
  {
    $adminUser = new AdminUser();
    if (!$adminUser->hasPermission($userId, $action, $resource)) {
        http_response_code(403);
        die("403 - Forbidden - You don't have permissions to access this method!");
    }
  }
}