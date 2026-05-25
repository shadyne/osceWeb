<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_login('peserta');
        $this->load->model(['Jadwal_model', 'Jawaban_model']);
    }

    public function index()
    {
        redirect('peserta/dashboard');
    }

    public function dashboard()
    {
        $this->view('peserta/dashboard', [
            'jadwal' => $this->Jadwal_model->jadwal_for_peserta($this->user()['id']),
        ]);
    }

    public function ujian($jp_id)
    {
        $jp_id   = (int) $jp_id;
        $session = $this->Jadwal_model->find_peserta_session($jp_id, $this->user()['id']);
        if (!$session) show_404();

        if ($session['status'] === 'selesai') {
            return $this->view('peserta/ujian_finished', [
                'session' => $session,
                'jawaban' => $this->Jawaban_model->find_by_jp($jp_id),
            ]);
        }

        if ($session['jadwal_status'] !== 'aktif') {
            return $this->view('peserta/ujian_unavailable', [
                'session' => $session,
                'message' => 'Ujian belum diaktifkan oleh penguji.',
            ]);
        }

        $start = !empty($session['waktu_mulai'])   ? strtotime($session['waktu_mulai'])   : null;
        $end   = !empty($session['waktu_selesai']) ? strtotime($session['waktu_selesai']) : null;

        if (!$start || !$end) {
            return $this->view('peserta/ujian_unavailable', [
                'session' => $session,
                'message' => 'Jadwal belum lengkap (waktu mulai/selesai kosong). Hubungi penguji.',
            ]);
        }

        $now = time();

        if ($now < $start) {
            return $this->view('peserta/ujian_unavailable', [
                'session' => $session,
                'message' => 'Ujian belum dimulai. Mulai pada ' . date('d-m-Y H:i', $start) . '.',
            ]);
        }

        if ($now > $end) {
            return $this->view('peserta/ujian_unavailable', [
                'session' => $session,
                'message' => 'Ujian telah berakhir pada ' . date('d-m-Y H:i', $end)
                           . '. Anda tidak sempat menyelesaikan jawaban.',
            ]);
        }

        if ($session['status'] === 'belum') {
            $this->Jadwal_model->start_session($jp_id);
        }

        $this->view('peserta/ujian_form', [
            'session'    => $session,
            'jawaban'    => $this->Jawaban_model->find_by_jp($jp_id),
            'sisa_detik' => max(0, $end - $now),
        ]);
    }

    public function submit($jp_id)
    {
        $jp_id   = (int) $jp_id;
        $session = $this->Jadwal_model->find_peserta_session($jp_id, $this->user()['id']);
        if (!$session) show_404();

        if ($session['status'] === 'selesai') {
            $this->session->set_flashdata('error', 'Ujian sudah disubmit sebelumnya.');
            redirect('peserta');
        }

        $kode    = trim((string) $this->input->post('kode_diagnosa'));
        $catatan = trim((string) $this->input->post('catatan_peserta'));

        $this->Jawaban_model->save($jp_id, $kode, $catatan);
        $this->Jadwal_model->finish_session($jp_id);

        $this->session->set_flashdata('success', 'Jawaban berhasil disubmit.');
        redirect('peserta');
    }
}
