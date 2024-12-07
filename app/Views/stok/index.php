<?= $this->extend('layout/main'); ?>

<?= $this->section('judul'); ?>
Dashboard
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
Stok Buku
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>

<div class="table-responsive">
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addStockModal">
        <h5><i class="fa fa-plus"> Tambah</i></h5>
    </button>


    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Buku</th>
                <th>Jumlah Perubahan</th>
                <th>Tanggal Perubahan</th>
                <th>Alasan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stock_history as $index => $history): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $history['book_title'] ?></td> <!-- Tampilkan judul buku -->
                    <td><?= $history['change_amount'] ?></td>
                    <td><?= $history['change_date'] ?></td>
                    <td><?= $history['reason'] ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editStock(<?= $history['history_id'] ?>, '<?= $history['book_id'] ?>', <?= $history['change_amount'] ?>, '<?= $history['change_date'] ?>', '<?= $history['reason'] ?>')">Edit</button>
                        <form action="/stok/delete/<?= $history['history_id'] ?>" method="post" style="display:inline;">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah Stok -->
<div class="modal fade" id="addStockModal" tabindex="-1" role="dialog" aria-labelledby="addStockModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStockModalLabel">Tambah Stok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/stok/store" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="book_id">Judul Buku</label>
                        <select class="form-control" id="book_id" name="book_id" required>
                            <option value="">Pilih Buku</option>
                            <?php foreach ($books as $book): ?>
                                <option value="<?= $book['book_id'] ?>"><?= $book['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="change_amount">Jumlah Perubahan</label>
                        <input type="number" class="form-control" id="change_amount" name="change_amount" required>
                    </div>
                    <div class="form-group">
                        <label for="change_date">Tanggal Perubahan</label>
                        <input type="datetime-local" class="form-control" id="change_date" name="change_date" required>
                    </div>
                    <div class="form-group">
                        <label for="reason">Alasan</label>
                        <input type="text" class="form-control" id="reason" name="reason" required>
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

<!-- Modal Edit Stok -->
<div class="modal fade" id="editStockModal" tabindex="-1" role="dialog" aria-labelledby="editStockModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStockModalLabel">Edit Stok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/stok/update/') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="history_id" id="edit_history_id">
                    <div class="form-group">
                        <label for="edit_book_id">Judul Buku</label>
                        <select class="form-control" id="edit_book_id" name="book_id" required>
                            <option value="">Pilih Buku</option>
                            <?php foreach ($books as $book): ?>
                                <option value="<?= $book['book_id'] ?>"><?= $book['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_change_amount">Jumlah Perubahan</label>
                        <input type="number" class="form-control" id="edit_change_amount" name="change_amount" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_change_date">Tanggal Perubahan</label>
                        <input type="datetime-local" class="form-control" id="edit_change_date" name="change_date" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_reason">Alasan</label>
                        <input type="text" class="form-control" id="edit_reason" name="reason" required>
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

<script>
    function editStock(historyId, bookId, changeAmount, changeDate, reason) {
        // Set the values in the edit modal
        document.getElementById('edit_history_id').value = historyId;
        document.getElementById('edit_book_id').value = bookId;
        document.getElementById('edit_change_amount').value = changeAmount;
        document.getElementById('edit_change_date').value = changeDate;
        document.getElementById('edit_reason').value = reason;

        // Show the modal
        $('#editStockModal').modal('show');
    }
</script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<?= $this->endSection('isi'); ?>