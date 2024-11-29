<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

    <title>User - Sewa Kapanpun Di Manapun</title>
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/app-logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <h2 style="margin-top: 20px;">Formulir Sewa</h2>
        <p>Isi terlebih dahulu formulir sewa di bawah ini</p>
    </div>
    <!-- End Header form -->

    <!-- Start Card -->
    <div class="card" style="margin-top: 50px;">
        <!-- Start Card Body -->
        <div class="card-body">
            <!-- Start Form -->
            <form id="bookingForm" action="#" method="post" class="needs-validation" novalidate autocomplete="off">
                <div id="step1" class="form-step">
                    <div class="form-group">
                        <label for="txnama">Nama</label>
                        <input type="text" class="form-control" id="txnama" name="name" placeholder="Masukkan Nama" required />
                        <input type="hidden" class="form-control" id="txmobilid" name="mobilId" value="<?= $_GET['id']; ?>" />
                    </div>

                    <div class="form-group">
                        <label for="txemail">Alamat Email</label>
                        <input type="email" class="form-control" id="txemail" name="email" placeholder="Masukkan Alamat Email" required />
                    </div>

                    <div class="form-group">
                        <label for="txnomorktp">Nomor KTP</label>
                        <input type="text" class="form-control angka" id="txnomorktp" name="ktp" placeholder="Masukkan Nomor KTP" required />
                    </div>

                    <div class="form-group">
                        <label for="txnomortelepon">Nomor Telepon</label>
                        <input type="text" class="form-control angka" id="txnomortelepon" name="phone" placeholder="Masukkan Nomor Telepon" required />
                    </div>

                    <div class="form-group">
                        <label for="txalamat">Alamat</label>
                        <input type="text" class="form-control" id="txalamat" name="address"
                            placeholder="Masukkan Alamat Lengkap" required />
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="txtanggalsewa">Tanggal Sewa</label>
                            <input type="date" class="form-control" id="txtanggalsewa" name="start_date"
                                onchange="calculateTotal()" required />
                        </div>

                        <div class="form-group col-md-4">
                            <label for="txtanggalkembali">Tanggal Kembali</label>
                            <input type="date" class="form-control" id="txtanggalkembali" name="end_date"
                                onchange="calculateTotal()" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="txjumlahbayar">Jumlah Pembayaran</label>
                            <input type="number" class="form-control" id="txjumlahbayar" name="amount" disabled />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="<?php echo base_url('user/dashboard/'); ?>" class="btn btn-danger" role="button">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="btn-closed d-none d-sm-block">Batal</span>
                        </a>

                        <a type="button" class="btn btn-submit ms-1" style="background-color: #51B37F; color: white;" onclick="simpan_data()">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Kirim</span>
                        </a>
                        <!-- <a type="button" class="btn btn-primary ms-1" onclick="kirim_email()">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tes Email</span>
                        </a> -->
                    </div>
                </div>
            </form>
            <!-- End Form -->
        </div>
        <!-- End Card Body -->
    </div>
    <div class="card-body" style="margin-bottom: 30px;"></div>

    <input type="hidden" id="pricePerDay" value="<?php echo $item['mobilHargaSewa']; ?>" />

    <script src="<?php echo base_url('app/form.js'); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <!-- End Card -->
</body>