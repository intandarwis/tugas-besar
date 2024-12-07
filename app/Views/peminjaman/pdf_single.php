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
    <h2>Detail Peminjaman Buku</h2>
    <table>
        <tr>
            <th>Nama Pengunjung</th>
            <td><?= $visitor_name; ?></td> <!-- Perbaikan di sini -->
        </tr>
        <tr>
            <th>Judul Buku</th>
            <td><?= $book_title; ?></td> <!-- Perbaikan di sini -->
        </tr>
        <tr>
            <th>Tanggal Peminjaman</th>
            <td><?= $loan['loan_date']; ?></td>
        </tr>
        <tr>
            <th>Jatuh Tempo</th>
            <td><?= $loan['due_date']; ?></td>
        </tr>
        <tr>
            <th>Status Pengembalian</th>
            <td><?= $loan['return_status']; ?></td>
        </tr>
    </table>
</body>

</html>