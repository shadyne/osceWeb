<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Daftar Soal</h3>
        <div class="box-tools pull-right">
            <a class="btn btn-default btn-sm" href="<?= site_url('penguji/soal_import') ?>">
                <i class="fa fa-upload"></i> Import
            </a>
            <a class="btn btn-primary btn-sm" href="<?= site_url('penguji/soal_form') ?>">
                <i class="fa fa-plus"></i> Soal Baru
            </a>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-hover datatable">
            <thead>
                <tr><th>Judul</th><th>Kunci Kode</th><th>Dibuat</th><th width="120">Aksi</th></tr>
            </thead>
            <tbody>
            <?php foreach ($soal as $s): ?>
                <tr>
                    <td><strong><?= e($s['judul']) ?></strong></td>
                    <td><?= e(mb_strimwidth($s['kunci_kode'] ?? '-', 0, 60, '...')) ?></td>
                    <td><?= fmt_tgl($s['created_at']) ?></td>
                    <td>
                        <a class="btn btn-xs btn-info" href="<?= site_url('penguji/soal_form/'.$s['id']) ?>">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-xs btn-danger" href="<?= site_url('penguji/soal_delete/'.$s['id']) ?>"
                           onclick="return confirm('Hapus soal?')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
