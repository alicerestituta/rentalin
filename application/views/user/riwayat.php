<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

    <title>User - Sewa Kapanpun Di Manapun</title>
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/app-logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        var base_url = "<?php echo base_url(); ?>";
    </script>
    <style>
        .btn-spacing {
            margin-left: 10px;
        }

        #btn_signup {
            background-color: #51B37F;
            color: white;
            border: none;
        }

        #btn_signup:disabled {
            background-color: #7BD19B;
            color: white;
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
</head>

<body class="container bg-light">
    <!-- Start Header form -->
    <div class="text-center pt-5">
        <img src="<?php echo base_url(); ?>assets/images/app-logo.svg" width="72" height="72" />
        <h2 style="margin-top: 20px;">Riwayat Sewa</h2>
        <p>Ini adalah riwayat sewamu</p>
    </div>
    <!-- End Header form -->

    <div class="tab-content" id="orders-table-tab-content">
        <div class="tab-pane fade active show" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">

            <div class="app-card app-card-orders-table shadow-sm mb-10" style="width: 100%; max-width: 1200px; padding: 20px; margin: 0 auto;">
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left" id="table">
                            <thead>
                                <tr>
                                    <th class="cell">Nomor</th>
                                    <th class="cell">Nomor Transaksi</th>
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
                                    <?php $no = 1;
                                    foreach ($penyewa as $p): ?>
                                        <tr>
                                            <td class="cell"><?php echo $no++; ?></td>
                                            <td class="cell"><?php echo $p->no_transaksi; ?></td>
                                            <td class="cell"><?php echo $p->merk; ?></td>
                                            <td class="cell"><?php echo $p->model; ?></td>
                                            <td class="cell"><?php echo $p->tgl_sewa; ?></td>
                                            <td class="cell"><?php echo $p->tgl_kembali; ?></td>
                                            <td class="cell"><?php echo 'Rp ' . number_format($p->total_bayar_akhir, 0, ',', '.'); ?></td>
                                            <td class="cell">
                                                <span class="badge <?php echo $p->status == 1 ? 'badge-success' : 'badge-warning'; ?>"
                                                    data-id="<?php echo $p->sewa_id; ?>"
                                                    data-status="<?php echo $p->status; ?>"
                                                    onclick="changeStatus(this)">
                                                    <?php echo $p->status == 1 ? 'Berlangsung' : 'Selesai'; ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="cell">Tidak ada data ditemukan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <a type="button" class="btn btn-danger ms-1" href="<?php echo base_url('user/dashboard'); ?>">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Kembali</span>
                </a>
            </div>
        </div>
    </div>


</body>
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            "paging": true, 
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
</script>