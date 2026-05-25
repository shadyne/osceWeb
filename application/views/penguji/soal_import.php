<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 text-primary mb-0">Import Soal</h1>
  <a href="<?= site_url('penguji/soal') ?>" class="btn btn-link">&larr; Kembali</a>
</div>

<div class="card">
  <div class="card-body">
    <p>Format yang didukung:</p>
    <ul>
      <li><strong>.docx</strong> &mdash; 1 file = 1 soal. Seluruh teks dokumen dipakai sebagai dokumen kasus.</li>
      <li><strong>.txt</strong> &mdash; 1 file = 1 soal (teks polos).</li>
      <li><strong>.csv</strong> &mdash; banyak soal sekaligus. Header: <code>dokumen_kasus, kunci_kode</code>.
          Kolom multi-baris diapit tanda kutip ganda.</li>
    </ul>
    <p class="text-muted small">Judul soal dibuat otomatis dari baris pertama dokumen kasus.</p>

    <form method="post" enctype="multipart/form-data" action="<?= site_url('penguji/soal_import') ?>">
      <div class="mb-3">
        <label class="form-label">File</label>
        <input type="file" name="file" accept=".docx,.txt,.csv" class="form-control" required>
      </div>
      <button class="btn btn-primary" type="submit">
        <i class="bi bi-upload"></i> Import
      </button>
    </form>
  </div>
</div>
