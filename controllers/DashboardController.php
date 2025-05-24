<?php
// untuk dashboard (dashboard utama, profil, settings, dll)
// untuk CRUD data siswa
// berkaitan dengan views/dashboard/*.php
class DashboardController extends Controller {
  public function __construct() {
    session_start();
    if (!isset($_SESSION['user'])) {
      header("Location:?c=auth&m=login");
      exit();
    }
  }
  
  public function index() {
    $title = 'Dashboard';

    $this->loadView(
      "dashboard/index",
      [
        'title' => $title,
        'username' => $_SESSION['user']['name']
      ],
      'main'
    );
  }

  public function profile() {
    $title = 'Profil';
    $this->loadView("dashboard/profile", [
      'title' => $title,
      'username' => $_SESSION['user']['name']
    ], 'main');
  }

  public function getAllStudents() {
    $studentModel = $this->loadModel("student");
    $students = $studentModel->getAll();

    $this->loadView("dashboard/students/index", [
      'title' => 'Data Siswa',
      'students' => $students
    ], 'main');
  }


  public function createStudent() {
    $this->loadView("dashboard/students/create", [
      'title' => 'Tambah Siswa'
    ], 'main');
  }

  public function insertStudent() {
    $name = $_POST['name'] ?? '';
    $nim = $_POST['nim'] ?? '';
    $address = $_POST['address'] ?? '';

    $studentModel = $this->loadModel("student");
    $sukses = $studentModel->create($name, $nim, $address);

    if ($sukses) {
      header("Location:?c=dashboard&m=getAllStudents");
      exit();
    } else {
      $this->loadView("dashboard/students/create", [
        'title' => 'Tambah Siswa',
        'error' => 'Gagal menambah data. Cek NIM unik atau inputan.'
      ], 'main');
    }
  }


  public function editStudent() {
    $id = $_GET['id'] ?? null;
    if (!$id) {
      header("Location:?c=dashboard&m=getAllStudents");
      exit();
    }

    $studentModel = $this->loadModel("student");
    $student = $studentModel->getById($id);

    $this->loadView("dashboard/students/edit", [
      'title' => 'Edit Siswa',
      'student' => $student
    ], 'main');
  }

  public function updateStudent() {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $nim = $_POST['nim'] ?? '';
    $address = $_POST['address'] ?? '';

    $studentModel = $this->loadModel("student");
    $sukses = $studentModel->update($id, $name, $nim, $address);

    if ($sukses) {
      header("Location:?c=dashboard&m=getAllStudents");
      exit();
    } else {
      $student = ['id' => $id, 'name' => $name, 'nim' => $nim, 'address' => $address];
      $this->loadView("dashboard/students/edit", [
        'title' => 'Edit Siswa',
        'student' => $student,
        'error' => 'Gagal update data.'
      ], 'main');
    }
  }

  public function deleteStudent() {
    $id = $_GET['id'] ?? null;
    if ($id) {
      $studentModel = $this->loadModel("student");
      $studentModel->delete($id);
    }

    header("Location:?c=dashboard&m=getAllStudents");
    exit();
  }

}