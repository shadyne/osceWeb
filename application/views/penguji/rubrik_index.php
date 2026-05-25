<h1 class="h3 text-primary mb-3">Master Rubrik Penilaian</h1>

<form method="post" action="<?= site_url('penguji/rubrik_save') ?>" class="card">
  <div class="card-body">
    <p class="text-muted">Edit deskripsi tiap level skor (0-3) per komponen. Bobot dipakai sebagai catatan referensi.</p>

    <?php foreach ($komponen as $k): ?>
      <fieldset class="border rounded p-3 mb-3">
        <legend class="float-none w-auto px-2 fs-6">
          <strong><?= $k['nomor'] ?>.</strong>
          <input type="text" class="form-control d-inline-block" style="width:400px;"
                 name="komponen[<?= $k['id'] ?>][komponen]"
                 value="<?= e($k['komponen']) ?>">
        </legend>

        <div class="mb-3" style="max-width:200px;">
          <label class="form-label">Bobot</label>
          <input type="number" step="0.1" class="form-control"
                 name="komponen[<?= $k['id'] ?>][bobot]" value="<?= $k['bobot'] ?>">
        </div>

        <?php for ($s = 0; $s <= 3; $s++): ?>
          <div class="mb-2">
            <label class="form-label">Deskripsi Skor <?= $s ?></label>
            <textarea class="form-control" rows="3"
                      name="komponen[<?= $k['id'] ?>][desk_skor_<?= $s ?>]"><?= e($k['desk_skor_'.$s] ?? '') ?></textarea>
          </div>
        <?php endfor; ?>
      </fieldset>
    <?php endforeach; ?>

    <button class="btn btn-primary" type="submit">Simpan Rubrik</button>
  </div>
</form>
