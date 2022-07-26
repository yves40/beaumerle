<?php

namespace app\core\exception;

class NotFoundException extends \Exception
{
  protected $message = "Page not found, contact site administrator please.";
  protected $code = "404";
}

?>