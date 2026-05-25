<div class="box box-primary">
    <div class="box-header with-border"><h3 class="box-title">Daftar Ujian Saya</h3></div>
    <div class="box-body">
        <?php if (empty($jadwal)): ?>
            <em class="text-muted">Belum ada jadwal ujian yang diberikan.</em>
        <?php else: ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Sesi</th><th>Soal</th><th>Tanggal</th><th>Waktu</th>
                        <th>Status Jadwal</th><th>Status Anda</th><th width="120"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($jadwal as $j): ?>
                    <tr>
                        <td><strong><?= e($j['nama_sesi']) ?></strong></td>
                        <td><?= e($j['soal_judul'] ?? '-') ?></td>
                        <td><?= fmt_tgl($j['tanggal']) ?></td>
                        <td><?= fmt_tgl($j['waktu_mulai'], 'H:i') ?> &ndash; <?= fmt_tgl($j['waktu_selesai'], 'H:i') ?></td>
                        <td><span class="label label-<?= status_color($j['status']) ?>"><?= $j['status'] ?></span></td>
                        <td><span class="label label-<?= status_color($j['jp_status']) ?>"><?= $j['jp_status'] ?></span></td>
                        <td>
                            <?php if ($j['jp_status'] === 'selesai'): ?>
                                <span class="text-muted">Selesai</span>
                            <?php else: ?>
                                <a class="btn btn-sm btn-primary" href="<?= site_url('peserta/ujian/'.$j['jp_id']) ?>">
                                    <i class="fa fa-play"></i> Kerjakan
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
