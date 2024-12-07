<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengunjung</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Daftar Pengunjung Perpustakaan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No-Hp</th>
                <th>Alamat</th>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>