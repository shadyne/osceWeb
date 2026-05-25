<h1 class="h3 text-primary mb-4">Dashboard Penguji</h1>

<div class="row g-3 mb-4">
  <div class="col-md-4">
    <div class="card stat-card">
      <div class="card-body">
        <div class="stat-label">Total Soal</div>
        <div class="stat-value"><?= $total_soal ?></div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card stat-card">
      <div class="card-body">
        <div class="stat-label">Total Jadwal Ujian</div>
        <div class="stat-value"><?= $total_jadwal ?></div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card stat-card">
      <div class="card-body">
        <div class="stat-label">Stase</div>
        <div class="stat-value">Koding</div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title text-primary">Jadwal Terbaru</h5>
    <?php if (empty($jadwal)): ?>
      <p class="text-muted mb-0">Belum ada jadwal.
        <a href="<?= site_url('penguji/jadwal_form') ?>">Buat jadwal</a>.
      </p>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead><tr><th>Sesi</th><th>Soal</th><th>Tanggal</th><th>Status</th><th></th></tr></thead>
          <tbody>
          <?php foreach ($jadwal as $j): ?>
            <tr>
              <td><?= htmlspecialchars($j['nama_sesi']) ?></td>
              <td><?= htmlspecialchars($j['soal_judul'] ?? '-') ?></td>
              <td><?= date('d-m-Y', strtotime($j['tanggal'])) ?></td>
              <td><span class="badge bg-<?= status_color($j['status']) ?>"><?= $j['status'] ?></span></td>
              <td><a href="<?= site_url('penguji/hasil/'.$j['id']) ?>">Lihat hasil</a></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</div>
