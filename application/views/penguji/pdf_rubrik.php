<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Rubrik Penilaian &mdash; <?= e($mahasiswa['nama_lengkap']) ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/app.css') ?>">
    <style>
        body { padding: 24px; font-family: 'Segoe UI', sans-serif; font-size: 12px; }
        td.desk { max-width: 160px; font-size: 11px; line-height: 1.4; white-space: pre-line; vertical-align: top; }
    </style>
</head>
<body>

<div class="no-print" style="margin-bottom:14px;">
    <button class="btn btn-primary" onclick="window.print()">
        <i class="fa fa-print"></i> Cetak / Simpan PDF
    </button>
    <a class="btn btn-default" href="<?= site_url('penguji/hasil/'.$session['jadwal_id']) ?>">Kembali</a>
    <button class="btn btn-default" type="button" onclick="window.close()">Tutup Tab</button>
</div>

<h2>RUBRIK PENILAIAN &mdash; STATION KODIFIKASI KLINIS</h2>
<hr>

<table class="table table-condensed" style="width:auto;">
    <tr><td><strong>Nomor Stasi</strong></td><td>3</td></tr>
    <tr><td><strong>Judul Stasi</strong></td><td>Kodefikasi Klinis</td></tr>
    <tr><td><strong>Nama Mahasiswa</strong></td><td><?= e($mahasiswa['nama_lengkap']) ?></td></tr>
    <tr><td><strong>NIM</strong></td><td><?= e($mahasiswa['identitas'] ?? '-') ?></td></tr>
    <tr><td><strong>Tanggal Penilaian</strong></td>
        <td><?= $penilaian ? fmt_tgl($penilaian['tanggal_penilaian']) : '-' ?></td></tr>
    <tr><td><strong>Penguji</strong></td><td><?= e($penguji['nama_lengkap'] ?? '-') ?></td></tr>
</table>

<table class="table table-bordered">
    <thead>
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
            <td><strong><?= e($k['komponen']) ?></strong></td>
            <td class="desk"><?= e($k['desk_skor_0']) ?></td>
            <td class="desk"><?= e($k['desk_skor_1']) ?></td>
            <td class="desk"><?= e($k['desk_skor_2']) ?></td>
            <td class="desk"><?= e($k['desk_skor_3']) ?></td>
            <td style="text-align:center;font-size:18px;font-weight:700;">
                <?= $skor !== null ? $skor : '-' ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h4 style="margin-top:20px;">Global Performance</h4>
<table class="table table-bordered">
    <thead>
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
                <td class="text-center" style="font-size:18px;">
                    <?= ($penilaian && $penilaian['global'] === $opt) ? '&#10003;' : '' ?>
                </td>
            <?php endforeach; ?>
        </tr>
    </tbody>
</table>

<?php if ($penilaian && !empty($penilaian['catatan_penguji'])): ?>
    <p><strong>Catatan Penguji:</strong><br><?= nl2br(e($penilaian['catatan_penguji'])) ?></p>
<?php endif; ?>

<p><strong>Nilai Akhir:</strong>
   <?= $nilai_akhir !== null ? number_format($nilai_akhir, 2) . ' / 100' : '-' ?></p>

<div style="margin-top:60px;text-align:right;">
    <p>Cirebon, <?= date('d F Y') ?></p>
    <p>Penguji,</p><br><br>
    <p>( <?= e($penguji['nama_lengkap'] ?? '...........................') ?> )</p>
</div>

</body>
</html>
