<?php
class Model {
  protected $dbconn;

  public function __construct() {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'mvc'; // pastikan nama DB kamu 'mvc', atau sesuaikan

    $this->dbconn = new mysqli($host, $user, $pass, $dbname, 3307);

    if ($this->dbconn->connect_error) {
      throw new Exception("Database connection failed: " . $this->dbconn->connect_error);
    }
  }
}
