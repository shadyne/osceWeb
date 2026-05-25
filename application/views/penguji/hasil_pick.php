<h1 class="h3 text-primary mb-3">Hasil Ujian</h1>

<div class="card">
  <div class="card-body">
    <p class="text-muted">Pilih jadwal untuk melihat hasil peserta.</p>
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr><th>Sesi</th><th>Tanggal</th><th>Status</th><th></th></tr>
        </thead>
        <tbody>
        <?php foreach ($jadwal as $j): ?>
          <tr>
            <td><?= e($j['nama_sesi']) ?></td>
            <td><?= fmt_tgl($j['tanggal']) ?></td>
            <td><span class="badge bg-<?= status_color($j['status']) ?>"><?= $j['status'] ?></span></td>
            <td><a class="btn btn-sm btn-primary" href="<?= site_url('penguji/hasil/'.$j['id']) ?>">Lihat</a></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
