<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title">Manajemen Transaksi Penyewaan</h1>
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
                                            <th class="cell">Total Bayar</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Cetak Nota</th>
                                            <th class="cell">Edit</th>
                                            <th class="cell">Hapus</th>
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
                                                    <td class="cell">
                                                        <span class="badge <?php echo $p->status == 1 ? 'badge-success' : 'badge-warning'; ?>"
                                                            data-id="<?php echo $p->sewa_id; ?>"
                                                            data-status="<?php echo $p->status; ?>"
                                                            onclick="changeStatus(this)">
                                                            <?php echo $p->status == 1 ? 'Berlangsung' : 'Selesai'; ?>
                                                        </span>
                                                    </td>
                                                    <td class="cell">
                                                        <a href="<?php echo base_url('admin/penyewaan/cetak_nota_penyewaan/' . $p->sewa_id); ?>"class="btn btn-primary btn-sm btn-print">
                                                            <i class="fa-solid fa-print"></i>
                                                        </a>
                                                    </td>
                                                    <td class="cell">
                                                        <button
                                                            class="btn btn-warning btn-sm btn-edit"
                                                            data-toggle="modal"
                                                            data-target="#addModal"
                                                            onclick="edit_data('<?php echo $p->sewa_id; ?>', '<?php echo $p->penyewa; ?>', '<?php echo $p->merk; ?>', '<?php echo $p->model; ?>', '<?php echo $p->tgl_sewa; ?>', '<?php echo $p->tgl_kembali; ?>', '<?php echo $p->total_bayar; ?>')">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </td>
                                                    <td class="cell">
                                                        <button class="btn btn-danger btn-sm btn-delete" onclick="hapus_data('<?php echo $p->sewa_id; ?>')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="cell">Tidak ada data ditemukan</td>
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
                <h5 class="modal-title" id="addModalLabel">Data Transaksi Penyewaan</h5>
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
                        <label for="sewaTotalBayar">Total Bayar</label>
                        <input type="text" class="form-control input_total_bayar" id="txtotalbayar" name="sewaTotalBayar" placeholder="Total Bayar" required>
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

    function edit_data(sewaId, penyewa, merk, model, tglSewa, tglKembali, totalBayar) {
        document.getElementById('txpenyewa').value = penyewa;
        document.getElementById('txmerk').value = merk;
        document.getElementById('txmodel').value = model;
        document.getElementById('txtanggalsewa').value = tglSewa;
        document.getElementById('txtanggalselesai').value = tglKembali;
        document.getElementById('txtotalbayar').value = totalBayar;
        document.getElementById('sewaIdInput').value = sewaId;
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