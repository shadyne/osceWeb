<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 text-primary mb-0">Jadwal Ujian</h1>
  <a class="btn btn-primary" href="<?= site_url('penguji/jadwal_form') ?>">
    <i class="bi bi-plus-lg"></i> Jadwal Baru
  </a>
</div>

<div class="card">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>Sesi</th><th>Soal</th><th>Tanggal</th><th>Waktu</th>
          <th>Durasi</th><th>Status</th><th></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($jadwal as $j): ?>
        <tr>
          <td class="fw-semibold"><?= e($j['nama_sesi']) ?></td>
          <td><?= e($j['soal_judul'] ?? '-') ?></td>
          <td><?= fmt_tgl($j['tanggal']) ?></td>
          <td><?= fmt_tgl($j['waktu_mulai'], 'H:i') ?> &ndash; <?= fmt_tgl($j['waktu_selesai'], 'H:i') ?></td>
          <td><?= $j['durasi_menit'] ?> mnt</td>
          <td><span class="badge bg-<?= status_color($j['status']) ?>"><?= $j['status'] ?></span></td>
          <td class="text-nowrap">
            <a class="btn btn-sm btn-outline-primary" href="<?= site_url('penguji/jadwal_form/'.$j['id']) ?>">
              <i class="bi bi-pencil"></i>
            </a>
            <a class="btn btn-sm btn-outline-secondary" href="<?= site_url('penguji/hasil/'.$j['id']) ?>">
              <i class="bi bi-clipboard-data"></i>
            </a>
            <a class="btn btn-sm btn-outline-danger" href="<?= site_url('penguji/jadwal_delete/'.$j['id']) ?>"
               onclick="return confirm('Hapus jadwal?')">
              <i class="bi bi-trash"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($jadwal)): ?>
        <tr><td colspan="7" class="text-center text-muted py-4">Belum ada jadwal.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
