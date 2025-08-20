<?php include 'public/navbar.php'; ?>
    <div class="container">
    <h2>Daftar Mahasiswa</h2>
    <a href="mahasiswa/create" class="btn btn-primary mb-3">Tambah Mahasiswa</a>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Program Studi</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($mahasiswaList as $mahasiswa) : ?>
            <tr>
                <td><?= $mahasiswa['id']; ?></td>
                <td><?= $mahasiswa['nama']; ?></td>
                <td><?= $mahasiswa['nim']; ?></td>
                <td><?= $mahasiswa['program_studi']; ?></td>
                <td>
                    <a href="mahasiswa/edit/<?= $mahasiswa['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="mahasiswa/delete/<?= $mahasiswa['id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php include 'public/footer.php'; ?>