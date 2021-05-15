<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $judul; ?></title>

    <!-- Custom fonts for this template -->
    <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>assets/index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-home"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Absensi</div>
            </a>

            <li class="nav-item text-center">
                <a class="nav-link text-center pb-0" href="#">
                    <span>
                        <h3><label id="hours"><?= date('H') ?></label>:<label id="minutes"><?= date('i') ?></label>:<label id="seconds"><?= date('s') ?></label></h3>
                    </span></a>
            </li>

            <!-- Divider -->
            <!-- Heading -->
            <?php
            $id_level   = $this->session->userdata('id_level');
            $menu = $this->db->query("SELECT * FROM user_menu JOIN user_akses_menu ON user_menu.id_menu = user_akses_menu.id_menu WHERE user_akses_menu.id_level = $id_level GROUP BY user_akses_menu.id_menu ORDER BY urutan_menu ASC")->result() ?>
            <hr class="sidebar-divider mt-0">
            <?php foreach ($menu as $m) : ?>
                <div class="sidebar-heading">
                    <?= $m->menu; ?>
                </div>

                <?php $id_menu = $m->id_menu; ?>
                <?php $submenu = $this->db->query("SELECT * FROM user_sub_menu JOIN user_menu ON user_sub_menu.id_menu = user_menu.id_menu JOIN user_akses_menu ON user_sub_menu.id_sub = user_akses_menu.id_sub WHERE user_akses_menu.id_level = $id_level AND user_sub_menu.id_menu = $id_menu AND user_sub_menu.is_active = 1 ORDER BY urutan_sub ASC")->result() ?>
                <!-- Nav Item - Dashboard -->
                <?php foreach ($submenu as $sub) : ?>
                    <li class="nav-item <?= $judul == $sub->submenu ? "active" : null; ?>">
                        <a class="nav-link pb-0" href="<?= base_url($sub->url) ?>">
                            <i class="<?= $sub->icon; ?>"></i>
                            <span><?= $sub->submenu; ?></span></a>
                    </li>
                <?php endforeach; ?>
                <hr class="sidebar-divider mt-3">
            <?php endforeach; ?>

            <li class="nav-item">
                <a class="nav-link pt-0" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>



            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="<?= base_url() ?>assets/#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user->nama; ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url() ?>assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url() ?>assets/#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->