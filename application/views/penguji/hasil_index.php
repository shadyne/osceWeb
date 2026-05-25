<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 text-primary mb-0">Hasil &mdash; <?= e($jadwal['nama_sesi']) ?></h1>
  <a href="<?= site_url('penguji/hasil') ?>" class="btn btn-link">&larr; Daftar Jadwal</a>
</div>

<div class="card">
  <div class="card-body">
    <p class="mb-3">
      <strong>Tanggal:</strong> <?= fmt_tgl($jadwal['tanggal']) ?> &middot;
      <strong>Soal:</strong> <?= e($jadwal['soal_judul'] ?? '-') ?>
    </p>

    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Peserta</th><th>NIM</th><th>Status</th><th>Submit</th>
            <th>Nilai</th><th>Global</th><th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($peserta as $p): ?>
          <tr>
            <td class="fw-semibold"><?= e($p['nama_lengkap']) ?></td>
            <td><?= e($p['identitas'] ?? '-') ?></td>
            <td><span class="badge bg-<?= status_color($p['status']) ?>"><?= $p['status'] ?></span></td>
            <td><?= fmt_tgl($p['waktu_submit'], 'd-m H:i') ?></td>
            <td><?= $p['nilai_akhir'] !== null ? number_format($p['nilai_akhir'], 1) : '-' ?></td>
            <td><?= e($p['global'] ?? '-') ?></td>
            <td class="text-nowrap">
              <a class="btn btn-sm btn-primary" href="<?= site_url('penguji/nilai/'.$p['id']) ?>">
                <i class="bi bi-pencil-square"></i> Nilai
              </a>
              <?php if ($p['status'] === 'selesai'): ?>
                <a class="btn btn-sm btn-outline-secondary" href="<?= site_url('penguji/pdf_hasil/'.$p['id']) ?>" target="_blank">
                  <i class="bi bi-file-earmark-pdf"></i> Hasil
                </a>
                <a class="btn btn-sm btn-outline-secondary" href="<?= site_url('penguji/pdf_rubrik/'.$p['id']) ?>" target="_blank">
                  <i class="bi bi-file-earmark-pdf"></i> Rubrik
                </a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
        <?php if (empty($peserta)): ?>
          <tr><td colspan="7" class="text-center text-muted py-4">Belum ada peserta.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
