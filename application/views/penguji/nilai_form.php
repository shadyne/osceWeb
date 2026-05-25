<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 text-primary mb-0">Penilaian Peserta</h1>
  <a href="<?= site_url('penguji/hasil/'.$session['jadwal_id']) ?>" class="btn btn-link">&larr; Daftar Peserta</a>
</div>

<div class="card mb-3">
  <div class="card-body">
    <strong>Sesi:</strong> <?= e($session['nama_sesi']) ?> &middot;
    <strong>Soal:</strong> <?= e($session['soal_judul'] ?? '-') ?> &middot;
    <strong>Mahasiswa:</strong> <?= e($mahasiswa['nama_lengkap']) ?>
    (<?= e($mahasiswa['identitas'] ?? '-') ?>)
  </div>
</div>

<div class="card mb-3">
  <div class="card-body">
    <h5 class="card-title text-primary">Jawaban Peserta</h5>
    <?php if ($jawaban): ?>
      <div class="dokumen-kasus"><?= e($jawaban['kode_diagnosa']) ?></div>
      <small class="text-muted">Disubmit: <?= fmt_tgl($jawaban['submitted_at'], 'd-m-Y H:i') ?></small>
    <?php else: ?>
      <em class="text-muted">Peserta belum mengumpulkan jawaban.</em>
    <?php endif; ?>

    <?php if (!empty($session['kunci_kode'])): ?>
      <details class="mt-3">
        <summary class="text-primary" style="cursor:pointer;">Lihat Kunci Jawaban</summary>
        <div class="dokumen-kasus mt-2"><?= e($session['kunci_kode']) ?></div>
      </details>
    <?php endif; ?>
  </div>
</div>

<form method="post" action="<?= site_url('penguji/nilai_save/'.$session['id']) ?>" class="card">
  <div class="card-body">
    <h5 class="card-title text-primary">Rubrik Penilaian</h5>
    <div class="table-responsive">
      <table class="table table-bordered rubrik-table align-middle">
        <thead class="table-light">
          <tr>
            <th style="width:30px">No</th>
            <th style="width:180px">Kompetensi</th>
            <th class="desk">Skor 0</th>
            <th class="desk">Skor 1</th>
            <th class="desk">Skor 2</th>
            <th class="desk">Skor 3</th>
            <th style="width:140px">Skor Peserta</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($komponen as $i => $k):
            $field = 'kompetensi' . ($i + 1);
            $cur   = $penilaian[$field] ?? '';
        ?>
          <tr>
            <td><?= $k['nomor'] ?></td>
            <td class="fw-semibold"><?= e($k['komponen']) ?></td>
            <td class="desk"><?= e($k['desk_skor_0']) ?></td>
            <td class="desk"><?= e($k['desk_skor_1']) ?></td>
            <td class="desk"><?= e($k['desk_skor_2']) ?></td>
            <td class="desk"><?= e($k['desk_skor_3']) ?></td>
            <td>
              <?php for ($s = 0; $s <= 3; $s++): ?>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"
                         name="<?= $field ?>" id="<?= $field ?>_<?= $s ?>" value="<?= $s ?>"
                         <?= ((string) $cur === (string) $s) ? 'checked' : '' ?>>
                  <label class="form-check-label" for="<?= $field ?>_<?= $s ?>"><?= $s ?></label>
                </div>
              <?php endfor; ?>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <h5 class="card-title text-primary mt-4">Global Performance</h5>
    <div class="mb-3">
      <?php $gp = $penilaian['global'] ?? ''; ?>
      <?php foreach (['Tidak Lulus','Borderline','Lulus','Superior'] as $opt): ?>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="global"
                 id="gp_<?= md5($opt) ?>" value="<?= $opt ?>"
                 <?= $gp === $opt ? 'checked' : '' ?>>
          <label class="form-check-label" for="gp_<?= md5($opt) ?>"><?= $opt ?></label>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="mb-3">
      <label class="form-label">Catatan Penguji</label>
      <textarea name="catatan_penguji" class="form-control" rows="3"><?= e($penilaian['catatan_penguji'] ?? '') ?></textarea>
    </div>

    <?php if ($penilaian):
        $total = $penilaian['kompetensi1'] + $penilaian['kompetensi2'] + $penilaian['kompetensi3'];
        $na = round(($total / 9) * 100, 2); ?>
      <div class="alert alert-info">
        Total skor: <strong><?= $total ?> / 9</strong> &middot;
        Nilai akhir: <strong><?= $na ?></strong> &middot;
        Global: <strong><?= e($penilaian['global'] ?? '-') ?></strong>
      </div>
    <?php endif; ?>

    <div class="d-flex gap-2 flex-wrap">
      <button class="btn btn-primary" type="submit">
        <i class="bi bi-check-lg"></i> Simpan Penilaian
      </button>
      <a class="btn btn-outline-secondary" href="<?= site_url('penguji/pdf_hasil/'.$session['id']) ?>" target="_blank">
        <i class="bi bi-file-earmark-pdf"></i> PDF Hasil
      </a>
      <a class="btn btn-outline-secondary" href="<?= site_url('penguji/pdf_rubrik/'.$session['id']) ?>" target="_blank">
        <i class="bi bi-file-earmark-pdf"></i> PDF Rubrik
      </a>
    </div>
  </div>
</form>
