<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title">Manajemen Transaksi Pengembalian</h1>
                </div>
            </div>

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
                                            <th class="cell">Penyewa</th>
                                            <th class="cell">Merk</th>
                                            <th class="cell">Model</th>
                                            <th class="cell">Tanggal Sewa</th>
                                            <th class="cell">Tanggal Selesai</th>
                                            <th class="cell">Tanggal Kembali</th>
                                            <th class="cell">Total Bayar</th>
                                            <th class="cell">Denda</th>
                                            <th class="cell">Total Bayar Akhir</th>
                                            <th class="cell">Cetak Nota</th>
                                            <th class="cell">Edit</th>
                                            <th class="cell">Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($penyewa)): ?>
                                            <?php $no = 1; ?>
                                            <?php foreach ($penyewa as $p): ?>
                                                <?php if ($p->status == 0):
                                                ?>
                                                    <tr>
                                                        <td class="cell"><?php echo $no++; ?></td>
                                                        <td class="cell"><?php echo $p->no_transaksi; ?></td>
                                                        <td class="cell"><?php echo $p->penyewa; ?></td>
                                                        <td class="cell"><?php echo $p->merk; ?></td>
                                                        <td class="cell"><?php echo $p->model; ?></td>
                                                        <td class="cell"><?php echo $p->tgl_sewa; ?></td>
                                                        <td class="cell"><?php echo $p->tgl_kembali; ?></td>
                                                        <td class="cell"><?php echo $p->tgl_selesai; ?></td>
                                                        <td class="cell"><?php echo 'Rp ' . number_format($p->total_bayar, 0, ',', '.'); ?></td>
                                                        <!-- <td class="cell"><?php echo $p->denda > 0 ? $p->denda : 'Tidak Ada Denda'; ?></td> -->
                                                        <td class="cell"><?php echo $p->denda > 0 ? 'Rp ' . number_format($p->denda, 0, ',', '.') : 'Tidak Ada Denda'; ?></td>
                                                        <td class="cell"><?php echo 'Rp ' . number_format($p->total_bayar_akhir, 0, ',', '.'); ?></td>
                                                        <!-- <td class="cell">
                                                        <button class="btn btn-warning btn-sm btn-edit" data-toggle="modal" data-target="#addModal" onclick="edit_data()">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </td> -->
                                                        <td class="cell">
                                                            <a href="<?php echo base_url('admin/pengembalian/cetak_nota_pengembalian/' . $p->sewa_id); ?>" class="btn btn-primary btn-sm btn-print">
                                                                <i class="fa-solid fa-print"></i>
                                                            </a>
                                                        </td>
                                                        <td class="cell">
                                                            <button
                                                                class="btn btn-warning btn-sm btn-edit"
                                                                data-toggle="modal"
                                                                data-target="#addModal"
                                                                onclick="edit_data('<?php echo $p->sewa_id; ?>', '<?php echo $p->penyewa; ?>', '<?php echo $p->merk; ?>', '<?php echo $p->model; ?>', '<?php echo $p->tgl_sewa; ?>', '<?php echo $p->tgl_kembali; ?>', '<?php echo $p->tgl_selesai; ?>', '<?php echo $p->total_bayar; ?>', '<?php echo $p->denda; ?>', '<?php echo $p->total_bayar_akhir; ?>')">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </td>
                                                        <td class="cell">
                                                            <button class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="cell">Tidak ada data ditemukan</td>
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

<!-- MODAL -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Data Transaksi Pengembalian</h5>
                <button type="button" class="close btn-closed" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCarForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="sewaPenyewa">Penyewa</label>
                        <input type="text" class="form-control input_penyewa" id="txpenyewa" name="sewaPenyewa" placeholder="Nama Penyewa" required>
                    </div>
                    <div class="form-group">
                        <label for="sewaMerk">Merk</label>
                        <input type="text" class="form-control input_merk" id="txmerk" name="sewaMerk" placeholder="Merk Mobil" required>
                    </div>
                    <div class="form-group">
                        <label for="sewaModel">Model</label>
                        <input type="text" class="form-control input_model" id="txmodel" name="sewaModel" placeholder="Model Mobil" required>
                    </div>
                    <div class="form-group">
                        <label for="sewaTanggalSewa">Tanggal Sewa</label>
                        <input type="date" class="form-control input_tanggal_sewa" id="txtanggalsewa" name="sewaTanggalSewa" placeholder="Tanggal Sewa" required>
                    </div>
                    <div class="form-group">
                        <label for="sewaTanggalSelesai">Tanggal Selesai</label>
                        <input type="date" class="form-control input_tanggal_selesai" id="txtanggalselesai" name="sewaTanggalSelesai" placeholder="Tanggal Selesai" required>
                    </div>
                    <div class="form-group">
                        <label for="sewaTanggalKembali">Tanggal Kembali</label>
                        <input type="date" class="form-control input_tanggal_kembali" id="txtanggalkembali" name="sewaTanggalKembali" placeholder="Tanggal Kembali" required>
                    </div>
                    <div class="form-group">
                        <label for="sewaTotalBayar">Total Bayar</label>
                        <input type="text" class="form-control input_total_bayar" id="txtotalbayar" name="sewaTotalBayar" placeholder="Total Bayar" required>
                    </div>
                    <div class="form-group">
                        <label for="sewaDenda">Denda</label>
                        <input type="text" class="form-control input_denda" id="txdenda" name="sewaDenda" placeholder="Denda" required>
                    </div>
                    <div class="form-group">
                        <label for="sewaTotalBayarAkhir">Total Bayar Akhir</label>
                        <input type="text" class="form-control input_total_bayar_akhir" id="txtotalbayarakhir" name="sewaTotalBayarAkhir" placeholder="Total Bayar Akhir" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="update_data()" class="btn btn-primary btn-update ms-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Edit</span>
                        </button>
                        <button type="button" class="btn btn-danger btn-closed" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="btn-closed d-none d-sm-block ">Batal</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function edit_data(sewa_id, penyewa, merk, model, tgl_sewa, tgl_kembali, tgl_selesai, total_bayar, denda, total_bayar_akhir) {
        $('#txpenyewa').val(penyewa);
        $('#txmerk').val(merk);
        $('#txmodel').val(model);
        $('#txtanggalsewa').val(tgl_sewa);
        $('#txtanggalkembali').val(tgl_kembali);
        $('#txtanggalselesai').val(tgl_selesai);
        $('#txtotalbayar').val(total_bayar);
        $('#txdenda').val(denda);
        $('#txtotalbayarakhir').val(total_bayar_akhir);

        $('#update_sewa_id').val(sewa_id);
    }

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