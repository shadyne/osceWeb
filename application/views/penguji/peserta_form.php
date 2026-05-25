<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 text-primary mb-0"><?= $peserta ? 'Edit Peserta' : 'Peserta Baru' ?></h1>
  <a href="<?= site_url('penguji/peserta') ?>" class="btn btn-link">&larr; Kembali</a>
</div>

<form method="post" action="<?= site_url('penguji/peserta_save') ?>" class="card">
  <div class="card-body">
    <?php if ($peserta): ?><input type="hidden" name="id" value="<?= $peserta['id'] ?>"><?php endif; ?>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control" required
               value="<?= e($peserta['nama_lengkap'] ?? '') ?>">
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">NIM</label>
        <input type="text" name="identitas" class="form-control"
               value="<?= e($peserta['identitas'] ?? '') ?>">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required autocomplete="off"
               value="<?= e($peserta['username'] ?? '') ?>">
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control"
               value="<?= e($peserta['email'] ?? '') ?>">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">
          Password
          <?php if ($peserta): ?>
            <small class="text-muted">(kosongkan jika tidak diubah)</small>
          <?php endif; ?>
        </label>
        <input type="password" name="password" class="form-control" autocomplete="new-password"
               <?= $peserta ? '' : 'required' ?>>
      </div>
      <div class="col-md-6 mb-3 d-flex align-items-end">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                 <?= (!$peserta || !empty($peserta['is_active'])) ? 'checked' : '' ?>>
          <label class="form-check-label" for="is_active">Akun Aktif</label>
        </div>
      </div>
    </div>

    <div class="d-flex gap-2">
      <button class="btn btn-primary" type="submit">Simpan</button>
      <a class="btn btn-outline-secondary" href="<?= site_url('penguji/peserta') ?>">Batal</a>
    </div>
  </div>
</form>
