<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $peserta ? 'Edit Peserta' : 'Peserta Baru' ?></h3>
        <div class="box-tools pull-right">
            <a class="btn btn-default btn-sm" href="<?= site_url('penguji/peserta') ?>">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <form method="post" action="<?= site_url('penguji/peserta_save') ?>">
        <div class="box-body">
            <?php if ($peserta): ?><input type="hidden" name="id" value="<?= $peserta['id'] ?>"><?php endif; ?>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required
                           value="<?= e($peserta['nama_lengkap'] ?? '') ?>">
                </div>
                <div class="col-md-6 form-group">
                    <label>NIM</label>
                    <input type="text" name="identitas" class="form-control"
                           value="<?= e($peserta['identitas'] ?? '') ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required autocomplete="off"
                           value="<?= e($peserta['username'] ?? '') ?>">
                </div>
                <div class="col-md-6 form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                           value="<?= e($peserta['email'] ?? '') ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Password
                        <?php if ($peserta): ?><small class="text-muted">(kosongkan jika tidak diubah)</small><?php endif; ?>
                    </label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password"
                           <?= $peserta ? '' : 'required' ?>>
                </div>
                <div class="col-md-6">
                    <label>&nbsp;</label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_active" value="1"
                                   <?= (!$peserta || !empty($peserta['is_active'])) ? 'checked' : '' ?>>
                            Akun Aktif
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
            <a class="btn btn-default" href="<?= site_url('penguji/peserta') ?>">Batal</a>
        </div>
    </form>
</div>
