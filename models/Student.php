<?php
// untuk data siswa
// berkaitan dengan CRUD siswa
class Student extends Model {
  private $lastErrorCode;

  public function getAll() {
    $result = $this->dbconn->query("SELECT * FROM students");
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getById($id) {
    $id = (int)$id;
    $result = $this->dbconn->query("SELECT * FROM students WHERE id = $id");
    return $result->fetch_assoc();
  }

  public function create($name, $nim, $address) {
    try {
      $stmt = $this->dbconn->prepare("INSERT INTO students (name, nim, address) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $name, $nim, $address);
      return $stmt->execute();
    } catch (mysqli_sql_exception $e) {
      $this->lastErrorCode = $e->getCode();
      return false;
    }
  }

  public function update($id, $name, $nim, $address) {
    try {
      $stmt = $this->dbconn->prepare("UPDATE students SET name=?, nim=?, address=? WHERE id=?");
      $stmt->bind_param("sssi", $name, $nim, $address, $id);
      return $stmt->execute();
    } catch (mysqli_sql_exception $e) {
      $this->lastErrorCode = $e->getCode();
      return false;
    }
  }

  public function delete($id) {
    $stmt = $this->dbconn->prepare("DELETE FROM students WHERE id=?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
  }

  public function getLastErrorCode() {
    return $this->lastErrorCode;
  }
}