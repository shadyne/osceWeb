<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $jadwal ? 'Edit Jadwal' : 'Jadwal Baru' ?></h3>
        <div class="box-tools pull-right">
            <a class="btn btn-default btn-sm" href="<?= site_url('penguji/jadwal') ?>">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <form method="post" action="<?= site_url('penguji/jadwal_save') ?>">
        <div class="box-body">
            <?php if ($jadwal): ?><input type="hidden" name="id" value="<?= $jadwal['id'] ?>"><?php endif; ?>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Nama Sesi</label>
                    <input type="text" name="nama_sesi" class="form-control" required
                           value="<?= e($jadwal['nama_sesi'] ?? '') ?>">
                </div>
                <div class="col-md-6 form-group">
                    <label>Soal</label>
                    <select name="soal_id" class="form-control select2" required>
                        <option value="">-- pilih soal --</option>
                        <?php foreach ($soal_list as $s): ?>
                            <option value="<?= $s['id'] ?>"
                                <?= (isset($jadwal['soal_id']) && $jadwal['soal_id'] == $s['id']) ? 'selected' : '' ?>>
                                <?= e($s['judul']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required
                           value="<?= e($jadwal['tanggal'] ?? date('Y-m-d')) ?>">
                </div>
                <div class="col-md-3 form-group">
                    <label>Mulai</label>
                    <input type="datetime-local" name="waktu_mulai" class="form-control" required
                           value="<?= !empty($jadwal['waktu_mulai']) ? date('Y-m-d\TH:i', strtotime($jadwal['waktu_mulai'])) : '' ?>">
                </div>
                <div class="col-md-3 form-group">
                    <label>Selesai</label>
                    <input type="datetime-local" name="waktu_selesai" class="form-control" required
                           value="<?= !empty($jadwal['waktu_selesai']) ? date('Y-m-d\TH:i', strtotime($jadwal['waktu_selesai'])) : '' ?>">
                </div>
                <div class="col-md-2 form-group">
                    <label>Durasi (mnt)</label>
                    <input type="number" name="durasi_menit" class="form-control" min="1"
                           value="<?= $jadwal['durasi_menit'] ?? 60 ?>">
                </div>
                <div class="col-md-1 form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <?php foreach (['draft','aktif','selesai'] as $st): ?>
                            <option value="<?= $st ?>" <?= (($jadwal['status'] ?? 'draft') === $st) ? 'selected' : '' ?>><?= $st ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Peserta</label>
                <div class="well well-sm" style="max-height:240px;overflow:auto;">
                    <?php foreach ($peserta as $p): ?>
                        <div class="checkbox" style="margin:4px 0;">
                            <label>
                                <input type="checkbox" name="peserta_ids[]" value="<?= $p['id'] ?>"
                                       <?= in_array($p['id'], $assigned) ? 'checked' : '' ?>>
                                <?= e($p['nama_lengkap']) ?>
                                <small class="text-muted">(<?= e($p['identitas'] ?? $p['username']) ?>)</small>
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($peserta)): ?>
                        <em class="text-muted">Belum ada akun peserta.</em>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="box-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
            <a class="btn btn-default" href="<?= site_url('penguji/jadwal') ?>">Batal</a>
        </div>
    </form>
</div>
