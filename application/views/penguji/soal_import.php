<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 text-primary mb-0">Import Soal dari CSV</h1>
  <a href="<?= site_url('penguji/soal') ?>" class="btn btn-link">&larr; Kembali</a>
</div>

<div class="card">
  <div class="card-body">
    <p>Format CSV (UTF-8) dengan header baris pertama:
       <code>judul, kunci_kode, dokumen_kasus</code>.
       Kolom dokumen_kasus boleh multi-baris (apit dengan tanda kutip ganda).</p>

    <form method="post" enctype="multipart/form-data" action="<?= site_url('penguji/soal_import') ?>">
      <div class="mb-3">
        <label class="form-label">File CSV</label>
        <input type="file" name="file" accept=".csv,text/csv" class="form-control" required>
      </div>
      <button class="btn btn-primary" type="submit">
        <i class="bi bi-upload"></i> Import
      </button>
    </form>
  </div>
</div>
