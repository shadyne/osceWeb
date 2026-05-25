<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Akun Peserta</h3>
        <div class="box-tools pull-right">
            <a class="btn btn-default btn-sm" href="<?= site_url('penguji/peserta_import') ?>">
                <i class="fa fa-upload"></i> Import Excel
            </a>
            <a class="btn btn-primary btn-sm" href="<?= site_url('penguji/peserta_form') ?>">
                <i class="fa fa-user-plus"></i> Peserta Baru
            </a>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-hover datatable">
            <thead>
                <tr><th>Nama</th><th>Username</th><th>NIM</th><th>Email</th><th>Status</th><th width="100">Aksi</th></tr>
            </thead>
            <tbody>
            <?php foreach ($peserta as $p): ?>
                <tr>
                    <td><strong><?= e($p['nama_lengkap']) ?></strong></td>
                    <td><?= e($p['username']) ?></td>
                    <td><?= e($p['identitas'] ?? '-') ?></td>
                    <td><?= e($p['email'] ?? '-') ?></td>
                    <td><span class="label label-<?= $p['is_active'] ? 'success' : 'default' ?>">
                            <?= $p['is_active'] ? 'aktif' : 'nonaktif' ?></span></td>
                    <td>
                        <a class="btn btn-xs btn-info" href="<?= site_url('penguji/peserta_form/'.$p['id']) ?>">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-xs btn-danger" href="<?= site_url('penguji/peserta_delete/'.$p['id']) ?>"
                           onclick="return confirm('Hapus akun peserta?')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
