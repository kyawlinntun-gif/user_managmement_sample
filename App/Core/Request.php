<?php
namespace App\Core;

class Request
{
  public function getMethod()
  {
    return $_SERVER['REQUEST_METHOD'];
  }

  public function getUri()
  {
    return $_SERVER['REQUEST_URI'];
  }

  // Get the value from POST data
  public function get($key)
  {
      return isset($_POST[$key]) ? $_POST[$key] : null;
  }

  public function file($key)
  {
    return isset($_FILES[$key]) && $_FILES[$key]['error'] === 0 ? $_FILES[$key] : null;
  }
}