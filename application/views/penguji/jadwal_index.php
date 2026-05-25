<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Jadwal Ujian</h3>
        <div class="box-tools pull-right">
            <a class="btn btn-primary btn-sm" href="<?= site_url('penguji/jadwal_form') ?>">
                <i class="fa fa-plus"></i> Jadwal Baru
            </a>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-hover datatable">
            <thead>
                <tr>
                    <th>Sesi</th><th>Soal</th><th>Tanggal</th><th>Waktu</th>
                    <th>Durasi</th><th>Status</th><th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($jadwal as $j): ?>
                <tr>
                    <td><strong><?= e($j['nama_sesi']) ?></strong></td>
                    <td><?= e($j['soal_judul'] ?? '-') ?></td>
                    <td><?= fmt_tgl($j['tanggal']) ?></td>
                    <td><?= fmt_tgl($j['waktu_mulai'], 'H:i') ?> &ndash; <?= fmt_tgl($j['waktu_selesai'], 'H:i') ?></td>
                    <td><?= $j['durasi_menit'] ?> mnt</td>
                    <td><span class="label label-<?= status_color($j['status']) ?>"><?= $j['status'] ?></span></td>
                    <td>
                        <a class="btn btn-xs btn-info" href="<?= site_url('penguji/jadwal_form/'.$j['id']) ?>">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-xs btn-success" href="<?= site_url('penguji/hasil/'.$j['id']) ?>">
                            <i class="fa fa-file"></i>
                        </a>
                        <a class="btn btn-xs btn-danger" href="<?= site_url('penguji/jadwal_delete/'.$j['id']) ?>"
                           onclick="return confirm('Hapus jadwal?')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
