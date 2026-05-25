<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 text-primary mb-0"><?= $soal ? 'Edit Soal' : 'Soal Baru' ?></h1>
  <a href="<?= site_url('penguji/soal') ?>" class="btn btn-link">&larr; Kembali</a>
</div>

<form method="post" action="<?= site_url('penguji/soal_save') ?>" enctype="multipart/form-data" class="card">
  <div class="card-body">
    <?php if ($soal): ?><input type="hidden" name="id" value="<?= $soal['id'] ?>"><?php endif; ?>

    <div class="mb-3">
      <label class="form-label">Judul Soal</label>
      <input type="text" name="judul" class="form-control" required
             value="<?= e($soal['judul'] ?? '') ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Dokumen Kasus / Rekam Medis</label>
      <textarea name="dokumen_kasus" class="form-control" rows="12" required><?= e($soal['dokumen_kasus'] ?? '') ?></textarea>
      <div class="form-text">Tulis dokumen RM lengkap; peserta membaca ini saat ujian.</div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Kunci Kode Diagnosa</label>
        <input type="text" name="kunci_kode" class="form-control"
               value="<?= e($soal['kunci_kode'] ?? '') ?>"
               placeholder="contoh: N18.5; Z99.2">
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Lampiran File (opsional)</label>
        <input type="file" name="lampiran" class="form-control">
        <?php if (!empty($soal['lampiran'])): ?>
          <div class="form-text">
            <a href="<?= base_url($soal['lampiran']) ?>" target="_blank">Lihat lampiran saat ini</a>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="d-flex gap-2">
      <button class="btn btn-primary" type="submit">Simpan</button>
      <a class="btn btn-outline-secondary" href="<?= site_url('penguji/soal') ?>">Batal</a>
    </div>
  </div>
</form>
