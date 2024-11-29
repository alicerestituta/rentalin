<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 class="app-page-title">Dashboard</h1>

            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">
                        <?php
                        date_default_timezone_set('Asia/Jakarta');
                        $jam = date('H');

                        if ($jam >= 5 && $jam < 11) {
                            $greeting = 'Selamat pagi!';
                        } elseif ($jam >= 11 && $jam < 15) {
                            $greeting = 'Selamat siang!';
                        } elseif ($jam >= 15 && $jam < 18) {
                            $greeting = 'Selamat sore!';
                        } else {
                            $greeting = 'Selamat malam!';
                        }
                        ?>
                        <h3 class="mb-3"><?php echo $greeting; ?></h3>
                        <div class="row gx-5 gy-3">
                            <div class="col-12 col-lg-9">
                                <div>
                                    Dashboard admin sewa mobil ini adalah pusat kendali untuk mengelola semua aktivitas
                                    sewa-menyewa</div>
                            </div><!--//col-->

                        </div><!--//row-->
                    </div><!--//app-card-body-->
                </div><!--//inner-->
            </div><!--//app-card-->

            <div class="row g-4 mb-4">
                <div class="col-6 col-lg-4">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Sewa Berlangsung</h4>
                            <div class="stats-figure">
                                <?php echo $sewa_berlangsung; ?> <!-- Menampilkan jumlah sewa berlangsung -->
                            </div>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//col-->

                <div class="col-6 col-lg-4">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Sewa Selesai</h4>
                            <div class="stats-figure">
                                <?php echo $sewa_selesai; ?> <!-- Menampilkan jumlah sewa berlangsung -->
                            </div>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//col-->
                <div class="col-6 col-lg-4">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1"> Sewa Total</h4>
                            <div class="stats-figure">
                                <?php echo $sewa; ?> <!-- Menampilkan jumlah sewa berlangsung -->
                            </div>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//container-fluid-->

        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade active show" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-10"
                    style="width: 100%; max-width: 1200px; padding: 20px; margin: 0 auto;">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left" id="table">
                                <thead>
                                    <tr>
                                        <th class="cell">Nomor</th>
                                        <th class="cell">Nomor Transaksi</th>
                                        <th class="cell">Penyewa</th>
                                        <!-- <th class="cell">Email</th> -->
                                        <th class="cell">Merk</th>
                                        <th class="cell">Model</th>
                                        <th class="cell">Tanggal Sewa</th>
                                        <th class="cell">Tanggal Selesai</th>
                                        <th class="cell">Total Bayar</th>
                                        <th class="cell">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($penyewa)): ?>
                                        <?php $no = 1; ?>
                                        <?php foreach ($penyewa as $p): ?>
                                            <?php if ($p->status == 1): ?>
                                                <tr>
                                                    <td class="cell"><?php echo $no++; ?></td>
                                                    <td class="cell"><?php echo $p->no_transaksi; ?></td>
                                                    <td class="cell"><?php echo $p->penyewa; ?></td>
                                                    <!-- <td class="cell"><?php echo $p->email; ?></td> -->
                                                    <td class="cell"><?php echo $p->merk; ?></td>
                                                    <td class="cell"><?php echo $p->model; ?></td>
                                                    <td class="cell"><?php echo $p->tgl_sewa; ?></td>
                                                    <td class="cell"><?php echo $p->tgl_kembali; ?></td>
                                                    <td class="cell"><?php echo 'Rp ' . number_format($p->total_bayar, 0, ',', '.'); ?></td>
                                                    <td class="cell">
                                                        <span class="badge <?php echo $p->status == 1 ? 'badge-success' : 'badge-warning'; ?>"
                                                            data-id="<?php echo $p->sewa_id; ?>"
                                                            data-status="<?php echo $p->status; ?>"
                                                            onclick="changeStatus(this)">
                                                            <?php echo $p->status == 1 ? 'Berlangsung' : 'Selesai'; ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" class="cell">Tidak ada data ditemukan</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </div><!--//table-responsive-->
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//tab-pane-->
        </div>
    </div><!--//app-content-->
</div><!--//app-wrapper-->

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            "paging": true, // Aktifkan pagination
            "searching": true, // Aktifkan pencarian
            "ordering": true, // Aktifkan pengurutan kolom
            "info": true, // Menampilkan info total data
            "lengthChange": false, // Menonaktifkan perubahan jumlah baris per halaman
            "language": {
                "sEmptyTable": "Tidak ada data tersedia",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri total)",
                "sLengthMenu": "Tampilkan _MENU_ entri",
                "sSearch": "Cari:",
                "oPaginate": {
                    "sNext": "Selanjutnya",
                    "sPrevious": "Sebelumnya"
                }
            }
        });
    });

    function changeStatus(element) {
        var sewaId = $(element).data('id');
        var currentStatus = $(element).data('status');
        var newStatus = currentStatus === 0 ? 1 : 0;

        Swal.fire({
            title: 'Konfirmasi',
            text: currentStatus === 1 ? 'Apakah Anda yakin ingin menyelesaikan sewa?' : 'Apakah Anda yakin ingin mengembalikan sewa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url("admin/ubah_status"); ?>',
                    type: 'POST',
                    data: {
                        sewa_id: sewaId,
                        status: newStatus
                    },
                    success: function(response) {
                        if (response.success) {
                            $(element).data('status', newStatus);
                            $(element).removeClass(currentStatus === 0 ? 'badge-success' : 'badge-warning');
                            $(element).addClass(newStatus === 0 ? 'badge-success' : 'badge-warning');
                            $(element).text(newStatus === 0 ? 'Berlangsung' : 'Selesai');
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal mengubah status.',
                                icon: 'error'
                            });
                        } else {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Berhasil memperbarui status',
                                icon: 'success'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                });
            }
        });
    }
</script>