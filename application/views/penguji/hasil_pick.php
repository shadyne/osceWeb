<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Pilih Jadwal</h3>
    </div>
    <div class="box-body">
        <p class="text-muted">Pilih jadwal untuk melihat hasil peserta.</p>
        <table class="table table-hover datatable">
            <thead><tr><th>Sesi</th><th>Tanggal</th><th>Status</th><th width="80">Aksi</th></tr></thead>
            <tbody>
            <?php foreach ($jadwal as $j): ?>
                <tr>
                    <td><?= e($j['nama_sesi']) ?></td>
                    <td><?= fmt_tgl($j['tanggal']) ?></td>
                    <td><span class="label label-<?= status_color($j['status']) ?>"><?= $j['status'] ?></span></td>
                    <td><a class="btn btn-xs btn-primary" href="<?= site_url('penguji/hasil/'.$j['id']) ?>">Lihat</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
