<?= $this->extend('layout/main'); ?>

<?= $this->section('judul'); ?>
Visitor
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
Halaman Manajemen Pengunjung Perpustakaan
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>

<div class="table-responsive">
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addVisitorModal">
        <h5><i class="fa fa-plus"> Tambah</i></h5>
    </button>
    <a href="<?= base_url('/pengunjung/exportToPdf'); ?>" class="btn btn-danger btn-sm">
        <i class="fa fa-file-pdf"></i> Export ke PDF
    </a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No-Hp</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($visitors as $index => $visitor): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= $visitor['visitor_name']; ?></td>
                    <td><?= $visitor['visitor_email']; ?></td>
                    <td><?= $visitor['visitor_phone']; ?></td>
                    <td><?= $visitor['visitor_address']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editVisitorModal<?= $visitor['visitor_id']; ?>">Edit</button>
                        <a href="<?= base_url('/pengunjung/delete/' . $visitor['visitor_id']); ?>" class="btn btn-danger btn-sm">Hapus</a>
                        <a href="<?= base_url('/pengunjung/exportVisitorToPdf/' . $visitor['visitor_id']); ?>" class="btn btn-info btn-sm">Cetak PDF</a>
                    </td>
                </tr>

                <!-- Edit Visitor Modal -->
                <div class="modal fade" id="editVisitorModal<?= $visitor['visitor_id']; ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="<?= base_url('/pengunjung/update/' . $visitor['visitor_id']); ?>" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Pengunjung</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="visitor_name">Nama</label>
                                        <input type="text" class="form-control" id="visitor_name" name="visitor_name" value="<?= $visitor['visitor_name']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="visitor_email">Email</label>
                                        <input type="email" class="form-control" id="visitor_email" name="visitor_email" value="<?= $visitor['visitor_email']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="visitor_phone">No-Hp</label>
                                        <input type="text" class="form-control" id="visitor_phone" name="visitor_phone" value="<?= $visitor['visitor_phone']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="visitor_address">Alamat</label>
                                        <textarea class="form-control" id="visitor_address" name="visitor_address"><?= $visitor['visitor_address']; ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Add Visitor Modal -->
<div class="modal fade" id="addVisitorModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('/pengunjung/store'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengunjung</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="visitor_name">Nama</label>
                        <input type="text" class="form-control" id="visitor_name" name="visitor_name" required>
                    </div>
                    <div class="form-group">
                        <label for="visitor_email">Email</label>
                        <input type="email" class="form-control" id="visitor_email" name="visitor_email">
                    </div>
                    <div class="form-group">
                        <label for="visitor_phone">No-Hp</label>
                        <input type="text" class="form-control" id="visitor_phone" name="visitor_phone">
                    </div>
                    <div class="form-group">
                        <label for="visitor_address">Alamat</label>
                        <textarea class="form-control" id="visitor_address" name="visitor_address"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection('isi'); ?>