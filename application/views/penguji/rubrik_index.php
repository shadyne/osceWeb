<form method="post" action="<?= site_url('penguji/rubrik_save') ?>">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Master Rubrik Penilaian</h3>
        </div>
        <div class="box-body">
            <p class="text-muted">Edit deskripsi tiap level skor (0-3) per komponen.</p>

            <?php foreach ($komponen as $k): ?>
                <fieldset style="border:1px solid #ddd;border-radius:4px;padding:14px;margin-bottom:14px;">
                    <legend style="font-size:14px;width:auto;padding:0 8px;border:0;margin:0;">
                        <strong><?= $k['nomor'] ?>.</strong>
                        <input type="text" class="form-control"
                               style="display:inline-block;width:400px;margin-left:6px;"
                               name="komponen[<?= $k['id'] ?>][komponen]"
                               value="<?= e($k['komponen']) ?>">
                    </legend>

                    <div class="form-group" style="max-width:200px;">
                        <label>Bobot</label>
                        <input type="number" step="0.1" class="form-control"
                               name="komponen[<?= $k['id'] ?>][bobot]" value="<?= $k['bobot'] ?>">
                    </div>

                    <?php for ($s = 0; $s <= 3; $s++): ?>
                        <div class="form-group">
                            <label>Deskripsi Skor <?= $s ?></label>
                            <textarea class="form-control" rows="3"
                                      name="komponen[<?= $k['id'] ?>][desk_skor_<?= $s ?>]"><?= e($k['desk_skor_'.$s] ?? '') ?></textarea>
                        </div>
                    <?php endfor; ?>
                </fieldset>
            <?php endforeach; ?>
        </div>
        <div class="box-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan Rubrik</button>
        </div>
    </div>
</form>
