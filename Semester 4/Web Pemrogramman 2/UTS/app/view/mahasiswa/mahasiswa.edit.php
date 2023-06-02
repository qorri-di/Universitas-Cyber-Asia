<?php include 'public/navbar.php'; ?>
<h2>Edit Mahasiswa</h2>
<form method="post" action="mahasiswa/edit/<?= $mahasiswa['id']; ?>">
    <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= $mahasiswa['nama']; ?>" required>
    </div>
    <div class="form-group">
        <label for="nim">NIM:</label>
        <input type="text" class="form-control" id="nim" name="nim" value="<?= $mahasiswa['nim']; ?>" required>
    </div>
    <div class="form-group">
        <label for="program_studi">Program Studi:</label>
        <input type="text" class="form-control" id="program_studi" name="program_studi" value="<?= $mahasiswa['program_studi']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
<?php include 'public/footer.php'; ?>
