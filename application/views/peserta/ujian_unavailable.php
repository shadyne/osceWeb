<div class="box box-warning">
    <div class="box-header with-border"><h3 class="box-title"><?= e($session['nama_sesi']) ?></h3></div>
    <div class="box-body">
        <div class="callout callout-warning">
            <?= e($message) ?>
        </div>
        <a class="btn btn-default" href="<?= site_url('peserta') ?>">
            <i class="fa fa-arrow-left"></i> Dashboard
        </a>
    </div>
</div>
