<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url('assets/dist/img/user1.png') ?>" class="img-circle" alt="User">
            </div>
            <div class="pull-left info">
                <p><?= e($user['nama_lengkap'] ?? '-') ?></p>
                <small><?= ucfirst($user['role'] ?? '') ?></small>
            </div>
        </div>

        <?php $page = $this->uri->segment(2); ?>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN MENU</li>
            <li class="<?= $page === 'dashboard' || !$page ? 'active' : '' ?>">
                <a href="<?= site_url($user['role'].'/dashboard') ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <?php if (($user['role'] ?? '') === 'penguji'): ?>
                <li class="header">BANK SOAL</li>
                <li class="<?= strpos((string) $page, 'soal') !== false ? 'active' : '' ?>">
                    <a href="<?= site_url('penguji/soal') ?>">
                        <i class="fa fa-file-text-o"></i> <span>Soal</span>
                    </a>
                </li>

                <li class="header">DATA MASTER</li>
                <li class="treeview <?= strpos((string) $page, 'peserta') !== false ? 'active menu-open' : '' ?>">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>Peserta</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= site_url('penguji/peserta') ?>"><i class="fa fa-circle-o"></i> Daftar Peserta</a></li>
                        <li><a href="<?= site_url('penguji/peserta_form') ?>"><i class="fa fa-circle-o"></i> Tambah Peserta</a></li>
                        <li><a href="<?= site_url('penguji/peserta_import') ?>"><i class="fa fa-circle-o"></i> Import dari Excel</a></li>
                    </ul>
                </li>

                <li class="header">UJIAN</li>
                <li class="<?= strpos((string) $page, 'jadwal') !== false ? 'active' : '' ?>">
                    <a href="<?= site_url('penguji/jadwal') ?>">
                        <i class="fa fa-calendar"></i> <span>Jadwal Ujian</span>
                    </a>
                </li>

                <li class="header">PENILAIAN</li>
                <li class="<?= strpos((string) $page, 'hasil') !== false || strpos((string) $page, 'nilai') !== false ? 'active' : '' ?>">
                    <a href="<?= site_url('penguji/hasil') ?>">
                        <i class="fa fa-file"></i> <span>Hasil Ujian</span>
                    </a>
                </li>
                <li class="<?= $page === 'rubrik' ? 'active' : '' ?>">
                    <a href="<?= site_url('penguji/rubrik') ?>">
                        <i class="fa fa-list-alt"></i> <span>Rubrik</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </section>
</aside>
