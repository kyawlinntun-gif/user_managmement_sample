<?php
namespace App\Controllers\Admin;

use App\Models\Post;
use App\Validator\Validator;

class PostController {
  public function index()
  {
    $post = new Post();
    $posts = $post->getAllPosts();
    return view('admin.post.index', ['posts' => $posts]);
  }

  public function create()
  {
    return view('admin.post.create');
  }

  public function store($request)
  {
    $data = [
      'post_name' => $request->get('post_name'),
      'description' => $request->get('description'),
      'image' => $request->file('image') ?? null,
    ];
    $rules = [
      'post_name' => 'required|min:3|string',
      'description' => 'required|min:3|string',
      'image' => 'required|image_type:jpeg,png,jpg,gif|image_size:1'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['post_create'] = $validator->getErrors();
      $_SESSION['post_create'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $uploadImage = $data['image'];
    $uploadImageName = time() . $uploadImage['name'];
    $uploadImageTmp = $uploadImage['tmp_name'];
    $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/upload/' . $uploadImageName;
    move_uploaded_file($uploadImageTmp, $imagePath);
    $post = new Post();
    $post->post_name = htmlspecialchars($data['post_name']);
    $post->description = htmlentities($data['description']);
    $post->image = $uploadImageName;
    $post->save();
    header("location: /admin/posts");
    exit();
  }

  public function edit($request, $response, $id)
  {
    $post = new Post();
    $getPost = $post->getPostById($id);
    return view ('admin.post.edit', ['post' => $getPost]);
  }

  public function update($request, $response, $id)
  {
    $data = [
      'post_name' => $request->get('post_name'),
      'description' => $request->get('description')
    ];
    $rules = [
      'post_name' => 'required|min:3|string',
      'description' => 'required|min:3|string'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['post_update'] = $validator->getErrors();
      $_SESSION['post_update'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $post = new Post();
    $post->post_name = htmlspecialchars($data['post_name']);
    $post->description = htmlentities($data['description']);
    $post->update($id);
    header("location: /admin/posts");
    exit();
  }

  public function destroy($request, $reponse, $id)
  {
    $post = new Post();
    $post->destroy($id);
    header("location: /admin/posts");
    exit();
  }
}
