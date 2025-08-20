<?php include 'public/navbar.php'; ?>
<h2>Edit Dosen</h2>
    <form method="post" action="dosen/edit/<?= $dosen['id']; ?>">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $dosen['nama']; ?>" required>
        </div>
        <div class="form-group">
            <label for="nidn">NIDN:</label>
            <input type="text" class="form-control" id="nidn" name="nidn" value="<?= $dosen['nidn']; ?>" required>
        </div>
        <div class="form-group">
            <label for="jenjang">Jenjang Pendidikan:</label>
            <input type="text" class="form-control" id="jenjang" name="jenjang" value="<?= $dosen['jenjang_pendidikan']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
<?php include 'public/footer.php'; ?>