<?php include 'public/navbar.php'; ?>
<h2>Tambah Mahasiswa</h2>
<form method="post" action="mahasiswa/create">
    <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="form-group">
        <label for="nim">NIM:</label>
        <input type="text" class="form-control" id="nim" name="nim" required>
    </div>
    <div class="form-group">
        <label for="program_studi">Program Studi:</label>
        <input type="text" class="form-control" id="program_studi" name="program_studi" required>
    </div>
    <button type="submit" class="btn btn-primary">Tambah</button>
</form>
<?php include 'public/footer.php'; ?>
