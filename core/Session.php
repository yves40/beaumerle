<?php

namespace app\core;

class Session {

  protected const FLASH_KEY = 'flash_messages';
  // ------------------------------------------------------------------------
  public function __construct() {
    session_start();
    $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
    foreach($flashMessages as $key => &$flashMessage) {
      // Mark messages to be removed 
      $flashMessage['remove'] = true;
    }
    $_SESSION[self::FLASH_KEY] = $flashMessages;
    // Application::$app->trace($_SESSION[self::FLASH_KEY]);
  }
  // ------------------------------------------------------------------------
  public function setFlash($key, $message) {
    $_SESSION[self::FLASH_KEY][$key] = [
      'remove' => false,
      'value' => $message
    ];
  }
  // ------------------------------------------------------------------------
  public function getFlash($key) {
    return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
  }
  // ------------------------------------------------------------------------
  public function set($key, $value) {
    $_SESSION[$key] = $value;
  }
  // ------------------------------------------------------------------------
  public function get($key) {
    return $_SESSION[$key] ?? false;
  }
  // ------------------------------------------------------------------------
  public function remove($key) {
    unset($_SESSION[$key]);
  }
  // ------------------------------------------------------------------------
  public function __destruct() {
    $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
    // Iterate over marked to be removed messages
    foreach($flashMessages as $key => &$flashMessage) {
      // Mark messages to be removed 
      if ($flashMessage['remove']) {
        unset($flashMessages[$key]);
      }
    }
    $_SESSION[self::FLASH_KEY] = $flashMessages;
  }
}