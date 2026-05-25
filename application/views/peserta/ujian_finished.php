<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title"><?= e($session['nama_sesi']) ?></h3>
        <div class="box-tools pull-right">
            <a class="btn btn-default btn-sm" href="<?= site_url('peserta') ?>">
                <i class="fa fa-arrow-left"></i> Dashboard
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="callout callout-success">
            <i class="fa fa-check-circle"></i> Ujian telah selesai. Hasil akan dinilai oleh penguji.
        </div>

        <?php if ($jawaban): ?>
            <h4>Jawaban Anda</h4>
            <div class="dokumen-kasus"><?= e($jawaban['kode_diagnosa']) ?></div>
            <p class="help-block">Disubmit: <?= fmt_tgl($jawaban['submitted_at'], 'd-m-Y H:i') ?></p>
        <?php endif; ?>
    </div>
</div>
