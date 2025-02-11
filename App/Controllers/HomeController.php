<?php
namespace App\Controllers;

use App\Middleware\AuthMiddleware;

class HomeController {
    public function __construct()
    {
        AuthMiddleware::check();
    }
    public function index()
    {
        return view('home');
    }
}