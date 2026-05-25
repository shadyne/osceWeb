<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 text-primary mb-0">Bank Soal</h1>
  <div class="d-flex gap-2">
    <a class="btn btn-secondary" href="<?= site_url('penguji/soal_import') ?>">
      <i class="bi bi-upload"></i> Import CSV
    </a>
    <a class="btn btn-primary" href="<?= site_url('penguji/soal_form') ?>">
      <i class="bi bi-plus-lg"></i> Soal Baru
    </a>
  </div>
</div>

<div class="card">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr><th>Judul</th><th>Kunci Kode</th><th>Dibuat</th><th></th></tr>
      </thead>
      <tbody>
      <?php foreach ($soal as $s): ?>
        <tr>
          <td class="fw-semibold"><?= e($s['judul']) ?></td>
          <td><?= e($s['kunci_kode'] ?? '-') ?></td>
          <td><?= fmt_tgl($s['created_at']) ?></td>
          <td>
            <a class="btn btn-sm btn-outline-primary" href="<?= site_url('penguji/soal_form/'.$s['id']) ?>">
              <i class="bi bi-pencil"></i>
            </a>
            <a class="btn btn-sm btn-outline-danger" href="<?= site_url('penguji/soal_delete/'.$s['id']) ?>"
               onclick="return confirm('Hapus soal?')">
              <i class="bi bi-trash"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($soal)): ?>
        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada soal.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
