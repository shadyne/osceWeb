<h1 class="h3 text-primary mb-3">Daftar Ujian Saya</h1>

<?php if (empty($jadwal)): ?>
  <div class="card"><div class="card-body text-muted">
    <em>Belum ada jadwal ujian yang diberikan.</em>
  </div></div>
<?php else: ?>
<div class="card">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>Sesi</th><th>Soal</th><th>Tanggal</th><th>Waktu</th>
          <th>Status Jadwal</th><th>Status Anda</th><th></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($jadwal as $j): ?>
        <tr>
          <td class="fw-semibold"><?= e($j['nama_sesi']) ?></td>
          <td><?= e($j['soal_judul'] ?? '-') ?></td>
          <td><?= fmt_tgl($j['tanggal']) ?></td>
          <td><?= fmt_tgl($j['waktu_mulai'], 'H:i') ?> &ndash; <?= fmt_tgl($j['waktu_selesai'], 'H:i') ?></td>
          <td><span class="badge bg-<?= status_color($j['status']) ?>"><?= $j['status'] ?></span></td>
          <td><span class="badge bg-<?= status_color($j['jp_status']) ?>"><?= $j['jp_status'] ?></span></td>
          <td>
            <?php if ($j['jp_status'] === 'selesai'): ?>
              <span class="text-muted">Selesai <?= fmt_tgl($j['waktu_submit'], 'd-m H:i') ?></span>
            <?php else: ?>
              <a class="btn btn-sm btn-primary" href="<?= site_url('peserta/ujian/'.$j['jp_id']) ?>">
                <i class="bi bi-play-fill"></i> Kerjakan
              </a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>
