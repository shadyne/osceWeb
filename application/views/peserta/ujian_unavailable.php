<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 text-primary mb-0"><?= e($session['nama_sesi']) ?></h1>
  <a href="<?= site_url('peserta') ?>" class="btn btn-link">&larr; Dashboard</a>
</div>

<div class="alert alert-info"><?= e($message) ?></div>
