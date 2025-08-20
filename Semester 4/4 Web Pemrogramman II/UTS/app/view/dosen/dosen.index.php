<?php include 'public/navbar.php'; ?>
<h2>Daftar Dosen</h2>
    <a href="dosen/create" class="btn btn-primary mb-3">Tambah Dosen</a>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIDN</th>
            <th>Jenjang Pendidikan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dosenList as $dosen) : ?>
            <tr>
                <td><?= $dosen['id']; ?></td>
                <td><?= $dosen['nama']; ?></td>
                <td><?= $dosen['nidn']; ?></td>
                <td><?= $dosen['jenjang_pendidikan']; ?></td>
                <td>
                    <a href="dosen/edit/<?= $dosen['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="dosen/delete/<?= $dosen['id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php include 'public/footer.php'; ?>
