<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $soal ? 'Edit Soal' : 'Soal Baru' ?></h3>
        <div class="box-tools pull-right">
            <a class="btn btn-default btn-sm" href="<?= site_url('penguji/soal') ?>">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <form method="post" action="<?= site_url('penguji/soal_save') ?>" enctype="multipart/form-data">
        <div class="box-body">
            <?php if ($soal): ?><input type="hidden" name="id" value="<?= $soal['id'] ?>"><?php endif; ?>

            <div class="form-group">
                <label>Dokumen Kasus &amp; Pertanyaan</label>
                <textarea name="dokumen_kasus" class="form-control" rows="14" required><?= e($soal['dokumen_kasus'] ?? '') ?></textarea>
                <p class="help-block">Judul soal akan otomatis dibuat dari baris pertama dokumen kasus.</p>
            </div>

            <div class="form-group">
                <label>Kunci Jawaban (referensi penguji)</label>
                <textarea name="kunci_kode" class="form-control" rows="8"><?= e($soal['kunci_kode'] ?? '') ?></textarea>
                <p class="help-block">Tidak ditampilkan ke peserta &mdash; hanya muncul saat penilaian dan PDF.</p>
            </div>

            <div class="form-group">
                <label>Lampiran File (opsional)</label>
                <input type="file" name="lampiran" class="form-control">
                <?php if (!empty($soal['lampiran'])): ?>
                    <p class="help-block">
                        <a href="<?= base_url($soal['lampiran']) ?>" target="_blank">Lihat lampiran saat ini</a>
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <div class="box-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
            <a class="btn btn-default" href="<?= site_url('penguji/soal') ?>">Batal</a>
        </div>
    </form>
</div>
