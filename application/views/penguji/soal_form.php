<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 text-primary mb-0"><?= $soal ? 'Edit Soal' : 'Soal Baru' ?></h1>
  <a href="<?= site_url('penguji/soal') ?>" class="btn btn-link">&larr; Kembali</a>
</div>

<form method="post" action="<?= site_url('penguji/soal_save') ?>" enctype="multipart/form-data" class="card">
  <div class="card-body">
    <?php if ($soal): ?><input type="hidden" name="id" value="<?= $soal['id'] ?>"><?php endif; ?>

    <div class="mb-3">
      <label class="form-label">Dokumen Kasus &amp; Pertanyaan</label>
      <textarea name="dokumen_kasus" class="form-control" rows="14" required><?= e($soal['dokumen_kasus'] ?? '') ?></textarea>
      <div class="form-text">Tulis kasus + pertanyaan sub-poin (1, 2, 3, ...). Peserta akan menjawab semuanya dalam satu kotak essai.</div>
    </div>

    <div class="mb-3">
      <label class="form-label">Kunci Jawaban (untuk referensi penguji)</label>
      <textarea name="kunci_kode" class="form-control" rows="8"><?= e($soal['kunci_kode'] ?? '') ?></textarea>
      <div class="form-text">Tidak ditampilkan ke peserta &mdash; hanya muncul di halaman penilaian / PDF hasil.</div>
    </div>

    <div class="mb-3">
      <label class="form-label">Lampiran File (opsional)</label>
      <input type="file" name="lampiran" class="form-control">
      <?php if (!empty($soal['lampiran'])): ?>
        <div class="form-text">
          <a href="<?= base_url($soal['lampiran']) ?>" target="_blank">Lihat lampiran saat ini</a>
        </div>
      <?php endif; ?>
    </div>

    <div class="d-flex gap-2">
      <button class="btn btn-primary" type="submit">Simpan</button>
      <a class="btn btn-outline-secondary" href="<?= site_url('penguji/soal') ?>">Batal</a>
    </div>
  </div>
</form>
