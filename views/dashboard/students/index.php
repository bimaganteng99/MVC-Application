<h2>Daftar Siswa</h2>
<a href="?c=dashboard&m=createStudent">Tambah Data</a>
<table border="1" cellpadding="10">
  <tr>
    <th>No</th><th>Nama</th><th>NIM</th><th>Alamat</th><th>Aksi</th>
  </tr>
  <?php foreach ($students as $i => $student): ?>
    <tr>
      <td><?= $i + 1 ?></td>
      <td><?= htmlspecialchars($student['name']) ?></td>
      <td><?= htmlspecialchars($student['nim']) ?></td>
      <td><?= htmlspecialchars($student['address']) ?></td>
      <td>
        <a href="?c=dashboard&m=editStudent&id=<?= $student['id'] ?>">Edit</a> |
        <a href="?c=dashboard&m=deleteStudent&id=<?= $student['id'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

