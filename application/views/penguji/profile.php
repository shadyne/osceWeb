<?php
$team = [
    ['nama' => 'Firda Khoerunnisa',     'nim' => 'P20637124050', 'color' => '#3c8dbc'],
    ['nama' => 'Istiazah Berlianti',    'nim' => 'P20637124052', 'color' => '#605ca8'],
    ['nama' => 'Nada Naziha',           'nim' => 'P20637124057', 'color' => '#00a65a'],
    ['nama' => 'Naira Fazilatun Nisa',  'nim' => 'P20637124058', 'color' => '#f39c12'],
    ['nama' => 'Syalsa Zaskia Rahayu',  'nim' => 'P20637124073', 'color' => '#dd4b39'],
];
?>

<div class="box box-primary">
    <div class="box-body text-center" style="padding:40px 20px;">
        <i class="fa fa-paper-plane" style="font-size:48px;color:#605ca8;"></i>
        <h2 style="margin:14px 0 4px;font-weight:700;letter-spacing:1px;">OS3CODE</h2>
        <p class="text-muted" style="font-size:15px;margin-bottom:18px;">
            Sistem Penilaian OSCE Stase 3 Koding
        </p>
        <hr style="max-width:600px;margin:14px auto;">
        <p style="max-width:760px;margin:0 auto;color:#555;">
            Aplikasi berbasis web untuk mengelola simulasi ujian OSCE Stase 3 (Kodifikasi Klinis)
            pada program studi Rekam Medis. Mendukung manajemen soal, jadwal ujian, penilaian rubrik,
            dan rekap hasil dalam satu sistem terintegrasi.
        </p>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-users"></i> &nbsp; Tim Pengembang &mdash; Kelompok 7</h3>
    </div>
    <div class="box-body">
        <div class="row text-center">
            <?php foreach ($team as $m): ?>
                <div class="col-md col-sm-4 col-xs-6" style="margin-bottom:24px;">
                    <div style="width:80px;height:80px;border-radius:50%;
                                background:<?= $m['color'] ?>;color:#fff;
                                display:flex;align-items:center;justify-content:center;
                                font-size:32px;font-weight:700;margin:0 auto 10px;
                                box-shadow:0 4px 12px rgba(0,0,0,0.15);">
                        <?= strtoupper(substr($m['nama'], 0, 1)) ?>
                    </div>
                    <div style="font-weight:600;font-size:14px;">
                        <?= e($m['nama']) ?>
                    </div>
                    <div class="text-muted" style="font-size:12px;">
                        <?= e($m['nim']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
