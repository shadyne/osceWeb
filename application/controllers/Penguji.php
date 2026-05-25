<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penguji extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_login('penguji');
        $this->load->model(['Soal_model', 'Jadwal_model', 'User_model',
                            'Rubrik_model', 'Jawaban_model']);
    }

    public function index()
    {
        redirect('penguji/dashboard');
    }

    public function dashboard()
    {
        $pid = $this->user()['id'];
        $jadwal = $this->Jadwal_model->all($pid);

        $this->view('penguji/dashboard', [
            'total_soal'   => count($this->Soal_model->all($pid)),
            'total_jadwal' => count($jadwal),
            'jadwal'       => array_slice($jadwal, 0, 5),
        ]);
    }

    public function soal()
    {
        $this->view('penguji/soal_index', [
            'soal' => $this->Soal_model->all($this->user()['id']),
        ]);
    }

    public function soal_form($id = null)
    {
        $this->view('penguji/soal_form', [
            'soal' => $id ? $this->Soal_model->find($id) : null,
        ]);
    }

    public function soal_save()
    {
        $id = $this->input->post('id');
        $kasus = $this->input->post('dokumen_kasus');
        $data = [
            'penguji_id'    => $this->user()['id'],
            'judul'         => $this->generate_judul($kasus),
            'dokumen_kasus' => $kasus,
            'kunci_kode'    => trim((string) $this->input->post('kunci_kode')),
        ];

        if (!empty($_FILES['lampiran']['name'])) {
            $path = $this->upload_lampiran('lampiran');
            if ($path) $data['lampiran'] = $path;
        }

        if ($id) {
            $this->Soal_model->update($id, $data);
            $this->flash_ok('Soal diperbarui.');
        } else {
            $this->Soal_model->create($data);
            $this->flash_ok('Soal ditambahkan.');
        }
        redirect('penguji/soal');
    }

    public function soal_delete($id)
    {
        $this->Soal_model->delete($id);
        $this->flash_ok('Soal dihapus.');
        redirect('penguji/soal');
    }

    public function soal_import()
    {
        if ($this->input->method() !== 'post') {
            return $this->view('penguji/soal_import');
        }

        if (empty($_FILES['file']['tmp_name'])) {
            $this->flash_err('Pilih file CSV terlebih dahulu.');
            redirect('penguji/soal_import');
        }

        $count = 0;
        $h = fopen($_FILES['file']['tmp_name'], 'r');
        $first = true;
        while ($h && ($row = fgetcsv($h, 0, ',')) !== false) {
            if ($first) {
                $first = false;
                if (strtolower(trim($row[0] ?? '')) === 'dokumen_kasus') continue;
            }
            $kasus = trim($row[0] ?? '');
            if ($kasus === '') continue;

            $this->Soal_model->create([
                'penguji_id'    => $this->user()['id'],
                'judul'         => $this->generate_judul($kasus),
                'dokumen_kasus' => $kasus,
                'kunci_kode'    => trim($row[1] ?? ''),
            ]);
            $count++;
        }
        if ($h) fclose($h);

        $this->flash_ok("$count soal berhasil diimport.");
        redirect('penguji/soal');
    }

    public function jadwal()
    {
        $this->view('penguji/jadwal_index', [
            'jadwal' => $this->Jadwal_model->all($this->user()['id']),
        ]);
    }

    public function jadwal_form($id = null)
    {
        $jadwal = $id ? $this->Jadwal_model->find($id) : null;
        $assigned = $id ? array_column($this->Jadwal_model->peserta_of($id), 'peserta_id') : [];

        $this->view('penguji/jadwal_form', [
            'jadwal'    => $jadwal,
            'soal_list' => $this->Soal_model->all($this->user()['id']),
            'peserta'   => $this->User_model->by_role('peserta'),
            'assigned'  => $assigned,
        ]);
    }

    public function jadwal_save()
    {
        $id = $this->input->post('id');
        $data = [
            'nama_sesi'     => trim($this->input->post('nama_sesi', true)),
            'soal_id'       => (int) $this->input->post('soal_id'),
            'penguji_id'    => $this->user()['id'],
            'tanggal'       => $this->input->post('tanggal'),
            'waktu_mulai'   => $this->input->post('waktu_mulai'),
            'waktu_selesai' => $this->input->post('waktu_selesai'),
            'durasi_menit'  => (int) $this->input->post('durasi_menit') ?: 60,
            'status'        => $this->input->post('status') ?: 'draft',
        ];
        $peserta_ids = (array) $this->input->post('peserta_ids');

        if ($id) {
            $this->Jadwal_model->update($id, $data);
        } else {
            $id = $this->Jadwal_model->create($data);
        }
        if ($peserta_ids) {
            $this->Jadwal_model->assign_peserta($id, $peserta_ids);
        }

        $this->flash_ok('Jadwal disimpan.');
        redirect('penguji/jadwal');
    }

    public function jadwal_delete($id)
    {
        $this->Jadwal_model->delete($id);
        $this->flash_ok('Jadwal dihapus.');
        redirect('penguji/jadwal');
    }

    public function hasil($jadwal_id = null)
    {
        if (!$jadwal_id) {
            return $this->view('penguji/hasil_pick', [
                'jadwal' => $this->Jadwal_model->all($this->user()['id']),
            ]);
        }

        $peserta = $this->Jadwal_model->peserta_of($jadwal_id);
        foreach ($peserta as &$p) {
            $r = $this->Rubrik_model->find_penilaian($p['id']);
            $p['nilai_akhir'] = $r ? $this->Rubrik_model->compute_nilai_akhir($r) : null;
            $p['global']      = $r['global'] ?? null;
        }

        $this->view('penguji/hasil_index', [
            'jadwal'  => $this->Jadwal_model->find($jadwal_id),
            'peserta' => $peserta,
        ]);
    }

    public function nilai($jp_id)
    {
        $session = $this->Jadwal_model->find_peserta_session($jp_id);
        if (!$session) show_404();

        $this->view('penguji/nilai_form', [
            'session'   => $session,
            'jawaban'   => $this->Jawaban_model->find_by_jp($jp_id),
            'komponen'  => $this->Rubrik_model->komponen(),
            'penilaian' => $this->Rubrik_model->find_penilaian($jp_id),
            'mahasiswa' => $this->User_model->find($session['peserta_id']),
        ]);
    }

    public function nilai_save($jp_id)
    {
        $session = $this->Jadwal_model->find_peserta_session($jp_id);
        if (!$session) show_404();
        $mhs = $this->User_model->find($session['peserta_id']);

        $this->Rubrik_model->save_penilaian($jp_id, [
            'id_mahasiswa'      => $mhs['id'],
            'nama'              => $mhs['nama_lengkap'],
            'tanggal_penilaian' => date('Y-m-d'),
            'kompetensi1'       => (int) $this->input->post('kompetensi1'),
            'kompetensi2'       => (int) $this->input->post('kompetensi2'),
            'kompetensi3'       => (int) $this->input->post('kompetensi3'),
            'global'            => $this->input->post('global') ?: null,
            'catatan_penguji'   => $this->input->post('catatan_penguji'),
            'dinilai_oleh'      => $this->user()['id'],
            'dinilai_at'        => date('Y-m-d H:i:s'),
        ]);

        $this->flash_ok('Penilaian disimpan.');
        redirect('penguji/nilai/' . $jp_id);
    }

    public function peserta()
    {
        $this->view('penguji/peserta_index', [
            'peserta' => $this->User_model->by_role('peserta'),
        ]);
    }

    public function peserta_form($id = null)
    {
        $this->view('penguji/peserta_form', [
            'peserta' => $id ? $this->User_model->find($id) : null,
        ]);
    }

    public function peserta_save()
    {
        $id       = $this->input->post('id');
        $username = trim($this->input->post('username', true));
        $password = (string) $this->input->post('password');

        if ($this->User_model->username_exists($username, $id ?: null)) {
            $this->flash_err("Username '$username' sudah dipakai.");
            redirect($id ? 'penguji/peserta_form/' . $id : 'penguji/peserta_form');
        }

        $data = [
            'username'     => $username,
            'nama_lengkap' => trim($this->input->post('nama_lengkap', true)),
            'email'        => trim($this->input->post('email', true)) ?: null,
            'identitas'    => trim($this->input->post('identitas', true)) ?: null,
            'role'         => 'peserta',
            'is_active'    => $this->input->post('is_active') ? 1 : 0,
        ];
        if ($password !== '') $data['password'] = $password;

        if ($id) {
            $this->User_model->update($id, $data);
            $this->flash_ok('Akun peserta diperbarui.');
        } else {
            if ($password === '') {
                $this->flash_err('Password wajib diisi untuk akun baru.');
                redirect('penguji/peserta_form');
            }
            $this->User_model->create($data);
            $this->flash_ok('Akun peserta dibuat.');
        }
        redirect('penguji/peserta');
    }

    public function peserta_delete($id)
    {
        $this->User_model->delete($id);
        $this->flash_ok('Akun peserta dihapus.');
        redirect('penguji/peserta');
    }

    public function rubrik()
    {
        $this->view('penguji/rubrik_index', [
            'komponen' => $this->Rubrik_model->komponen(),
        ]);
    }

    public function rubrik_save()
    {
        foreach ((array) $this->input->post('komponen') as $id => $r) {
            $this->Rubrik_model->update_komponen((int) $id, [
                'komponen'    => $r['komponen']    ?? '',
                'bobot'       => $r['bobot']       ?? 1,
                'desk_skor_0' => $r['desk_skor_0'] ?? '',
                'desk_skor_1' => $r['desk_skor_1'] ?? '',
                'desk_skor_2' => $r['desk_skor_2'] ?? '',
                'desk_skor_3' => $r['desk_skor_3'] ?? '',
            ]);
        }
        $this->flash_ok('Rubrik diperbarui.');
        redirect('penguji/rubrik');
    }

    public function pdf_hasil($jp_id)  { $this->pdf_view($jp_id, 'penguji/pdf_hasil'); }
    public function pdf_rubrik($jp_id) { $this->pdf_view($jp_id, 'penguji/pdf_rubrik'); }

    private function pdf_view($jp_id, $view)
    {
        $session = $this->Jadwal_model->find_peserta_session($jp_id);
        if (!$session) show_404();

        $penilaian = $this->Rubrik_model->find_penilaian($jp_id);

        $this->load->view($view, [
            'session'     => $session,
            'mahasiswa'   => $this->User_model->find($session['peserta_id']),
            'jawaban'     => $this->Jawaban_model->find_by_jp($jp_id),
            'komponen'    => $this->Rubrik_model->komponen(),
            'penilaian'   => $penilaian,
            'nilai_akhir' => $penilaian ? $this->Rubrik_model->compute_nilai_akhir($penilaian) : null,
            'penguji'     => $this->User_model->find($session['penguji_id'] ?? 0),
        ]);
    }

    private function generate_judul($kasus)
    {
        $first = strtok(trim((string) $kasus), "\n");
        $first = trim((string) $first);
        if ($first === '') return 'Soal tanpa judul';
        return mb_strlen($first) > 80 ? mb_substr($first, 0, 77) . '...' : $first;
    }

    private function upload_lampiran($field)
    {
        $dir = FCPATH . 'uploads/soal/';
        if (!is_dir($dir)) @mkdir($dir, 0777, true);

        $ext  = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
        $name = 'soal_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;

        if (move_uploaded_file($_FILES[$field]['tmp_name'], $dir . $name)) {
            return 'uploads/soal/' . $name;
        }
        return null;
    }

    private function flash_ok($msg)  { $this->session->set_flashdata('success', $msg); }
    private function flash_err($msg) { $this->session->set_flashdata('error', $msg); }
}
