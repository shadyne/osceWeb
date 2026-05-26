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

        <?php
        $page = $this->uri->segment(2);
        $role = $user['role'] ?? '';
        ?>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU</li>
            <li class="<?= $page === 'dashboard' || !$page ? 'active' : '' ?>">
                <a href="<?= site_url($role.'/dashboard') ?>">
                    <i class="fa fa-dashboard"></i> <span>Beranda</span>
                </a>
            </li>

            <?php if ($role === 'penguji'): ?>
                <li class="<?= strpos((string) $page, 'soal') !== false ? 'active' : '' ?>">
                    <a href="<?= site_url('penguji/soal') ?>">
                        <i class="fa fa-file-text-o"></i> <span>Bank Soal</span>
                    </a>
                </li>
                <li class="<?= strpos((string) $page, 'jadwal') !== false ? 'active' : '' ?>">
                    <a href="<?= site_url('penguji/jadwal') ?>">
                        <i class="fa fa-calendar"></i> <span>Jadwal Ujian</span>
                    </a>
                </li>
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

                <li class="header">MASTER DATA</li>
                <li class="<?= strpos((string) $page, 'users') !== false ? 'active' : '' ?>">
                    <a href="<?= site_url('penguji/users') ?>">
                        <i class="fa fa-users"></i> <span>Pengguna</span>
                    </a>
                </li>
                <li class="treeview <?= strpos((string) $page, 'peserta') !== false ? 'active menu-open' : '' ?>">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>Peserta</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= site_url('penguji/peserta') ?>"><i class="fa fa-circle-o"></i> Daftar Peserta</a></li>
                        <li><a href="<?= site_url('penguji/peserta_import') ?>"><i class="fa fa-circle-o"></i> Import Excel</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <li class="header">LAINNYA</li>
            <?php if ($role === 'penguji'): ?>
                <li class="<?= $page === 'profile' ? 'active' : '' ?>">
                    <a href="<?= site_url('penguji/profile') ?>">
                        <i class="fa fa-info-circle"></i> <span>Profile</span>
                    </a>
                </li>
            <?php endif; ?>
            <li>
                <a href="<?= site_url('logout') ?>">
                    <i class="fa fa-sign-out text-red"></i> <span>Logout</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
