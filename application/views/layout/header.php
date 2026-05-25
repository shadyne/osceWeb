<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= isset($judul) ? e($judul) : 'OSCE Rekam Medis' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/skins/skin-purple.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/pace/pace-theme-flash.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/app.css') ?>">

    <script src="<?= base_url('assets/bower_components/jquery/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/bower_components/sweetalert2/sweetalert2.all.min.js') ?>"></script>

    <script>let base_url = '<?= base_url() ?>';</script>
</head>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <a href="<?= site_url() ?>" class="logo">
            <span class="logo-mini"><b>O</b>SCE</span>
            <span class="logo-lg"><b>OSCE</b> RM</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"></a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user-circle"></i>
                            <span class="hidden-xs"><?= e($user['nama_lengkap'] ?? '') ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header" style="background:#605ca8;">
                                <p>
                                    <?= e($user['nama_lengkap'] ?? '') ?>
                                    <small><?= ucfirst($user['role'] ?? '') ?></small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="<?= site_url('logout') ?>" class="btn btn-default btn-flat">
                                        <i class="fa fa-sign-out"></i> Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <?php $this->load->view('layout/sidebar'); ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <?= isset($judul) ? e($judul) : '' ?>
                <?php if (!empty($subjudul)): ?><small><?= e($subjudul) ?></small><?php endif; ?>
            </h1>
        </section>

        <section class="content container-fluid">
            <?php if (!empty($flash['success'])): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="icon fa fa-check"></i> <?= e($flash['success']) ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($flash['error'])): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="icon fa fa-ban"></i> <?= e($flash['error']) ?>
                </div>
            <?php endif; ?>
