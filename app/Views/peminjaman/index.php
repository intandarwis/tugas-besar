<?= $this->extend('layout/main'); ?>

<?= $this->section('judul'); ?>
Dashboard
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
Laporan Peminjaman Buku
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>

<div class="table-responsive">
    <!-- Button trigger modal for Add -->

    <div>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addLoanModal">
            <h5><i class="fa fa-plus"></i> Tambah</h5>
        </button>

        <a href="<?= base_url('/loan/exportAllLoansToPdf'); ?>" class="btn btn-danger btn-sm">
            <h5><i class="fa fa-file-pdf"> Cetak</i></h5>
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Jatuh Tempo Pengembalian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($loans as $index => $loan): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= $loan['visitor_name']; ?></td> <!-- Menampilkan nama pengunjung -->
                    <td><?= $loan['title']; ?></td> <!-- Menampilkan judul buku -->
                    <td><?= $loan['loan_date']; ?></td>
                    <td><?= $loan['due_date']; ?></td>
                    <td><?= $loan['return_status']; ?></td>
                    <td>
                        <a href="<?= base_url('/loan/exportLoanToPdf/' . $loan['loan_id']); ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"> Cetak PDF</i></a>
                        <button class="btn btn-warning btn-sm edit-loan" data-id="<?= $loan['loan_id']; ?>" data-toggle="modal" data-target="#editLoanModal">Edit</button>
                        <form action="/loan/delete/<?= $loan['loan_id']; ?>" method="post" style="display:inline;">
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="addLoanModal" tabindex="-1" role="dialog" aria-labelledby="addLoanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/loan/add" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLoanModalLabel">Tambah Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="book_id">Buku</label>
                        <select name="book_id" id="book_id" class="form-control" required>
                            <?php foreach ($books as $book): ?>
                                <option value="<?= $book['book_id']; ?>"><?= $book['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="visitor_id">Peminjam</label>
                        <select name="visitor_id" id="visitor_id" class="form-control" required>
                            <?php foreach ($visitors as $visitor): ?>
                                <option value="<?= $visitor['visitor_id']; ?>"><?= $visitor['visitor_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="loan_date">Tanggal Peminjaman</label>
                        <input type="date" class="form-control" name="loan_date" id="loan_date" required>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Tanggal Jatuh Tempo</label>
                        <input type="date" class="form-control" name="due_date" id="due_date" required>
                    </div>
                    <div class="form-group">
                        <label for="return_status">Status Pengembalian</label>
                        <select class="form-control" name="return_status" id="return_status" required>
                            <option value="Pinjam">Pinjam</option>
                            <option value="Kembali">Kembali</option>
                        </select>
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

<!-- Modal Edit -->
<div class="modal fade" id="editLoanModal" tabindex="-1" role="dialog" aria-labelledby="editLoanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/loan/update" method="post"> <!-- Perbaikan di sini -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editLoanModalLabel">Edit Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="loan_id" id="edit_loan_id">
                    <div class="form-group">
                        <label for="edit_book_id">Buku</label>
                        <select name="book_id" id="edit_book_id" class="form-control" required>
                            <?php foreach ($books as $book): ?>
                                <option value="<?= $book['book_id']; ?>"><?= $book['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_visitor_id">Peminjam</label>
                        <select name="visitor_id" id="edit_visitor_id" class="form-control" required>
                            <?php foreach ($visitors as $visitor): ?>
                                <option value="<?= $visitor['visitor_id']; ?>"><?= $visitor['visitor_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_loan_date">Tanggal Peminjaman</label>
                        <input type="date" class="form-control" name="loan_date" id="edit_loan_date" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_due_date">Tanggal Jatuh Tempo</label>
                        <input type="date" class="form-control" name="due_date" id="edit_due_date" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_return_status">Status Pengembalian</label>
                        <select class="form-control" name="return_status" id="edit_return_status" required>
                            <option value="Pinjam">Pinjam</option>
                            <option value="Kembali">Kembali</option>
                        </select>
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

<script>
    // Script untuk mengisi modal edit
    $(document).on('click', '.edit-loan', function() {
        var loanId = $(this).data('id');
        $.ajax({
            url: '/loan/edit/' + loanId,
            method: 'GET',
            success: function(data) {
                $('#edit_loan_id').val(data.loan_id);
                $('#edit_book_id').val(data.book_id);
                $('#edit_visitor_id').val(data.visitor_id);
                $('#edit_loan_date').val(data.loan_date);
                $('#edit_due_date').val(data.due_date);
                $('#edit_return_status').val(data.return_status);
            }
        });
    });
</script>

<?= $this->endSection('isi'); ?>