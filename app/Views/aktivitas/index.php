<?= $this->extend('layout/main'); ?>
<?= $this->section('judul'); ?>
Aktivitas Sistem
<?= $this->endSection('judul'); ?>
<?= $this->section('subjudul'); ?>
Aktivitas Sistem
<?= $this->endSection('subjudul'); ?>
<?= $this->section('isi'); ?>

<h2>Ini Halaman Aktivitas Sistem</h2>

<!-- Tabel Aktivitas Log -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Jenis Aktivitas</th>
            <th>Tanggal Aktivitas</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($activityLogs) && is_array($activityLogs)) : ?>
            <?php foreach ($activityLogs as $index => $log) : ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= esc($log['activity_type']); ?></td>
                    <td><?= esc($log['activity_date']); ?></td>
                    <td><?= esc($log['details']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="4" class="text-center">Tidak ada aktivitas yang ditemukan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection('isi'); ?>