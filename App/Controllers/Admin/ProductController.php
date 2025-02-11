<?php
namespace App\Controllers\Admin;

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;

class ProductController
{
  public function __construct()
  {
    AuthMiddleware::check();
    RoleMiddleware::checkAnyRole();
  }
  public function index()
  {
    return view('admin.product.index');
  }

  public function create()
  {
    return view('admin.product.create');
  }
}