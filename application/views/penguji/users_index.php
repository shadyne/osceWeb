<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Total <?= count($users) ?> pengguna</h3>
        <div class="box-tools pull-right">
            <a class="btn btn-primary btn-sm" href="<?= site_url('penguji/users_form') ?>">
                <i class="fa fa-plus"></i> Tambah Pengguna
            </a>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-hover datatable">
            <thead>
                <tr>
                    <th width="40">No</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>NIM / NIP</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $i => $u): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><strong><?= e($u['username']) ?></strong></td>
                    <td><?= e($u['nama_lengkap']) ?></td>
                    <td><?= e($u['identitas'] ?? '-') ?></td>
                    <td><?= e($u['email'] ?? '-') ?></td>
                    <td>
                        <span class="label label-<?= $u['role'] === 'penguji' ? 'purple' : 'primary' ?>">
                            <?= ucfirst($u['role']) ?>
                        </span>
                    </td>
                    <td>
                        <span class="label label-<?= $u['is_active'] ? 'success' : 'default' ?>">
                            <?= $u['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                        </span>
                    </td>
                    <td>
                        <a class="btn btn-xs btn-info" href="<?= site_url('penguji/users_form/'.$u['id']) ?>">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-xs btn-danger" href="<?= site_url('penguji/users_delete/'.$u['id']) ?>"
                           onclick="return confirm('Hapus pengguna ini? Data terkait ikut terhapus.')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
