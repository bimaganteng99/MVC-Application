<h2>Edit Data Siswa</h2>
<?php if (isset($error)): ?>
  <div style="color:red"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form action="?c=dashboard&m=updateStudent" method="post">
  <input type="hidden" name="id" value="<?= htmlspecialchars($student['id']) ?>">
  
  <label>Nama:</label><br>
  <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" required><br><br>

  <label>NIM:</label><br>
  <input type="text" name="nim" value="<?= htmlspecialchars($student['nim']) ?>" required><br><br>

  <label>Alamat:</label><br>
  <textarea name="address"><?= htmlspecialchars($student['address']) ?></textarea><br><br>

  <button type="submit">Update</button>
</form>
