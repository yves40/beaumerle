<?php

namespace app\models;

use app\core\Application;

class LoginModel extends GenericModel {

  public string $email = 'y@free.fr';
  public string $password = '';

  // ------------------------------------------------------------------------
  public function login() {

    $user = UserModel::findOne([ "email" => $this->email ]);
    if (!$user) {
      $this->addError('email', 'User with this email is unknown');
      return false;
    }
    if( !password_verify($this->password, $user->password)) {
      $this->addError('password', 'Password is incorrect');
      return false;
    }
    return Application::$app->login($user);
  }
  // ------------------------------------------------------------------------
  public function rules(): array {
    return [
      'email' => [ self::RULE_REQUIRED, self::RULE_EMAIL ],
      'password' => [ self::RULE_REQUIRED ]
    ];
  }
  // ------------------------------------------------------------------------
  public function labels(): array {
    return [
      'email' => 'Your email',
      'password' => 'Your password please'
    ];
  }

}

?>