<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengembalian Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <h2>Laporan Pengembalian Buku</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tanggal Pengembalian</th>
                <th>Denda</th>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>