<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 text-primary mb-0"><?= $jadwal ? 'Edit Jadwal' : 'Jadwal Baru' ?></h1>
  <a href="<?= site_url('penguji/jadwal') ?>" class="btn btn-link">&larr; Kembali</a>
</div>

<form method="post" action="<?= site_url('penguji/jadwal_save') ?>" class="card">
  <div class="card-body">
    <?php if ($jadwal): ?><input type="hidden" name="id" value="<?= $jadwal['id'] ?>"><?php endif; ?>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Nama Sesi</label>
        <input type="text" name="nama_sesi" class="form-control" required
               value="<?= e($jadwal['nama_sesi'] ?? '') ?>">
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Soal</label>
        <select name="soal_id" class="form-select" required>
          <option value="">-- pilih soal --</option>
          <?php foreach ($soal_list as $s): ?>
            <option value="<?= $s['id'] ?>"
              <?= (isset($jadwal['soal_id']) && $jadwal['soal_id'] == $s['id']) ? 'selected' : '' ?>>
              <?= e($s['judul']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 mb-3">
        <label class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required
               value="<?= e($jadwal['tanggal'] ?? date('Y-m-d')) ?>">
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-label">Mulai</label>
        <input type="datetime-local" name="waktu_mulai" class="form-control" required
               value="<?= !empty($jadwal['waktu_mulai']) ? date('Y-m-d\TH:i', strtotime($jadwal['waktu_mulai'])) : '' ?>">
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-label">Selesai</label>
        <input type="datetime-local" name="waktu_selesai" class="form-control" required
               value="<?= !empty($jadwal['waktu_selesai']) ? date('Y-m-d\TH:i', strtotime($jadwal['waktu_selesai'])) : '' ?>">
      </div>
      <div class="col-md-2 mb-3">
        <label class="form-label">Durasi (mnt)</label>
        <input type="number" name="durasi_menit" class="form-control" min="1"
               value="<?= $jadwal['durasi_menit'] ?? 60 ?>">
      </div>
      <div class="col-md-1 mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
          <?php foreach (['draft','aktif','selesai'] as $st): ?>
            <option value="<?= $st ?>" <?= (($jadwal['status'] ?? 'draft') === $st) ? 'selected' : '' ?>><?= $st ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Peserta</label>
      <div class="border rounded p-2 bg-white" style="max-height:240px;overflow:auto;">
        <?php foreach ($peserta as $p): ?>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="peserta_ids[]"
                   value="<?= $p['id'] ?>" id="p<?= $p['id'] ?>"
                   <?= in_array($p['id'], $assigned) ? 'checked' : '' ?>>
            <label class="form-check-label" for="p<?= $p['id'] ?>">
              <?= e($p['nama_lengkap']) ?>
              <small class="text-muted">(<?= e($p['identitas'] ?? $p['username']) ?>)</small>
            </label>
          </div>
        <?php endforeach; ?>
        <?php if (empty($peserta)): ?>
          <em class="text-muted">Belum ada akun peserta.</em>
        <?php endif; ?>
      </div>
    </div>

    <div class="d-flex gap-2">
      <button class="btn btn-primary" type="submit">Simpan Jadwal</button>
      <a class="btn btn-outline-secondary" href="<?= site_url('penguji/jadwal') ?>">Batal</a>
    </div>
  </div>
</form>
