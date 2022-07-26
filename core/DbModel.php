<?php

namespace app\core;

use app\models\GenericModel;

abstract class DbModel extends GenericModel {

  // -------------------------------------------------------------------------
  abstract public static function tableName(): string;

  abstract public function attributes(): array;

  abstract public static function primaryKey(): string;

  // -------------------------------------------------------------------------
  public function save() {
    $tablename = $this->tableName();
    $attributes = $this->attributes();
    $params = array_map(fn($attr) => ":$attr", $attributes);
    $statement = self::prepare("INSERT INTO $tablename (".implode(',', $attributes).")
      VALUES (".implode(',', $params).")");
    foreach($attributes as $attribute) {
      $statement->bindValue(":$attribute", $this->{$attribute});
    }
    $statement->execute();
    return true;
  }
  // -------------------------------------------------------------------------
  public static function findOne($where) // [ email => 'y@free.fr, password => '12234' ]
  {
    $tablename = static::tableName();   // Calls a method of the calling class
    $attributes = array_keys($where);
    $criterias = implode("AND ", array_map( fn($attr) => "$attr = :$attr", $attributes));
    $statement = self::prepare("SELECT * FROM $tablename WHERE $criterias");
    foreach($where as $key => $item) {
      $statement->bindValue(":$key", $item);
    }
    $statement->execute();
    return $statement->fetchObject(static::class); // Return an object with the class of the calling class
  }
  // -------------------------------------------------------------------------
  public static function prepare($sql) 
  {
    return Application::$app->db->pdo->prepare($sql);
  }
}
?>