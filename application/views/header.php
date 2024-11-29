<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin - Sewa Kapanpun Di Manapun</title>
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/app-logo.svg" type="image/x-icon">

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="<?php echo base_url(); ?>assets/plugins/fontawesome/js/all.min.js"></script>


    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/portal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="shortcut icon" href="favicon.ico">
    

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="<?php echo base_url(); ?> assets/css/portal.css">

    <!-- JavaScript -->
<script src="<?php echo base_url('assets/plugins/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>

<!-- Charts JS -->
<script src="<?php echo base_url('assets/plugins/chart.js/chart.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/index-charts.js'); ?>"></script>

<!-- Page Specific JS -->
<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>var base_url = '<?php echo base_url(); ?>';</script>

</head>

<body class="app">
    <header class="app-header fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">

                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div><!--//col-->
                        <div class="search-mobile-trigger d-sm-none col">
                            <i class="search-mobile-trigger-icon fa-solid fa-magnifying-glass"></i>
                        </div><!--//col-->

                        <div class="app-utilities col-auto">
                            <div class="app-utility-item app-user-dropdown dropdown">
                                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                    <img src="<?php echo base_url('assets/images/user.png'); ?>" alt="user profile">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                    <li><a class="dropdown-item" href="<?php echo base_url('login/logout'); ?>">Log Out</a></li>
                                </ul>
                            </div><!--//app-user-dropdown-->
                        </div><!--//app-utilities-->
                    </div><!--//row-->
                </div><!--//app-header-content-->
            </div><!--//container-fluid-->
        </div><!--//app-header-inner-->
        <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
                <div class="app-branding">
                    <a class="app-logo" href="<?php echo base_url(); ?>">
                        <img class="logo-icon me-2" src="<?php echo base_url('assets/images/app-logo.svg'); ?>" alt="logo">
                        <span class="logo-text">Rentalin</span>
                    </a>
                </div><!--//app-branding-->

                <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url('admin/dashboard'); ?>">
                                <span class="nav-icon">
                                    <i class="fa-solid fa-house"></i>
                                </span>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('admin/mobil'); ?>">
                                <span class="nav-icon">
                                    <i class="fa-solid fa-car"></i>
                                </span>
                                <span class="nav-link-text">Manajemen Mobil</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('admin/penyewa'); ?>">
                                <span class="nav-icon">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <span class="nav-link-text">Manajemen Penyewa</span>
                            </a>
                        </li>
                        <li class="nav-item has-submenu">
                            <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false" aria-controls="submenu-1">
                                <span class="nav-icon">
                                    <i class="fa-solid fa-money-bill"></i>
                                </span>
                                <span class="nav-link-text">Manajemen Transaksi</span>
                                <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"></path>
                                    </svg>
                                </span>
                            </a>
                            <div id="submenu-1" class="collapse submenu submenu-1" data-bs-parent="#menu-accordion">
                                <ul class="submenu-list list-unstyled">
                                    <li class="submenu-item"><a class="submenu-link" href="<?php echo base_url('admin/penyewaan'); ?>">Transaksi Penyewaan</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="<?php echo base_url('admin/pengembalian'); ?>">Transaksi Pengembalian</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item has-submenu">
                            <a class="nav-link submenu-toggle collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">
                                <span class="nav-icon">
                                    <i class="fa-solid fa-file"></i>
                                </span>
                                <span class="nav-link-text">Manajemen Laporan</span>
                                <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"></path>
                                    </svg>
                                </span>
                            </a>
                            <div id="submenu-2" class="submenu submenu-2 collapse" data-bs-parent="#menu-accordion" style="">
                                <ul class="submenu-list list-unstyled">
                                    <li class="submenu-item"><a class="submenu-link" href="<?php echo base_url('admin/laporan_penyewaan'); ?>">Laporan Penyewaan</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="<?php echo base_url('admin/laporan_pengembalian'); ?>">Laporan Pengembalian</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div><!--//sidepanel-inner-->
        </div><!--//app-sidepanel-->
    </header><!--//app-header-->