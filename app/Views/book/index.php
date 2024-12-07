<?= $this->extend('layout/main'); ?>

<?= $this->section('judul'); ?>
Dashboard
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
Pengelolaan Data Buku
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addBookModal">
            <h5><i class="fa fa-plus"> Tambah</i></h5>
        </button>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $key => $book): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $book['title'] ?></td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['publisher'] ?></td>
                    <td><?= $book['year_published'] ?></td>
                    <td><?= $book['category_name'] ?></td>
                    <td><?= $book['stock'] ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editBookModal<?= $book['book_id'] ?>">Edit</button>
                        <form action="/buku/delete/<?= $book['book_id'] ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit Buku -->
                <div class="modal fade" id="editBookModal<?= $book['book_id'] ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Buku</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <form action="/buku/update/<?= $book['book_id'] ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="title">Judul Buku</label>
                                        <input type="text" name="title" value="<?= $book['title'] ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Pengarang</label>
                                        <input type="text" name="author" value="<?= $book['author'] ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="publisher">Penerbit</label>
                                        <input type="text" name="publisher" value="<?= $book['publisher'] ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="year_published">Tahun Terbit</label>
                                        <input type="number" name="year_published" value="<?= $book['year_published'] ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id">Kategori</label>
                                        <select name="category_id" class="form-control" required>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= $category['category_id'] ?>" <?= ($category['category_id'] == $book['category_id']) ? 'selected' : '' ?>><?= $category['category_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Stok</label>
                                        <input type="number" name="stock" value="<?= $book['stock'] ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah Buku -->
<div class="modal fade" id="addBookModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="/buku/store" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Judul Buku</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Pengarang</label>
                        <input type="text" name="author" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="publisher">Penerbit</label>
                        <input type="text" name="publisher" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="year_published">Tahun Terbit</label>
                        <input type="number" name="year_published" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input type="number" name="stock" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection('isi'); ?>