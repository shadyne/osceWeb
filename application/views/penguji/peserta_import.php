<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Import Peserta dari Excel</h3>
        <div class="box-tools pull-right">
            <a class="btn btn-default btn-sm" href="<?= site_url('penguji/peserta') ?>">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <form method="post" enctype="multipart/form-data" action="<?= site_url('penguji/peserta_import') ?>">
        <div class="box-body">
            <p>Format file <strong>.xlsx</strong> dengan header baris pertama:</p>
            <pre>nama_lengkap | nim | username | password | email</pre>
            <ul class="text-muted">
                <li><code>email</code> opsional, boleh dikosongkan.</li>
                <li><code>username</code> harus unik &mdash; row dengan username yang sudah ada akan dilewati.</li>
                <li>Password akan otomatis di-hash bcrypt.</li>
                <li>Format <code>.csv</code> juga didukung dengan urutan kolom yang sama.</li>
            </ul>

            <div class="form-group">
                <label>File</label>
                <input type="file" name="file" accept=".xlsx,.csv" class="form-control" required>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-upload"></i> Import</button>
        </div>
    </form>
</div>
