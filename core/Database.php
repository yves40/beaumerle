<?php

namespace app\core;

class Database {

  public \PDO $pdo;

  //-----------------------------------------------------------------------------
  public function __construct(array $config) {

    $dsn = $config['dsn'] ?? '';
    $user = $config['user'] ?? '';
    $password = $config['password'] ?? '';
    $this->pdo = new \PDO($dsn, $user, $password);
    $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
  }
  //-----------------------------------------------------------------------------
  public function applyMigrations() {

    $newMigrations = [];

    $this->createMigrationsTable();
    $appliedMigrations = $this->getAppliedMigrations();
    $files = scandir(Application::$ROOT_DIR.'/migrations');
    $toApplyMigrations = array_diff($files, $appliedMigrations);

    foreach($toApplyMigrations as $migration) {
      if($migration === '.' || $migration === '..') {
        continue;
      }
      require_once Application::$ROOT_DIR.'/migrations/'.$migration;
      $classname = pathinfo($migration, PATHINFO_FILENAME);
      $instance = new $classname();
      $this->log("Applying migration $migration");
      $instance->up();
      $this->log("Applied $migration");
      $newMigrations[] = $migration;
    }

    if(!empty($newMigrations)) {
      $this->saveMigrations($newMigrations);
    }
    else {
      $this->log("All migrations are applied");
    }

  }
  //-----------------------------------------------------------------------------
  public function createMigrationsTable() {
    $this->pdo->exec("create table if not EXISTS migrations (
      id int AUTO_INCREMENT PRIMARY key,
      migration varchar(255),
      created_at timestamp default CURRENT_TIMESTAMP ) ENGINE=INNODB;");
  }
  //-----------------------------------------------------------------------------
  public function getAppliedMigrations() {
    $statement = $this->pdo->prepare("select migration from migrations");
    $statement->execute();
    return $statement->fetchAll(\PDO::FETCH_COLUMN);
  }
  //-----------------------------------------------------------------------------
  public function saveMigrations(array $migrations) {
    // The following compact instruction prepare the parameters for the INSERT statement
    // It adds parentheses and ',' so that mysql is happy
    $str = implode(',', array_map(fn($m) => "('$m')", $migrations ));
    $statement = $this->pdo->prepare("INSERT INTO migrations (migration) values $str ");
    $statement->execute();
  }
  //-----------------------------------------------------------------------------
  public function prepare($sql) {
    return $this->pdo->prepare($sql);
  }
  //-----------------------------------------------------------------------------
  public function log($message) {
    echo '['.date('Y-m-d H:i:s').'] '.$message.PHP_EOL;
  }
}