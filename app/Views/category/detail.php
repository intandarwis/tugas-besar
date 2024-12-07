<?= $this->extend('layout/main'); ?>

<?= $this->section('judul'); ?>
Detail Buku di Kategori: <?= $category['category_name']; ?>
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
Daftar Buku
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($books) > 0): ?>
                <?php foreach ($books as $key => $book): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $book['title'] ?></td>
                        <td><?= $book['author'] ?></td>
                        <td><?= $book['publisher'] ?></td>
                        <td><?= $book['year_published'] ?></td>
                        <td><?= $book['stock'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada buku dalam kategori ini</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<a href="/kategori" class="btn btn-secondary">Kembali</a>

<?= $this->endSection('isi'); ?>