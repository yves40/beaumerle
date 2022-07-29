<?php

namespace app\models;
use app\core\Application;

abstract class GenericModel {

  public const RULE_REQUIRED = 'required';
  public const RULE_EMAIL = 'email';
  public const RULE_MIN = 'min';
  public const RULE_MAX = 'max';
  public const RULE_MATCH = 'match';
  public const RULE_UNIQUE = 'unique';

  public array $errors = [];

  // -----------------------------------------------------------------------
  public function loadData($data) {

    foreach( $data as $key => $value) {
      if(property_exists($this, $key)) {
        $this->{$key} = $value;
      }
    }
  }

  // -----------------------------------------------------------------------
  abstract public function rules() : array;
  // -----------------------------------------------------------------------
  public function labels() : array {
    return [];
   }
  // -----------------------------------------------------------------------
  public function getLabel($attribute) {
    return $this->labels()[$attribute] ?? $attribute;
  }
  // --------------------------------------------------------------------
  public function validate() {
    foreach( $this->rules() as $attribute => $rules ) {
      $value = $this->$attribute;
      foreach($rules as $rule) {
        $rulename = $rule;
        if(!is_string($rulename)) {   // Is the rule an array ? 
          $rulename = $rule[0];
        }
        if($rulename === self::RULE_REQUIRED && !$value) {
          $this->addErrorForRule($attribute, self::RULE_REQUIRED);
        }
        if($rulename === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $this->addErrorForRule($attribute, self::RULE_EMAIL);
        }
        if($rulename === self::RULE_MIN && strlen($value) < $rule['min'] ) {
          $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
        }
        if($rulename === self::RULE_MAX && strlen($value) > $rule['max'] ) {
          $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
        }
        if($rulename === self::RULE_MATCH && $value !== $this->{$rule['match']} ) {
          $rule['match'] = $this->getLabel($rule['match']);
          $this->addErrorForRule($attribute, self::RULE_MATCH, $rule);
        }
        // Check specified email is unique
        if($rulename === self::RULE_UNIQUE ) {
          $classname = $rule['class'];
          $uniqueAttribute = $rule['attribute'] ?? $attribute;
          $tablename = $classname::tableName();
          $statement = Application::$app->db->prepare("SELECT * FROM $tablename WHERE $uniqueAttribute = :attr");
          $statement->bindValue(":attr", $value);
          $statement->execute();
          $record = $statement->fetchObject();
          if ($record) {
            $this->addErrorForRule($attribute, self::RULE_UNIQUE, ['field' => $this->getLabel($attribute)]);
          }
        }
      }
    }
    return empty($this->errors);    // True if no errors : array is empty
  }
  // -----------------------------------------------------------------------
  public function addError(string $attribute, string $message) {
    $this->errors[$attribute][] = $message;
  }
  // -----------------------------------------------------------------------
  private function addErrorForRule(string $attribute, string $rule, $params = []) {
    $message = $this->errorMessages()[$rule] ?? '';
    foreach($params as $key => $value) {
      $message = str_replace("{{$key}}", $value, $message);
    }
    $this->errors[$attribute][] = $message;
  }
  // -----------------------------------------------------------------------
  public function errorMessages() {
    return [
      self::RULE_REQUIRED  => 'This field is required',
      self::RULE_EMAIL  => 'This field must be a valid email',
      self::RULE_MIN  => 'Min length for this field must be {min}',
      self::RULE_MAX  => 'Max length for this field must be {max}',
      self::RULE_MATCH  => 'This field must be the same as {match}',  
      self::RULE_UNIQUE => 'Record with {field} already exists'    
    ];
  }
  // -----------------------------------------------------------------------
  public function hasError($attribute) {
    //Application::$app->trace($attribute);
    return $this->errors[$attribute] ?? false;
  }
  // -----------------------------------------------------------------------
  public function getFirstError($attribute) {
    if (isset($this->errors["$attribute"][0])) {
      //Application::$app->console("Check " . $attribute . " rule ");
      return $this->errors["$attribute"][0];
    }
  }}

?>