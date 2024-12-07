<?= $this->extend('layout/main'); ?>

<?= $this->section('judul'); ?>
Dashboard
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
Dashboard
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<div class="row">
    <div class="col-md-6">
        <!-- AREA CHART -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Peminjaman Buku</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <div class="col-md-6">
        <!-- BAR CHART -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Pengembalian Buku</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-4" style="width: 100%;">
            <img src="<?= base_url() ?>/images/book.png" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">Pengelolaan data buku</h5>
                <p class="card-text">Digunakan untuk mencatat informasi buku termasuk judul, pengarang, penerbit, tahun terbit, stok, dan kategori.</p>
                <a href="/buku" class="btn btn-primary"><i class="fa fa-book"> Go</i></a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4" style="width: 100%;">
            <img src="<?= base_url() ?>/images/visitors.png" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">Pengelolaan Data Pengunjung</h5>
                <p class="card-text">Mencatat Data Pengunjung Perpustakaan</p>
                <a href="/pengunjung" class="btn btn-primary"><i class="fa fa-history"> Go</i></a>
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <div class="card mb-4" style="width: 100%;">
            <img src="<?= base_url() ?>/images/category.png" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">Pengelolaan kategori buku</h5>
                <p class="card-text">Memungkinkan untuk mengelola kategori buku seperti fiksi, non-fiksi, teknologi, dan lain-lain.</p>
                <a href="/kategori" class="btn btn-primary"><i class="fa fa-tags"> Go</i></a>
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <div class="card mb-4" style="width: 100%;">
            <img src="<?= base_url() ?>/images/loan.png" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">Laporan peminjaman buku</h5>
                <p class="card-text">Laporan mengenai semua peminjaman buku yang terjadi di perpustakaan.</p>
                <a href="/peminjaman" class="btn btn-primary"><i class="fa fa-list"> Go</i></a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4" style="width: 100%;">
            <img src="<?= base_url() ?>/images/return.png" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">Laporan pengembalian buku</h5>
                <p class="card-text">Laporan mengenai pengembalian buku oleh peminjam.</p>
                <a href="/pengembalian" class="btn btn-primary"><i class="fa fa-exchange"> Go</i></a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4" style="width: 100%;">
            <img src="<?= base_url() ?>/images/history.png" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">Riwayat perubahan stok</h5>
                <p class="card-text">Mencatat perubahan stok buku yang terjadi, baik itu penambahan maupun pengurangan stok.</p>
                <a href="/stok" class="btn btn-primary"><i class="fa fa-history"> Go</i></a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4" style="width: 100%;">
            <img src="<?= base_url() ?>/images/activity.png" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">Laporan aktivitas sistem</h5>
                <p class="card-text">Melacak seluruh aktivitas yang terjadi di sistem perpustakaan</p>
                <a href="/aktivitas" class="btn btn-primary"><i class="fa fa-bar-chart"> Go</i></a>
            </div>
        </div>
    </div>


</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var loanData = <?= json_encode(array_values($loanData)) ?>;
    var returnData = <?= json_encode(array_values($returnData)) ?>;
    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    // Area Chart untuk Peminjaman Buku
    var ctx = document.getElementById('areaChart').getContext('2d');
    var areaChart = new Chart(ctx, {
        type: 'line', // Tipe chart area biasanya menggunakan tipe 'line'
        data: {
            labels: months,
            datasets: [{
                label: 'Jumlah Peminjaman Buku',
                data: loanData,
                backgroundColor: 'rgba(60,141,188,0.7)', // Warna area
                borderColor: 'rgba(60,141,188,1)', // Warna garis
                fill: true // Mengisi area chart
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    display: true
                },
                y: {
                    display: true
                }
            }
        }
    });

    // Bar Chart untuk Pengembalian Buku
    var ctxBar = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctxBar, {
        type: 'bar', // Tipe chart batang
        data: {
            labels: months,
            datasets: [{
                label: 'Jumlah Pengembalian Buku',
                data: returnData,
                backgroundColor: 'rgba(0,123,255,0.7)', // Warna batang
                borderColor: 'rgba(0,123,255,1)', // Warna garis
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    display: true
                },
                y: {
                    beginAtZero: true,
                    display: true
                }
            }
        }
    });
</script>
<?= $this->endSection('isi'); ?>