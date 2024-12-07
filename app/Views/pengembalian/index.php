<?= $this->extend('layout/main'); ?>

<?= $this->section('judul'); ?>
Dashboard
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
Laporan Pengembalian Buku
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<div class="table-responsive">
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addReturnModal">
        <h5><i class="fa fa-plus"></i> Tambah</h5>
    </button>
    <button class="btn btn-danger btn-sm" onclick="window.location.href='<?= base_url('/pengembalian/exportToPdf'); ?>'">
        <h5><i class="fa fa-file-pdf"></i> Cetak</h5>
    </button>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tanggal Pengembalian</th>
                <th>Denda</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($returns as $return): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $return['visitor_name']; ?></td>
                    <td><?= $return['title']; ?></td>
                    <td><?= $return['return_date']; ?></td>
                    <td><?= $return['fine']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editReturnModal<?= $return['return_id']; ?>">Edit</button>
                        <form action="<?= base_url('/pengembalian/delete/' . $return['return_id']); ?>" method="post" style="display:inline;">
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editReturnModal<?= $return['return_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editReturnModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="<?= base_url('/pengembalian/update/' . $return['return_id']); ?>" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editReturnModalLabel">Edit Pengembalian Buku</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="loan_id">Pilih Peminjam</label>
                                        <select name="loan_id" id="loan_id" class="form-control" required>
                                            <?php foreach ($loans as $loan): ?>
                                                <option value="<?= $loan['loan_id']; ?>" <?= ($loan['loan_id'] == $return['loan_id']) ? 'selected' : ''; ?>><?= $loan['visitor_name']; ?> - <?= $loan['title']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="return_date">Tanggal Pengembalian</label>
                                        <input type="date" name="return_date" id="return_date" class="form-control" value="<?= $return['return_date']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fine">Keterlambatan</label>
                                        <input type="text" name="fine" id="fine" class="form-control" value="<?= $return['fine']; ?>" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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

<!-- Modal Tambah -->
<div class="modal fade" id="addReturnModal" tabindex="-1" role="dialog" aria-labelledby="addReturnModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('/pengembalian/store'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReturnModalLabel">Tambah Pengembalian Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="loan_id">Pilih Peminjam</label>
                        <select name="loan_id" id="loan_id" class="form-control" required>
                            <?php foreach ($loans as $loan): ?>
                                <option value="<?= $loan['loan_id']; ?>"><?= $loan['visitor_name']; ?> - <?= $loan['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="return_date">Tanggal Pengembalian</label>
                        <input type="date" name="return_date" id="return_date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection('isi'); ?>