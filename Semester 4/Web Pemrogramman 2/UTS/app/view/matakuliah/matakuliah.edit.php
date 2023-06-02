<?php include 'public/navbar.php'; ?>
<h2>Edit Matakuliah</h2>
    <form method="post" action="matakuliah/edit/<?= $matakuliah['id']; ?>">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $matakuliah['nama']; ?>" required>
        </div>
        <div class="form-group">
            <label for="kode">Kode Matakuliah:</label>
            <input type="text" class="form-control" id="kode" name="kode" value="<?= $matakuliah['kode_matakuliah']; ?>" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required><?= $matakuliah['deskripsi']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
<?php include 'public/footer.php'; ?>