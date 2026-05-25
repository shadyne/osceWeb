<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OSCE Rekam Medis</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/app.css') ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-osce shadow-sm">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold" href="<?= site_url() ?>">
      OSCE RM <small class="opacity-75 fw-normal">Stase Koding</small>
    </a>
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <i class="bi bi-list fs-3"></i>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto">
        <?php if (!empty($user) && $user['role'] === 'penguji'): ?>
          <li class="nav-item"><a class="nav-link" href="<?= site_url('penguji/dashboard') ?>">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= site_url('penguji/soal') ?>">Soal</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= site_url('penguji/jadwal') ?>">Jadwal</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= site_url('penguji/peserta') ?>">Peserta</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= site_url('penguji/hasil') ?>">Hasil</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= site_url('penguji/rubrik') ?>">Rubrik</a></li>
        <?php elseif (!empty($user) && $user['role'] === 'peserta'): ?>
          <li class="nav-item"><a class="nav-link" href="<?= site_url('peserta/dashboard') ?>">Dashboard</a></li>
        <?php endif; ?>
      </ul>
      <?php if (!empty($user)): ?>
      <div class="d-flex align-items-center gap-3 text-white">
        <span><?= htmlspecialchars($user['nama_lengkap']) ?>
          <small class="opacity-75">(<?= $user['role'] ?>)</small></span>
        <a class="btn btn-outline-light btn-sm" href="<?= site_url('logout') ?>">
          <i class="bi bi-box-arrow-right"></i> Logout
        </a>
      </div>
      <?php endif; ?>
    </div>
  </div>
</nav>

<main class="container-fluid px-4 py-4">
  <?php if (!empty($flash['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($flash['success']) ?></div>
  <?php endif; ?>
  <?php if (!empty($flash['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($flash['error']) ?></div>
  <?php endif; ?>
