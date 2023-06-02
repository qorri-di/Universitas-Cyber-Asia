<?php include 'public/navbar.php'; ?>
<h2>Daftar Matakuliah</h2>
    <a href="matakuliah/create" class="btn btn-primary mb-3">Tambah Matakuliah</a>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kode Matakuliah</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($matakuliahList as $matakuliah) : ?>
            <tr>
                <td><?= $matakuliah['id']; ?></td>
                <td><?= $matakuliah['nama']; ?></td>
                <td><?= $matakuliah['kode_matakuliah']; ?></td>
                <td><?= $matakuliah['deskripsi']; ?></td>
                <td>
                    <a href="matakuliah/edit/<?= $matakuliah['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="matakuliah/delete/<?= $matakuliah['id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php include 'public/footer.php'; ?>