<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 text-primary mb-0"><?= e($session['nama_sesi']) ?></h1>
  <div class="timer" id="timer" data-sisa="<?= (int) $sisa_detik ?>">--:--:--</div>
</div>

<div class="card mb-3">
  <div class="card-body">
    <h5 class="card-title text-primary"><?= e($session['soal_judul'] ?? 'Dokumen Kasus') ?></h5>
    <div class="dokumen-kasus"><?= e($session['dokumen_kasus']) ?></div>
    <?php if (!empty($session['lampiran'])): ?>
      <p class="mt-3 mb-0">
        <a class="btn btn-secondary" href="<?= base_url($session['lampiran']) ?>" target="_blank">
          <i class="bi bi-paperclip"></i> Lihat Lampiran
        </a>
      </p>
    <?php endif; ?>
  </div>
</div>

<form method="post" action="<?= site_url('peserta/submit/'.$session['id']) ?>" class="card" id="jawabanForm">
  <div class="card-body">
    <div class="mb-3">
      <label class="form-label fw-semibold">Jawaban</label>
      <textarea name="kode_diagnosa" class="form-control" rows="16" required><?= e($jawaban['kode_diagnosa'] ?? '') ?></textarea>
      <div class="form-text">Jawab seluruh sub-pertanyaan dalam satu kotak ini.</div>
    </div>
    <button class="btn btn-primary" type="submit"
            onclick="return confirm('Submit jawaban? Setelah submit tidak bisa diubah.')">
      <i class="bi bi-check-lg"></i> Submit Jawaban
    </button>
  </div>
</form>

<script>
(function(){
  const el = document.getElementById('timer');
  let sisa = parseInt(el.dataset.sisa, 10) || 0;

  function fmt(s) {
    const h = Math.floor(s / 3600);
    const m = Math.floor((s % 3600) / 60);
    const sec = s % 60;
    return String(h).padStart(2,'0')+':'+String(m).padStart(2,'0')+':'+String(sec).padStart(2,'0');
  }

  function tick() {
    if (sisa <= 0) {
      el.textContent = '00:00:00';
      document.getElementById('jawabanForm').submit();
      return;
    }
    el.textContent = fmt(sisa);
    el.classList.toggle('warn', sisa < 300 && sisa >= 60);
    el.classList.toggle('crit', sisa < 60);
    sisa--;
    setTimeout(tick, 1000);
  }
  tick();
})();
</script>
