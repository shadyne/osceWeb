<div class="box box-solid">
    <div class="box-body">
        <strong>Sesi:</strong> <?= e($session['nama_sesi']) ?> &nbsp;|&nbsp;
        <strong>Soal:</strong> <?= e($session['soal_judul'] ?? '-') ?> &nbsp;|&nbsp;
        <strong>Mahasiswa:</strong> <?= e($mahasiswa['nama_lengkap']) ?>
        (<?= e($mahasiswa['identitas'] ?? '-') ?>)
        <a class="btn btn-default btn-xs pull-right" href="<?= site_url('penguji/hasil/'.$session['jadwal_id']) ?>">
            <i class="fa fa-arrow-left"></i> Daftar Peserta
        </a>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border"><h3 class="box-title">Jawaban Peserta</h3></div>
    <div class="box-body">
        <?php if ($jawaban): ?>
            <div class="dokumen-kasus"><?= e($jawaban['kode_diagnosa']) ?></div>
            <p class="help-block">Disubmit: <?= fmt_tgl($jawaban['submitted_at'], 'd-m-Y H:i') ?></p>
        <?php else: ?>
            <em class="text-muted">Peserta belum mengumpulkan jawaban.</em>
        <?php endif; ?>

        <?php if (!empty($session['kunci_kode'])): ?>
            <details class="text-purple" style="margin-top:14px;">
                <summary style="cursor:pointer;font-weight:600;">Lihat Kunci Jawaban</summary>
                <div class="dokumen-kasus" style="margin-top:8px;"><?= e($session['kunci_kode']) ?></div>
            </details>
        <?php endif; ?>
    </div>
</div>

<form method="post" action="<?= site_url('penguji/nilai_save/'.$session['id']) ?>">
    <div class="box box-primary">
        <div class="box-header with-border"><h3 class="box-title">Rubrik Penilaian</h3></div>
        <div class="box-body table-responsive">
            <table class="table table-bordered rubrik-table">
                <thead>
                    <tr>
                        <th width="40">No</th>
                        <th width="180">Kompetensi</th>
                        <th>Skor 0</th>
                        <th>Skor 1</th>
                        <th>Skor 2</th>
                        <th>Skor 3</th>
                        <th width="140">Skor Peserta</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($komponen as $i => $k):
                    $field = 'kompetensi' . ($i + 1);
                    $cur   = $penilaian[$field] ?? '';
                ?>
                    <tr>
                        <td><?= $k['nomor'] ?></td>
                        <td><strong><?= e($k['komponen']) ?></strong></td>
                        <td class="desk"><?= e($k['desk_skor_0']) ?></td>
                        <td class="desk"><?= e($k['desk_skor_1']) ?></td>
                        <td class="desk"><?= e($k['desk_skor_2']) ?></td>
                        <td class="desk"><?= e($k['desk_skor_3']) ?></td>
                        <td>
                            <?php for ($s = 0; $s <= 3; $s++): ?>
                                <label class="radio-inline">
                                    <input type="radio" name="<?= $field ?>" value="<?= $s ?>"
                                           <?= ((string) $cur === (string) $s) ? 'checked' : '' ?>>
                                    <?= $s ?>
                                </label>
                            <?php endfor; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border"><h3 class="box-title">Global Performance</h3></div>
        <div class="box-body">
            <?php $gp = $penilaian['global'] ?? ''; ?>
            <?php foreach (['Tidak Lulus','Borderline','Lulus','Superior'] as $opt): ?>
                <label class="radio-inline">
                    <input type="radio" name="global" value="<?= $opt ?>" <?= $gp === $opt ? 'checked' : '' ?>>
                    <?= $opt ?>
                </label>
            <?php endforeach; ?>

            <div class="form-group" style="margin-top:14px;">
                <label>Catatan Penguji</label>
                <textarea name="catatan_penguji" class="form-control" rows="3"><?= e($penilaian['catatan_penguji'] ?? '') ?></textarea>
            </div>

            <?php if ($penilaian):
                $total = $penilaian['kompetensi1'] + $penilaian['kompetensi2'] + $penilaian['kompetensi3'];
                $na = round(($total / 9) * 100, 2); ?>
                <div class="callout callout-info">
                    Total: <strong><?= $total ?> / 9</strong> &nbsp;|&nbsp;
                    Nilai akhir: <strong><?= $na ?></strong> &nbsp;|&nbsp;
                    Global: <strong><?= e($penilaian['global'] ?? '-') ?></strong>
                </div>
            <?php endif; ?>
        </div>
        <div class="box-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan Penilaian</button>
            <a class="btn btn-default" href="<?= site_url('penguji/pdf_hasil/'.$session['id']) ?>" target="_blank">
                <i class="fa fa-file-pdf-o"></i> PDF Hasil
            </a>
            <a class="btn btn-default" href="<?= site_url('penguji/pdf_rubrik/'.$session['id']) ?>" target="_blank">
                <i class="fa fa-file-pdf-o"></i> PDF Rubrik
            </a>
        </div>
    </div>
</form>
