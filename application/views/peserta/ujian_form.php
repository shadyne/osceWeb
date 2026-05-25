<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title"><?= e($session['nama_sesi']) ?></h3>
        <div class="pull-right">
            <span class="timer" id="timer" data-sisa="<?= (int) $sisa_detik ?>">--:--:--</span>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= e($session['soal_judul'] ?? 'Dokumen Kasus') ?></h3>
    </div>
    <div class="box-body">
        <div class="dokumen-kasus"><?= e($session['dokumen_kasus']) ?></div>
        <?php if (!empty($session['lampiran'])): ?>
            <p style="margin-top:10px;">
                <a class="btn btn-default" href="<?= base_url($session['lampiran']) ?>" target="_blank">
                    <i class="fa fa-paperclip"></i> Lihat Lampiran
                </a>
            </p>
        <?php endif; ?>
    </div>
</div>

<form method="post" action="<?= site_url('peserta/submit/'.$session['id']) ?>" id="jawabanForm">
    <div class="box box-primary">
        <div class="box-header with-border"><h3 class="box-title">Jawaban</h3></div>
        <div class="box-body">
            <textarea name="kode_diagnosa" class="form-control" rows="16" required><?= e($jawaban['kode_diagnosa'] ?? '') ?></textarea>
            <p class="help-block">Jawab seluruh sub-pertanyaan dalam satu kotak ini.</p>
        </div>
        <div class="box-footer">
            <button class="btn btn-primary" type="submit"
                    onclick="return confirm('Submit jawaban? Setelah submit tidak bisa diubah.')">
                <i class="fa fa-check"></i> Submit Jawaban
            </button>
        </div>
    </div>
</form>

<script>
(function () {
    const el = document.getElementById('timer');
    let sisa = parseInt(el.dataset.sisa, 10) || 0;

    function fmt(s) {
        const h = Math.floor(s / 3600);
        const m = Math.floor((s % 3600) / 60);
        const sec = s % 60;
        return String(h).padStart(2, '0') + ':' +
               String(m).padStart(2, '0') + ':' +
               String(sec).padStart(2, '0');
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
