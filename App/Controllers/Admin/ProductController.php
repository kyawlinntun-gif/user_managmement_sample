<?php
namespace App\Controllers\Admin;
class ProductController
{
  public function index()
  {
    return view('admin.product.index');
  }

  public function create()
  {
    return view('admin.product.create');
  }
}