<?php
namespace App\Core;

class Response
{
  public function send($content)
  {
    echo $content;
  }
}