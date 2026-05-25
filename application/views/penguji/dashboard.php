<div class="row">
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-file-text-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Soal</span>
                <span class="info-box-number"><?= $total_soal ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Jadwal Ujian</span>
                <span class="info-box-number"><?= $total_jadwal ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-graduation-cap"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Stase</span>
                <span class="info-box-number">Koding</span>
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Jadwal Terbaru</h3>
    </div>
    <div class="box-body">
        <?php if (empty($jadwal)): ?>
            <p class="text-muted">Belum ada jadwal.
                <a href="<?= site_url('penguji/jadwal_form') ?>">Buat jadwal</a>.
            </p>
        <?php else: ?>
            <table class="table table-hover">
                <thead><tr><th>Sesi</th><th>Soal</th><th>Tanggal</th><th>Status</th><th></th></tr></thead>
                <tbody>
                <?php foreach ($jadwal as $j): ?>
                    <tr>
                        <td><?= e($j['nama_sesi']) ?></td>
                        <td><?= e($j['soal_judul'] ?? '-') ?></td>
                        <td><?= fmt_tgl($j['tanggal']) ?></td>
                        <td><span class="label label-<?= status_color($j['status']) ?>"><?= $j['status'] ?></span></td>
                        <td><a href="<?= site_url('penguji/hasil/'.$j['id']) ?>">Lihat hasil</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
