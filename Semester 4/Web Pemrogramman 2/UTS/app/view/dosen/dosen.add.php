<?php include 'public/navbar.php'; ?>
    <h2>Tambah Dosen</h2>
    <form method="post" action="dosen/create">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="nidn">NIDN:</label>
            <input type="text" class="form-control" id="nidn" name="nidn" required>
        </div>
        <div class="form-group">
            <label for="jenjang">Jenjang Pendidikan:</label>
            <input type="text" class="form-control" id="jenjang" name="jenjang" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
<?php include 'public/footer.php'; ?>