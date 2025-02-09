<?php
namespace App\Seeder;
require_once __DIR__ . '/../Models/Post.php';
use App\Models\Post;
class PostSeeder
{
  public function run()
  {
    $users = [
      ['post_name' => 'Post 1', 'description' => 'This is a sample description for post 1.', 'image' => 'https://via.placeholder.com/300x200?text=Blur&blur=10'],
      ['post_name' => 'Post 2', 'description' => 'This is a sample description for post 2.', 'image' => 'https://via.placeholder.com/300x200?text=Blur&blur=10'],
      ['post_name' => 'Post 3', 'description' => 'This is a sample description for post 3.', 'image' => 'https://via.placeholder.com/300x200?text=Blur&blur=10'],
      ['post_name' => 'Post 4', 'description' => 'This is a sample description for post 4.', 'image' => 'https://via.placeholder.com/300x200?text=Blur&blur=10'],
      ['post_name' => 'Post 5', 'description' => 'This is a sample description for post 5.', 'image' => 'https://via.placeholder.com/300x200?text=Blur&blur=10'],
      ['post_name' => 'Post 6', 'description' => 'This is a sample description for post 6.', 'image' => 'https://via.placeholder.com/300x200?text=Blur&blur=10'],
      ['post_name' => 'Post 7', 'description' => 'This is a sample description for post 7.', 'image' => 'https://via.placeholder.com/300x200?text=Blur&blur=10'],
      ['post_name' => 'Post 8', 'description' => 'This is a sample description for post 8.', 'image' => 'https://via.placeholder.com/300x200?text=Blur&blur=10'],
      ['post_name' => 'Post 9', 'description' => 'This is a sample description for post 9.', 'image' => 'https://via.placeholder.com/300x200?text=Blur&blur=10'],
      ['post_name' => 'Post 10', 'description' => 'This is a sample description for post 10.', 'image' => 'https://via.placeholder.com/300x200?text=Blur&blur=10']
    ];
    foreach ($users as $new_post) {
      $post = new Post();
      $post->post_name = $new_post['post_name'];
      $post->description = $new_post['description'];
      $post->image = $new_post['image'];
      $post->save();
    }
  }
}