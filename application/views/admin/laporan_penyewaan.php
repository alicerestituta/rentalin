<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title">Manajemen Laporan Penyewaan</h1>
                </div>
            </div>

            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade active show" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-10" style="width: 100%; max-width: 1200px; padding: 20px; margin: 0 auto;">
                        <div class="app-card-body">

                            <!-- <div class="row mb-4">
                                <form method="get" action="">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="start-date">Tanggal Awal :</label>
                                                <input type="date" class="form-control" id="start-date" name="tglawal">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="end-date">Tanggal Akhir :</label>
                                                <input type="date" class="form-control" id="end-date" name="tglakhir">
                                            </div>
                                        </div>

                                        <div class="col-md-2 d-flex align-items-end mb-3">
                                            <button class="btn" type="submit" style="background: #51B37F; color: #fff; width: 80%; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>

                                        <div class="col-md-2 d-flex align-items-end mb-3">
                                            <button class="btn btn-secondary" type="button" style="color: #fff; width: 80%; height: 40px; display: flex; align-items: center; justify-content: center;" onclick="window.location.href='<?php echo base_url('admin/laporan_penyewaan'); ?>';">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <a class="btn btn-success" href="<?php echo base_url('laporan_penyewaan/exportExcel'); ?>"><i class="fas fa-file-excel"></i> Export Excel</a>
                                        <a class="btn btn-warning" href="<?php echo base_url('laporan_penyewaan/exportPDF'); ?>" style="color: #fff;">
                                            <i class="fa-solid fa-print" style="margin-right: 5px;"></i> Export Pdf
                                        </a>
                                    </div>
                                </div>
                            </div> -->

                            <div class="row mb-4">
                                <form method="get" action="">
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="start-date">Tanggal Awal :</label>
                                                <input type="date" class="form-control" id="start-date" name="tglawal" >
                                            </div>
                                        </div>

                                       
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="end-date">Tanggal Akhir :</label>
                                                <input type="date" class="form-control" id="end-date" name="tglakhir" >
                                            </div>
                                        </div>

                                       
                                        <div class="col-md-2 d-flex align-items-end mb-3">
                                            <button class="btn" type="submit" style="background: #51B37F; color: #fff; width: 80%; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>

                                       
                                        <div class="col-md-2 d-flex align-items-end mb-3">
                                            <button class="btn btn-secondary" type="button" style="color: #fff; width: 80%; height: 40px; display: flex; align-items: center; justify-content: center;" onclick="window.location.href='<?php echo base_url('admin/laporan_penyewaan'); ?>';">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <a class="btn btn-success" href="<?php echo base_url('laporan_penyewaan/exportExcel'); ?>"><i class="fas fa-file-excel"></i> Export Excel</a>
                                        <a class="btn btn-warning" href="<?php echo base_url('laporan_penyewaan/exportPDF'); ?>" style="color: #fff;">
                                            <i class="fa-solid fa-print" style="margin-right: 5px;"></i> Export Pdf
                                        </a>
                                    </div>
                                </div>
                            </div>




                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left" id="table">
                                    <thead>
                                        <tr>
                                            <th class="cell">Nomor</th>
                                            <th class="cell">Nomor Transaksi</th>
                                            <th class="cell">Penyewa</th>
                                            <th class="cell">Merk</th>
                                            <th class="cell">Model</th>
                                            <th class="cell">Tanggal Sewa</th>
                                            <th class="cell">Tanggal Selesai</th>
                                            <th class="cell">Total Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($penyewa)): ?>
                                            <?php $no = 1;
                                            foreach ($penyewa as $p): ?>
                                                <tr>
                                                    <td class="cell"><?php echo $no++; ?></td>
                                                    <td class="cell"><?php echo $p->no_transaksi; ?></td>
                                                    <td class="cell"><?php echo $p->penyewa; ?></td>
                                                    <td class="cell"><?php echo $p->merk; ?></td>
                                                    <td class="cell"><?php echo $p->model; ?></td>
                                                    <td class="cell"><?php echo $p->tgl_sewa; ?></td>
                                                    <td class="cell"><?php echo $p->tgl_kembali; ?></td>
                                                    <td class="cell"><?php echo 'Rp ' . number_format($p->total_bayar, 0, ',', '.'); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="cell text-center">Tidak ada data ditemukan</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//tab-pane-->
            </div>
        </div>
    </div>
</div>
</div>

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