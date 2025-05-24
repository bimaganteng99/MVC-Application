<h2><?= $title ?></h2>
<?php if (isset($error)): ?>
  <div style="color:red"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form action="?c=auth&m=registerProcess" method="post">
    <label>Username:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Konfirmasi Password:</label><br>
    <input type="password" name="confirm_password" required><br><br>

    <button type="submit">Daftar</button>
</form>

<p>Sudah punya akun? <a href="?c=auth&m=login">Login di sini</a></p>
