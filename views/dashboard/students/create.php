<h2>Tambah Data Siswa</h2>
<?php if (isset($error)): ?>
  <div style="color:red"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form action="?c=dashboard&m=insertStudent" method="post">
  <label>Nama:</label><br>
  <input type="text" name="name" required><br><br>

  <label>NIM:</label><br>
  <input type="text" name="nim" required><br><br>

  <label>Alamat:</label><br>
  <textarea name="address"></textarea><br><br>

  <button type="submit">Simpan</button>
</form>
