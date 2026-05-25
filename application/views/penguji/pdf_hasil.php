<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Hasil Ujian &mdash; <?= e($mahasiswa['nama_lengkap']) ?></title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url('assets/app.css') ?>">
<style>body{padding:2rem;}</style>
</head>
<body>
<div class="no-print mb-3">
  <button class="btn btn-primary" onclick="window.print()">
    <i class="bi bi-printer"></i> Cetak / Simpan PDF
  </button>
  <a class="btn btn-outline-secondary" href="javascript:history.back()">Kembali</a>
</div>

<h2 class="text-primary mb-0">Hasil Ujian OSCE &mdash; Stase 3 Koding</h2>
<hr>

<table class="table table-borderless w-auto mb-3">
  <tr><td style="width:200px;"><strong>Nama Peserta</strong></td><td><?= e($mahasiswa['nama_lengkap']) ?></td></tr>
  <tr><td><strong>NIM</strong></td><td><?= e($mahasiswa['identitas'] ?? '-') ?></td></tr>
  <tr><td><strong>Sesi</strong></td><td><?= e($session['nama_sesi']) ?></td></tr>
  <tr><td><strong>Tanggal</strong></td><td><?= fmt_tgl($session['tanggal']) ?></td></tr>
  <tr><td><strong>Penguji</strong></td><td><?= e($penguji['nama_lengkap'] ?? '-') ?></td></tr>
</table>

<h5>Soal: <?= e($session['soal_judul']) ?></h5>
<div class="dokumen-kasus"><?= e($session['dokumen_kasus']) ?></div>

<h5 class="mt-4">Jawaban Peserta</h5>
<?php if ($jawaban): ?>
  <div class="dokumen-kasus"><?= e($jawaban['kode_diagnosa']) ?></div>
  <small class="text-muted">Disubmit: <?= fmt_tgl($jawaban['submitted_at'], 'd-m-Y H:i') ?></small>
<?php else: ?>
  <em>Peserta tidak mengumpulkan jawaban.</em>
<?php endif; ?>

<?php if (!empty($session['kunci_kode'])): ?>
  <h5 class="mt-4">Kunci Jawaban (referensi)</h5>
  <div class="dokumen-kasus"><?= e($session['kunci_kode']) ?></div>
<?php endif; ?>

<?php if ($penilaian):
    $total = $penilaian['kompetensi1'] + $penilaian['kompetensi2'] + $penilaian['kompetensi3'];
?>
<h5 class="mt-4">Hasil Penilaian</h5>
<table class="table table-bordered w-auto">
  <tr><td><strong>Nilai Akhir</strong></td><td><?= number_format($nilai_akhir, 2) ?> / 100</td></tr>
  <tr><td><strong>Total Skor</strong></td><td><?= $total ?> / 9</td></tr>
  <tr><td><strong>Global Performance</strong></td><td><?= e($penilaian['global'] ?? '-') ?></td></tr>
  <?php if (!empty($penilaian['catatan_penguji'])): ?>
    <tr><td><strong>Catatan</strong></td><td><?= nl2br(e($penilaian['catatan_penguji'])) ?></td></tr>
  <?php endif; ?>
</table>
<?php endif; ?>

<div class="text-end mt-5">
  <p class="mb-5">Penguji,</p>
  <p>( <?= e($penguji['nama_lengkap'] ?? '...........................') ?> )</p>
</div>
</body>
</html>
