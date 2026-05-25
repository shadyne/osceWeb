<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Hasil &mdash; <?= e($jadwal['nama_sesi']) ?></h3>
        <div class="box-tools pull-right">
            <a class="btn btn-default btn-sm" href="<?= site_url('penguji/hasil') ?>">
                <i class="fa fa-arrow-left"></i> Daftar Jadwal
            </a>
        </div>
    </div>
    <div class="box-body">
        <p>
            <strong>Tanggal:</strong> <?= fmt_tgl($jadwal['tanggal']) ?> &nbsp;|&nbsp;
            <strong>Soal:</strong> <?= e($jadwal['soal_judul'] ?? '-') ?>
        </p>

        <table class="table table-hover datatable">
            <thead>
                <tr>
                    <th>Peserta</th><th>NIM</th><th>Status</th><th>Submit</th>
                    <th>Nilai</th><th>Global</th><th width="200">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($peserta as $p): ?>
                <tr>
                    <td><strong><?= e($p['nama_lengkap']) ?></strong></td>
                    <td><?= e($p['identitas'] ?? '-') ?></td>
                    <td><span class="label label-<?= status_color($p['status']) ?>"><?= $p['status'] ?></span></td>
                    <td><?= fmt_tgl($p['waktu_submit'], 'd-m H:i') ?></td>
                    <td><?= $p['nilai_akhir'] !== null ? number_format($p['nilai_akhir'], 1) : '-' ?></td>
                    <td><?= e($p['global'] ?? '-') ?></td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="<?= site_url('penguji/nilai/'.$p['id']) ?>">
                            <i class="fa fa-pencil-square-o"></i> Nilai
                        </a>
                        <?php if ($p['status'] === 'selesai'): ?>
                            <a class="btn btn-xs btn-default" href="<?= site_url('penguji/pdf_hasil/'.$p['id']) ?>" target="_blank">
                                <i class="fa fa-file-pdf-o"></i> Hasil
                            </a>
                            <a class="btn btn-xs btn-default" href="<?= site_url('penguji/pdf_rubrik/'.$p['id']) ?>" target="_blank">
                                <i class="fa fa-file-pdf-o"></i> Rubrik
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
