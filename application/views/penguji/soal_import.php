<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Import Soal</h3>
        <div class="box-tools pull-right">
            <a class="btn btn-default btn-sm" href="<?= site_url('penguji/soal') ?>">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <form method="post" enctype="multipart/form-data" action="<?= site_url('penguji/soal_import') ?>">
        <div class="box-body">
            <p>Format yang didukung:</p>
            <ul>
                <li><strong>.docx</strong> &mdash; 1 file = 1 soal. Seluruh teks dipakai sebagai dokumen kasus.</li>
                <li><strong>.txt</strong> &mdash; 1 file = 1 soal (teks polos).</li>
                <li><strong>.csv</strong> &mdash; banyak soal sekaligus. Header: <code>dokumen_kasus, kunci_kode</code>.</li>
            </ul>
            <p class="text-muted">Judul soal dibuat otomatis dari baris pertama dokumen kasus.</p>

            <div class="form-group">
                <label>File</label>
                <input type="file" name="file" accept=".docx,.txt,.csv" class="form-control" required>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-upload"></i> Import</button>
        </div>
    </form>
</div>
