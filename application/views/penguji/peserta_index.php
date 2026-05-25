<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 text-primary mb-0">Akun Peserta</h1>
  <a class="btn btn-primary" href="<?= site_url('penguji/peserta_form') ?>">
    <i class="bi bi-person-plus"></i> Peserta Baru
  </a>
</div>

<div class="card">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr><th>Nama</th><th>Username</th><th>NIM</th><th>Email</th><th>Status</th><th></th></tr>
      </thead>
      <tbody>
      <?php foreach ($peserta as $p): ?>
        <tr>
          <td class="fw-semibold"><?= e($p['nama_lengkap']) ?></td>
          <td><?= e($p['username']) ?></td>
          <td><?= e($p['identitas'] ?? '-') ?></td>
          <td><?= e($p['email'] ?? '-') ?></td>
          <td>
            <span class="badge bg-<?= $p['is_active'] ? 'success' : 'secondary' ?>">
              <?= $p['is_active'] ? 'aktif' : 'nonaktif' ?>
            </span>
          </td>
          <td class="text-nowrap">
            <a class="btn btn-sm btn-outline-primary" href="<?= site_url('penguji/peserta_form/'.$p['id']) ?>">
              <i class="bi bi-pencil"></i>
            </a>
            <a class="btn btn-sm btn-outline-danger" href="<?= site_url('penguji/peserta_delete/'.$p['id']) ?>"
               onclick="return confirm('Hapus akun peserta ini? Data terkait ikut terhapus.')">
              <i class="bi bi-trash"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($peserta)): ?>
        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada akun peserta.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
