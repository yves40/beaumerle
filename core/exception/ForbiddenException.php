<?php

namespace app\core\exception;

use Exception;

class ForbiddenException extends Exception {

  protected $message = "Unauthorized access to this page";
  protected $code = "403";

}

?>