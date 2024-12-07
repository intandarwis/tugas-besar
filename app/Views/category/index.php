<?= $this->extend('layout/main'); ?>

<?= $this->section('judul'); ?>
Dashboard
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
Pengelolaan Kategori Buku
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCategoryModal">
            <h5><i class="fa fa-plus"> Tambah</i></h5>
        </button>
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Detail Buku Tercantum</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $key => $category): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $category['category_name'] ?></td>
                    <td>
                        <a href="/kategori/detail/<?= $category['category_id'] ?>" class="btn btn-info btn-sm">Detail</a>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCategoryModal<?= $category['category_id'] ?>">Edit</button>
                        <form action="/kategori/delete/<?= $category['category_id'] ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit Kategori -->
                <div class="modal fade" id="editCategoryModal<?= $category['category_id'] ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Kategori</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <form action="/kategori/update/<?= $category['category_id'] ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="category_name">Nama Kategori</label>
                                        <input type="text" name="category_name" value="<?= $category['category_name'] ?>" class="form-control" required>
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

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="/kategori/store" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_name">Nama Kategori</label>
                        <input type="text" name="category_name" class="form-control" required>
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