<?php
namespace App\Controllers;

use App\Models\Post;

class HomeController {
    public function index()
    {
        $post = new Post();
        $posts = $post->getAllPosts();
        return view('home', ['posts' => $posts]);
    }
}