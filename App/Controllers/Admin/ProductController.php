<?php
namespace App\Controllers\Admin;

use App\Models\Product;
use App\Validator\Validator;
use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use App\Middleware\PermissionMiddleware;

class ProductController
{
  public function __construct()
  {
    AuthMiddleware::check();
    RoleMiddleware::checkAnyRole();
  }
  public function index()
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'read', 'product');
    $product = new Product();
    $products = $product->getAllProducts();
    return view('admin.product.index', [
      'products' => $products
    ]);
  }

  public function create()
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'create', 'product');
    return view('admin.product.create');
  }

  public function store($request)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'create', 'product');
    $data = [
      'product_name' => $request->get('product_name'),
      'description' => $request->get('description'),
      'image' => $request->file('image') ?? null,
    ];
    $rules = [
      'product_name' => 'required|min:3|string',
      'description' => 'required|min:3|string',
      'image' => 'image_type:jpeg,png,jpg,gif|image_size:5'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['product_create'] = $validator->getErrors();
      $_SESSION['product_create'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $uploadImage = $data['image'];
    $uploadImageName = time() . $uploadImage['name'];
    $uploadImageTmp = $uploadImage['tmp_name'];
    $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/upload/' . $uploadImageName;
    $product = new Product();
    $product->name = htmlspecialchars($data['product_name']);
    $product->description = htmlentities($data['description']);
    $product->image = $uploadImageName;
    if($product->save()) {
      move_uploaded_file($uploadImageTmp, $imagePath);
    }
    header("location: /admin/products");
    exit();
  }

  public function edit($request, $response, $id)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'update', 'product');
    $product = new Product();
    $getProduct = $product->getProductById($id);
    return view('admin.product.edit', ['product' => $getProduct]);
  }

  public function update($request, $response, $id)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'update', 'product');
    $data = [
      'product_name' => $request->get('product_name'),
      'description' => $request->get('description')
    ];
    $rules = [
      'product_name' => 'required|min:3|string',
      'description' => 'required|min:3|string'
    ];
    $validator = new Validator($data);
    if(!$validator->validate($rules)) {
      $_SESSION['errors']['product_update'] = $validator->getErrors();
      $_SESSION['product_update'] = $data;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
    $product = new Product();
    $product->name = htmlspecialchars($data['product_name']);
    $product->description = htmlspecialchars($data['description']);
    $product->update($id);
    header("location: /admin/products");
    exit();
  }

  public function destroy($id)
  {
    PermissionMiddleware::check($_SESSION['user_id'], 'delete', 'product');
    $product = new Product();
    $getProduct = $product->getProductById($id);
    $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/assets/upload/" . $getProduct['image'];
    if($product->delete($id)) {
      if (file_exists($imagePath)) {
        unlink($imagePath);
      }
    }
    header("location: /admin/products");
    exit();
  }
}