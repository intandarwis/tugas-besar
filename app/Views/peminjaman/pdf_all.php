<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <h2>Daftar Semua Peminjaman Buku</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Pengunjung</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Jatuh Tempo</th>
                <th>Status Pengembalian</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($loans as $loan): ?>
                <tr>
                    <td><?= $loan['visitor_name']; ?></td>
                    <td><?= $loan['title']; ?></td>
                    <td><?= $loan['loan_date']; ?></td>
                    <td><?= $loan['due_date']; ?></td>
                    <td><?= $loan['return_status']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>