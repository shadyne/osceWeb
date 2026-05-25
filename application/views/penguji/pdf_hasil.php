<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Hasil Ujian &mdash; <?= e($mahasiswa['nama_lengkap']) ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/app.css') ?>">
    <style>body { padding: 24px; font-family: 'Segoe UI', sans-serif; }</style>
</head>
<body>

<div class="no-print" style="margin-bottom:14px;">
    <button class="btn btn-primary" onclick="window.print()">
        <i class="fa fa-print"></i> Cetak / Simpan PDF
    </button>
    <a class="btn btn-default" href="<?= site_url('penguji/hasil/'.$session['jadwal_id']) ?>">Kembali</a>
    <button class="btn btn-default" type="button" onclick="window.close()">Tutup Tab</button>
</div>

<h2>Hasil Ujian OSCE &mdash; Stase 3 Koding</h2>
<hr>

<table class="table table-condensed" style="width:auto;">
    <tr><td><strong>Nama Peserta</strong></td><td><?= e($mahasiswa['nama_lengkap']) ?></td></tr>
    <tr><td><strong>NIM</strong></td><td><?= e($mahasiswa['identitas'] ?? '-') ?></td></tr>
    <tr><td><strong>Sesi</strong></td><td><?= e($session['nama_sesi']) ?></td></tr>
    <tr><td><strong>Tanggal</strong></td><td><?= fmt_tgl($session['tanggal']) ?></td></tr>
    <tr><td><strong>Penguji</strong></td><td><?= e($penguji['nama_lengkap'] ?? '-') ?></td></tr>
</table>

<h4>Soal: <?= e($session['soal_judul']) ?></h4>
<div class="dokumen-kasus"><?= e($session['dokumen_kasus']) ?></div>

<h4 style="margin-top:20px;">Jawaban Peserta</h4>
<?php if ($jawaban): ?>
    <div class="dokumen-kasus"><?= e($jawaban['kode_diagnosa']) ?></div>
    <small class="text-muted">Disubmit: <?= fmt_tgl($jawaban['submitted_at'], 'd-m-Y H:i') ?></small>
<?php else: ?>
    <em>Peserta tidak mengumpulkan jawaban.</em>
<?php endif; ?>

<?php if (!empty($session['kunci_kode'])): ?>
    <h4 style="margin-top:20px;">Kunci Jawaban (referensi)</h4>
    <div class="dokumen-kasus"><?= e($session['kunci_kode']) ?></div>
<?php endif; ?>

<?php if ($penilaian):
    $total = $penilaian['kompetensi1'] + $penilaian['kompetensi2'] + $penilaian['kompetensi3'];
?>
    <h4 style="margin-top:20px;">Hasil Penilaian</h4>
    <table class="table table-bordered" style="width:auto;">
        <tr><td><strong>Nilai Akhir</strong></td><td><?= number_format($nilai_akhir, 2) ?> / 100</td></tr>
        <tr><td><strong>Total Skor</strong></td><td><?= $total ?> / 9</td></tr>
        <tr><td><strong>Global Performance</strong></td><td><?= e($penilaian['global'] ?? '-') ?></td></tr>
        <?php if (!empty($penilaian['catatan_penguji'])): ?>
            <tr><td><strong>Catatan</strong></td><td><?= nl2br(e($penilaian['catatan_penguji'])) ?></td></tr>
        <?php endif; ?>
    </table>
<?php endif; ?>

<div style="margin-top:60px;text-align:right;">
    <p>Penguji,</p><br><br>
    <p>( <?= e($penguji['nama_lengkap'] ?? '...........................') ?> )</p>
</div>

</body>
</html>
