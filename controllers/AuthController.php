<?php
// untuk login, register, logout
// berkaitan dengan views/auth/*.php
// password saat register menggunakan password_hash
// password saat login menggunakan password_verify
class AuthController extends Controller {
  public function login() {
    session_start();
    if (isset($_SESSION['user'])) {
      header("Location:?c=dashboard&m=index");
      exit();
    }
    
    $this->loadView("auth/login", ['title' => 'Login'], "auth");
  }

  public function loginProcess() {
    session_start();

    $title = 'Login';

    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';

    $userModel = $this->loadModel("user");
    $user = $userModel->getByName($name);

    if ($user && password_verify($password, $user->password)) {
      $_SESSION['user'] = [
        'id' => $user->id,
        'name' => $user->name
      ];
      header("Location:?c=dashboard&m=index");
    } else {
      $this->loadView(
        "auth/login", 
        [
          'title' => $title,
          'error' => 'Login gagal, cek username/password'
        ],
        'auth'
      );
    }
  }

  public function register() {
    session_start();
    if (isset($_SESSION['user'])) {
      header("Location:?c=dashboard&m=index");
      exit();
    }

    $this->loadView("auth/register", ['title' => 'Register'], "auth");
  }

  public function registerProcess() {
    session_start();

    $title = 'Register';
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm) {
      return $this->loadView("auth/register", [
        'title' => $title,
        'error' => 'Konfirmasi password tidak cocok.'
      ], 'auth');
    }

    $userModel = $this->loadModel("user");

    if ($userModel->getByName($name)) {
      return $this->loadView("auth/register", [
        'title' => $title,
        'error' => 'Nama pengguna sudah digunakan.'
      ], 'auth');
    }

    $sukses = $userModel->create($name, $password);

    if ($sukses) {
      header("Location:?c=auth&m=login");
      exit();
    } else {
      return $this->loadView("auth/register", [
        'title' => $title,
        'error' => 'Gagal register. Coba lagi.'
      ], 'auth');
    }
  }


  public function logout() {
    session_start();
    session_destroy();
    header("Location:?c=auth&m=login");
    exit();
  }
}