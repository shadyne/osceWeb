<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $u ? 'Edit Pengguna' : 'Tambah Pengguna' ?></h3>
        <div class="box-tools pull-right">
            <a class="btn btn-default btn-sm" href="<?= site_url('penguji/users') ?>">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <form method="post" action="<?= site_url('penguji/users_save') ?>">
        <div class="box-body">
            <?php if ($u): ?><input type="hidden" name="id" value="<?= $u['id'] ?>"><?php endif; ?>

            <div class="row">
                <div class="col-md-8 form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required
                           value="<?= e($u['nama_lengkap'] ?? '') ?>">
                </div>
                <div class="col-md-4 form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <?php $cur = $u['role'] ?? 'peserta'; ?>
                        <option value="peserta" <?= $cur === 'peserta' ? 'selected' : '' ?>>Peserta</option>
                        <option value="penguji" <?= $cur === 'penguji' ? 'selected' : '' ?>>Penguji</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required autocomplete="off"
                           value="<?= e($u['username'] ?? '') ?>">
                </div>
                <div class="col-md-6 form-group">
                    <label>NIM / NIP</label>
                    <input type="text" name="identitas" class="form-control"
                           value="<?= e($u['identitas'] ?? '') ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                           value="<?= e($u['email'] ?? '') ?>">
                </div>
                <div class="col-md-6 form-group">
                    <label>Password
                        <?php if ($u): ?><small class="text-muted">(kosongkan jika tidak diubah)</small><?php endif; ?>
                    </label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password"
                           <?= $u ? '' : 'required' ?>>
                </div>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="is_active" value="1"
                           <?= (!$u || !empty($u['is_active'])) ? 'checked' : '' ?>>
                    Akun Aktif
                </label>
            </div>
        </div>

        <div class="box-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
            <a class="btn btn-default" href="<?= site_url('penguji/users') ?>">Batal</a>
        </div>
    </form>
</div>
