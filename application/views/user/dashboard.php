<!doctype html>
<html lang="en">

<head>
    <title>User - Sewa Kapanpun Di Manapun</title>
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/app-logo.svg" type="image/x-icon">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

</head>

<body>


    <div class="site-wrap" id="home-section">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>


        <header class="site-navbar site-navbar-target" role="banner">

            <div class="container">
                <div class="row align-items-center position-relative">

                    <div class="col-3">
                        <div class="site-logo">
                            <img class="logo-icon me-2" src="<?php echo base_url('assets/images/app-logo.svg'); ?>" alt="logo" style="max-width: 30px; height: auto;">
                            <a href=""><strong style="color: #51B37F;">Rentalin</strong></a>
                        </div>
                    </div>


                    <div class="col-9  text-right">
                        <span class="d-inline-block d-lg-none"><a href="#" class=" site-menu-toggle js-menu-toggle py-5 "><span class="icon-menu h3 text-black"></span></a></span>
                        <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav ml-auto">
                                <li class="active"><a href="#home" class="nav-link">Home</a></li>
                                <li><a href="#prosedur" class="nav-link">Prosedur Rental</a></li>
                                <li><a href="#daftar" class="nav-link">Daftar Mobil</a></li>
                                <li><a href="<?php echo base_url('user/riwayat'); ?>" class="nav-link">Riwayat Sewa</a></li>
                                <li><a href="<?php echo base_url('login/logout'); ?>" class="nav-link">Log Out</a></li>
                            </ul>
                        </nav>
                    </div>


                </div>
            </div>

        </header>


        <div class="hero" id="home" style="background-image: url('<?php echo base_url(); ?>assets/images/dsuser/hero_1_a.jpg');">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-10">

                        <div class="row mb-5">
                            <div class="col-lg-7 intro">
                                <h1><strong style="color: #51B37F;">Sewa mobil</strong> hanya dalam genggaman</h1>
                            </div>
                        </div>

                        <form class="trip-form" method="GET" action="<?php echo site_url('user/dashboard/search'); ?>">
                            <div class="row align-items-center">
                                <div class="mb-3 mb-md-0 col-md-3">
                                    <select id="txpilihmerk" class="form-control" name="merk">
                                        <option value="" disabled selected>Pilih Merk</option>
                                        <?php
                                        // Koneksi ke database
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $dbname = "rentalin";

                                        // Buat koneksi
                                        $conn = new mysqli($servername, $username, $password, $dbname);

                                        // Cek koneksi
                                        if ($conn->connect_error) {
                                            die("Koneksi gagal: " . $conn->connect_error);
                                        }

                                        // Query untuk mengambil data merk dari tabel mobil
                                        $sql = "SELECT DISTINCT mobilMerk FROM mobil";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            // Output data dari setiap baris
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . htmlspecialchars($row['mobilMerk']) . '">' . htmlspecialchars($row['mobilMerk']) . '</option>';
                                            }
                                        }

                                        // Tutup koneksi
                                        $conn->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3 mb-md-0 col-md-3">
                                    <div class="form-control-wrap">
                                        <input type="text" id="cf-3 txtanggalpinjam" placeholder="Tanggal Peminjaman" class="form-control datepicker px-3">
                                        <span class="icon icon-date_range"></span>

                                    </div>
                                </div>
                                <div class="mb-3 mb-md-0 col-md-3">
                                    <div class="form-control-wrap">
                                        <input type="text" id="cf-4 txtanggalkembali" placeholder="Tanggal Penggembalian" class="form-control datepicker px-3">
                                        <span class="icon icon-date_range"></span>
                                    </div>
                                </div>
                                <div class="mb-3 mb-md-0 col-md-3">
                                    <input type="submit" value="Cari Mobil" class="btn" style="background-color: #51B37F; color: #fff; padding: 13px 25px; font-size: 16px; border: 2px solid #51B37F; border-radius: 4px; text-align: center; display: inline-block; cursor: pointer; width: 100%;">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="site-section" id="prosedur">
            <div class="container">
                <h2 class="section-heading"><strong>Bagaimana Cara Menyewanya?</strong></h2>
                <p class="mb-5">Simak langkah-langkah di bawah ini</p>

                <div class="row mb-5">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <div class="step">
                            <span style="color: #51B37F;">1</span>
                            <div class="step-inner">
                                <span class="number" style="color: #51B37F;">01.</span>
                                <h3>Pilih mobil</h3>
                                <p>Temukan mobil yang sesuai dengan kebutuhan Anda dari berbagai pilihan yang kami tawarkan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <div class="step">
                            <span style="color: #51B37F;">2</span>
                            <div class="step-inner">
                                <span class="number" style="color: #51B37F;">02.</span>
                                <h3>Isi formulir</h3>
                                <p>Lengkapi formulir dengan informasi Anda untuk proses penyewaan yang cepat dan mudah</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <div class="step">
                            <span style="color: #51B37F;">3</span>
                            <div class="step-inner">
                                <span class="number" style="color: #51B37F;">03.</span>
                                <h3>Pembayaran</h3>
                                <p>Selesaikan transaksi dan nikmati perjalan berkesanmu dengan menggunakan mobil pilihan kamu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section bg-light" id="daftar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <h2 class="section-heading"><strong>Datar Mobil</strong></h2>
                        <p class="mb-5">Berbagai macam mobil dapat kamu sewa sesuai dengan kebutuhan kamu</p>
                    </div>
                </div>

                <div class="row">
                    <?php if (!empty($mobil)): ?>
                        <?php foreach ($mobil as $item): ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="listing d-block align-items-stretch">
                                    <img src="<?php echo base_url($item['mobilFoto']); ?>" alt="Image" class="img-fluid" style="margin-bottom: 15px;">
                                    <div class="listing-contents h-100">
                                        <h3><?php echo htmlspecialchars($item['mobilMerk'] . ' ' . $item['mobilModel']); ?></h3>
                                        <div class="rent-price">
                                            <strong style="color: #51B37F;"><?php echo 'Rp' . number_format($item['mobilHargaSewa'], 0); ?></strong>
                                            <span class="mx-1">/</span>hari
                                        </div>
                                        <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                                            <div class="listing-feature pr-4">
                                                <span class="caption">Kursi:</span>
                                                <span class="number"><?php echo htmlspecialchars($item['mobilKursi']); ?></span>
                                            </div>
                                        </div>
                                        <div>
                                            <p><a href="<?php echo base_url('user/dashboard/form?id=' . $item['mobilId']); ?>" class="btn" style="background-color: #51B37F; color: #fff; padding: 10px 24px; font-size: 16px;">Sewa</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada mobil yang tersedia untuk pencarian ini.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="site-section" style="background-color: #51B37F; padding: 5rem 0;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-4 mb-md-0">
                        <h2 class="mb-0 text-white">Tunggu apa lagi?</h2>
                        <p class="mb-0 opa-7">Proses rental cepat, kapanpun, dan dimanapun tanpa repot!</p>
                    </div>
                    <div class="col-lg-5 text-md-right">
                        <a href="" class="btn" style="background-color: #fff; color: #51B37F; border: 2px solid #51B37F; padding: 12px 26px; font-size: 18px;">Rental sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.sticky.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.animateNumber.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.fancybox.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.easing.1.3.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/aos.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
</body>

</html>