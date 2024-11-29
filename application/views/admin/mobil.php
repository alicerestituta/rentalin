<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title">Manajemen Mobil</h1>
                </div>
                <div class="col-auto">
                    <button class="btn" data-toggle="modal" data-target="#addModal" style="background-color: #51B37F; color: #fff;" onclick="showModal()">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                    <button class="btn btn-primary ml-2" id="refreshButton" onclick="load_data()">
                        <i class="fas fa-sync-alt"></i> Muat Ulang
                    </button>
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
                                            <th class="cell">Merk</th>
                                            <th class="cell">Model</th>
                                            <th class="cell">Foto</th>
                                            <th class="cell">Kursi</th>
                                            <th class="cell">Harga Sewa/Hari</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Edit</th>
                                            <th class="cell">Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                <h5 class="modal-title" id="addModalLabel">Data Mobil</h5>
                <button type="button" class="close btn-closed" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCarForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="carMerk">Merk</label>
                        <input type="text" class="form-control input_merk" id="txmerk" name="carMerk" placeholder="Merk Mobil" required>
                    </div>
                    <div class="form-group">
                        <label for="carModel">Model</label>
                        <input type="text" class="form-control input_model" id="txmodel" name="carModel" placeholder="Model Mobil" required>
                    </div>
                    <div class="form-group">
                        <label for="carFoto">Foto</label>
                        <input type="file" class="form-control input_foto" id="txfoto" name="carFoto" placeholder="Foto Mobil" required>
                        <img id="imgPreview" src="" alt="Preview" style="max-width: 100%; margin-top: 10px;">
                    </div>
                    <div class="form-group">
                        <label for="carKursi">Kursi</label>
                        <input type="text" class="form-control input_kursi angka" id="txkursi" name="carKursi" placeholder="Kursi Mobil" required>
                    </div>
                    <div class="form-group">
                        <label for="carSewa">Harga Sewa/Hari</label>
                        <input type="text" class="form-control input_hargasewa angka" id="txhargasewa" name="carSewa" placeholder="Harga Sewa" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="simpan_data()" class="btn btn-primary btn-submit ms-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tambah</span>
                        </button>
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