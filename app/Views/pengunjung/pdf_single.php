<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengunjung</title>
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
    <h2>Detail Pengunjung</h2>
    <table>
        <tr>
            <th>Nama</th>
            <td><?= $visitor['visitor_name']; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $visitor['visitor_email']; ?></td>
        </tr>
        <tr>
            <th>No-Hp</th>
            <td><?= $visitor['visitor_phone']; ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?= $visitor['visitor_address']; ?></td>
        </tr>
    </table>
</body>

</html>