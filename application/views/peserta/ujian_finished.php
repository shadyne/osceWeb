<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 text-primary mb-0"><?= e($session['nama_sesi']) ?></h1>
  <a href="<?= site_url('peserta') ?>" class="btn btn-link">&larr; Dashboard</a>
</div>

<div class="alert alert-success">
  <i class="bi bi-check-circle"></i> Ujian telah selesai. Hasil akan dinilai oleh penguji.
</div>

<?php if ($jawaban): ?>
<div class="card">
  <div class="card-body">
    <h5 class="card-title text-primary">Jawaban Anda</h5>
    <div class="dokumen-kasus"><?= e($jawaban['kode_diagnosa']) ?></div>
    <?php if (!empty($jawaban['catatan_peserta'])): ?>
      <p class="mt-2"><strong>Catatan:</strong> <?= nl2br(e($jawaban['catatan_peserta'])) ?></p>
    <?php endif; ?>
    <small class="text-muted">Disubmit: <?= fmt_tgl($jawaban['submitted_at'], 'd-m-Y H:i') ?></small>
  </div>
</div>
<?php endif; ?>
