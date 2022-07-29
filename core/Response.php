<?php

namespace app\core;
class Response 
{
  public function setStatusCode(int $code) 
  {
    http_response_code($code);
  }

  public function redirect(string $path)
  {
    header('Location: '.$path);
  }
  public function setJsonFormat()
  {
    header('Content-Type: application/json');    
  }
  public function setAccessControlOrigin()
  {
    header('Access-Control-Allow-Origin: *');
  }
}