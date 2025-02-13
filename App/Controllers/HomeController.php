<?php
namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\Product;

class HomeController {
    public function __construct()
    {
        AuthMiddleware::check();
    }
    public function index()
    {
        $product = new Product();
        $products = $product->getAllProducts();
        return view('home', ['products' => $products]);
    }
}