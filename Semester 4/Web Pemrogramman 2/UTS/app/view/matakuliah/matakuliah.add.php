<?php include 'public/navbar.php'; ?>
    <h2>Tambah Matakuliah</h2>
    <form method="post" action="matakuliah/create">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="kode">Kode Matakuliah:</label>
            <input type="text" class="form-control" id="kode" name="kode" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
<?php include 'public/footer.php'; ?>