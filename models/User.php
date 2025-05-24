<?php
// untuk model autentikasi
// berkaitan dengan login, register
class User extends Model {
  public function getByName($name) {
    $sql = "SELECT * FROM users WHERE name = '$name'";
    $result = $this->dbconn->query($sql);
    return $result->fetch_object();
  }

  public function create($name, $password) {
    $name = $this->dbconn->real_escape_string($name);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $this->dbconn->prepare("INSERT INTO users (name, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $hashedPassword);
    return $stmt->execute();
  }
}