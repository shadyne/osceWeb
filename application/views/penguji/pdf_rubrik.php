<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Rubrik Penilaian &mdash; <?= e($mahasiswa['nama_lengkap']) ?></title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url('assets/app.css') ?>">
<style>body{padding:2rem;font-size:.85rem;} td.desk{max-width:160px;font-size:.75rem;line-height:1.4;white-space:pre-line;}</style>
</head>
<body>
<div class="no-print mb-3">
  <button class="btn btn-primary" onclick="window.print()">
    <i class="bi bi-printer"></i> Cetak / Simpan PDF
  </button>
  <a class="btn btn-outline-secondary" href="javascript:history.back()">Kembali</a>
</div>

<h2 class="text-primary mb-0">RUBRIK PENILAIAN &mdash; STATION KODIFIKASI KLINIS</h2>
<hr>

<table class="table table-borderless w-auto mb-3">
  <tr><td><strong>Nomor Stasi</strong></td><td>3</td></tr>
  <tr><td><strong>Judul Stasi</strong></td><td>Kodefikasi Klinis</td></tr>
  <tr><td><strong>Nama Mahasiswa</strong></td><td><?= e($mahasiswa['nama_lengkap']) ?></td></tr>
  <tr><td><strong>NIM</strong></td><td><?= e($mahasiswa['identitas'] ?? '-') ?></td></tr>
  <tr><td><strong>Tanggal Penilaian</strong></td>
      <td><?= $penilaian ? fmt_tgl($penilaian['tanggal_penilaian']) : '-' ?></td></tr>
  <tr><td><strong>Penguji</strong></td><td><?= e($penguji['nama_lengkap'] ?? '-') ?></td></tr>
</table>

<table class="table table-bordered align-middle">
  <thead class="table-light">
    <tr>
      <th>No</th><th>Kompetensi</th>
      <th class="desk">0</th><th class="desk">1</th><th class="desk">2</th><th class="desk">3</th>
      <th>Skor</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($komponen as $i => $k):
      $field = 'kompetensi' . ($i + 1);
      $skor  = $penilaian[$field] ?? null;
  ?>
    <tr>
      <td><?= $k['nomor'] ?></td>
      <td class="fw-semibold"><?= e($k['komponen']) ?></td>
      <td class="desk"><?= e($k['desk_skor_0']) ?></td>
      <td class="desk"><?= e($k['desk_skor_1']) ?></td>
      <td class="desk"><?= e($k['desk_skor_2']) ?></td>
      <td class="desk"><?= e($k['desk_skor_3']) ?></td>
      <td class="text-center fs-5 fw-bold"><?= $skor !== null ? $skor : '-' ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<h5 class="mt-4">Global Performance</h5>
<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Nama Mahasiswa</th>
      <?php foreach (['Tidak Lulus','Borderline','Lulus','Superior'] as $opt): ?>
        <th class="text-center"><?= $opt ?></th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?= e($mahasiswa['nama_lengkap']) ?></td>
      <?php foreach (['Tidak Lulus','Borderline','Lulus','Superior'] as $opt): ?>
        <td class="text-center fs-4">
          <?= ($penilaian && $penilaian['global'] === $opt) ? '&#10003;' : '' ?>
        </td>
      <?php endforeach; ?>
    </tr>
  </tbody>
</table>

<?php if ($penilaian && !empty($penilaian['catatan_penguji'])): ?>
  <p class="mt-3"><strong>Catatan Penguji:</strong><br>
     <?= nl2br(e($penilaian['catatan_penguji'])) ?></p>
<?php endif; ?>

<p class="mt-2"><strong>Nilai Akhir:</strong>
   <?= $nilai_akhir !== null ? number_format($nilai_akhir, 2) . ' / 100' : '-' ?></p>

<div class="text-end mt-5">
  <p>Cirebon, <?= date('d F Y') ?></p>
  <p class="mb-5">Penguji,</p>
  <p>( <?= e($penguji['nama_lengkap'] ?? '...........................') ?> )</p>
</div>
</body>
</html>
