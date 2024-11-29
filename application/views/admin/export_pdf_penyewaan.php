<!DOCTYPE html>
<html>
<head>
    <title>Data Laporan Penyewaan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Data Laporan Penyewaan</h1>
    <table>
        <thead>
            <tr>
                <th>Nomor Transaksi</th>
                <th>Penyewa</th>
                <th>Merk</th>
                <th>Model</th>
                <th>Tanggal Sewa</th>
                <th>Tanggal Kembali</th>
                <th>Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
            <tr>
                <td><?php echo $row['no_transaksi']; ?></td>
                <td><?php echo $row['penyewa']; ?></td>
                <td><?php echo $row['merk']; ?></td>
                <td><?php echo $row['model']; ?></td>
                <td><?php echo $row['tgl_sewa']; ?></td>
                <td><?php echo $row['tgl_kembali']; ?></td>
                <td><?php echo $row['total_bayar']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
