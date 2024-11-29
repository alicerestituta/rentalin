<?php 
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".$filename.".xls");
header("Pragma: no-cache");
header("Expires: 0");  ?>

<h1>Data Laporan Pengembalian</h1>

<h4>Tanggal : <?= date('Y-m-d H:i:s'); ?> </h4>

<table border="1">
    <thead>
        <tr>
            <th>Nomor Transaksi</th>
            <th>Penyewa</th>
            <th>Merk</th>
            <th>Model</th>
            <th>Tanggal Sewa</th>
            <th>Tanggal Selesai</th>
            <th>Tanggal Kembali</th>
            <th>Total Bayar</th>
            <th>Denda</th>
            <th>Total Bayar Akhir</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data)):?>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= $row['no_transaksi']; ?></td>
                    <td><?= $row['penyewa']; ?></td>
                    <td><?= $row['merk']; ?></td>
                    <td><?= $row['model']; ?></td>
                    <td><?= $row['tgl_sewa']; ?></td>
                    <td><?= $row['tgl_kembali']; ?></td>
                    <td><?= $row['tgl_selesai']; ?></td>
                    <td><?= $row['total_bayar']; ?></td>
                    <td><?= $row['denda']; ?></td>
                    <td><?= $row['total_bayar_akhir']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Tidak ada data yang tersedia</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>