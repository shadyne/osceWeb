DROP DATABASE IF EXISTS osce_rm;
CREATE DATABASE osce_rm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE osce_rm;

CREATE TABLE users (
  id            INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  username      VARCHAR(50)  NOT NULL UNIQUE,
  password      VARCHAR(255) NOT NULL,
  nama_lengkap  VARCHAR(100) NOT NULL,
  email         VARCHAR(100) NULL,
  identitas     VARCHAR(30)  NULL,
  role          ENUM('penguji','peserta') NOT NULL,
  is_active     TINYINT(1)   NOT NULL DEFAULT 1,
  created_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_role (role)
) ENGINE=InnoDB;

CREATE TABLE soal_osce (
  id              INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  penguji_id      INT UNSIGNED NOT NULL,
  judul           VARCHAR(255) NOT NULL,
  dokumen_kasus   LONGTEXT     NOT NULL,
  lampiran        VARCHAR(255) NULL,
  kunci_kode      TEXT         NULL,
  created_at      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (penguji_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE jadwal_ujian (
  id              INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nama_sesi       VARCHAR(100) NOT NULL,
  soal_id         INT UNSIGNED NOT NULL,
  penguji_id      INT UNSIGNED NOT NULL,
  tanggal         DATE         NOT NULL,
  waktu_mulai     DATETIME     NOT NULL,
  waktu_selesai   DATETIME     NOT NULL,
  durasi_menit    INT          NOT NULL DEFAULT 60,
  status          ENUM('draft','aktif','selesai') NOT NULL DEFAULT 'draft',
  created_at      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (soal_id)    REFERENCES soal_osce(id) ON DELETE RESTRICT,
  FOREIGN KEY (penguji_id) REFERENCES users(id)     ON DELETE CASCADE,
  INDEX idx_status (status)
) ENGINE=InnoDB;

CREATE TABLE jadwal_peserta (
  id              INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  jadwal_id       INT UNSIGNED NOT NULL,
  peserta_id      INT UNSIGNED NOT NULL,
  status          ENUM('belum','mengerjakan','selesai') NOT NULL DEFAULT 'belum',
  waktu_mulai     DATETIME     NULL,
  waktu_submit    DATETIME     NULL,
  UNIQUE KEY uk_jadwal_peserta (jadwal_id, peserta_id),
  FOREIGN KEY (jadwal_id)  REFERENCES jadwal_ujian(id) ON DELETE CASCADE,
  FOREIGN KEY (peserta_id) REFERENCES users(id)        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE jawaban_peserta (
  id                  INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  jadwal_peserta_id   INT UNSIGNED NOT NULL UNIQUE,
  kode_diagnosa       TEXT         NOT NULL,
  catatan_peserta     TEXT         NULL,
  submitted_at        DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (jadwal_peserta_id) REFERENCES jadwal_peserta(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE rubrik_komponen (
  id            INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nomor         INT          NOT NULL,
  komponen      VARCHAR(255) NOT NULL,
  bobot         DECIMAL(5,2) NOT NULL DEFAULT 1.00,
  skor_maks     TINYINT      NOT NULL DEFAULT 3,
  desk_skor_0   TEXT         NULL,
  desk_skor_1   TEXT         NULL,
  desk_skor_2   TEXT         NULL,
  desk_skor_3   TEXT         NULL,
  is_active     TINYINT(1)   NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE rubrik_penilaian (
  id_rubrik           INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  id_jadwal_peserta   INT UNSIGNED NULL,
  id_mahasiswa        INT UNSIGNED NOT NULL,
  nama                VARCHAR(128) NOT NULL,
  tanggal_penilaian   DATE         NOT NULL,
  kompetensi1         TINYINT      NOT NULL DEFAULT 0,
  kompetensi2         TINYINT      NOT NULL DEFAULT 0,
  kompetensi3         TINYINT      NOT NULL DEFAULT 0,
  `global`            VARCHAR(128) NULL,
  catatan_penguji     TEXT         NULL,
  dinilai_oleh        INT UNSIGNED NULL,
  dinilai_at          TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uk_jp (id_jadwal_peserta),
  FOREIGN KEY (id_jadwal_peserta) REFERENCES jadwal_peserta(id) ON DELETE CASCADE,
  FOREIGN KEY (id_mahasiswa)      REFERENCES users(id)          ON DELETE CASCADE,
  FOREIGN KEY (dinilai_oleh)      REFERENCES users(id)          ON DELETE SET NULL
) ENGINE=InnoDB;

INSERT INTO users (username, password, nama_lengkap, email, identitas, role) VALUES
('penguji1', '$2y$10$STL85RdRhd6.XBllVWKYI.cyUK4CnYODMBb1xYOMp5FoFV1WpniTu', 'Dr. Penguji Satu', 'penguji1@example.com', 'NIP001', 'penguji'),
('peserta1', '$2y$10$STL85RdRhd6.XBllVWKYI.cyUK4CnYODMBb1xYOMp5FoFV1WpniTu', 'Peserta Satu',     'peserta1@example.com', 'NIM001', 'peserta'),
('peserta2', '$2y$10$STL85RdRhd6.XBllVWKYI.cyUK4CnYODMBb1xYOMp5FoFV1WpniTu', 'Peserta Dua',      'peserta2@example.com', 'NIM002', 'peserta');

INSERT INTO rubrik_komponen (nomor, komponen, bobot, skor_maks, desk_skor_0, desk_skor_1, desk_skor_2, desk_skor_3) VALUES
(1, 'Identifikasi dan pengumpulan data', 1.00, 3,
 'Peserta ujian tidak melakukan atau data yang diidentifikasi/dikumpulkan tidak ada satu pun yang tepat.',
 'Peserta ujian melakukan 1 dari 3 langkah dengan tepat:\n1. Mencatat identitas diri pada lembar jawaban yang disediakan.\n2. Mengidentifikasi semua diagnosis pada rekam medis (discharge summary / resume / ringkasan masuk dan keluar).\n3. Mengidentifikasi semua tindakan medis (penunjang dan/atau operasi) pada rekam medis.\nAtau peserta ujian melakukan semua langkah tetapi sebagian besar kurang tepat.',
 'Peserta ujian melakukan 2 dari 3 langkah dengan tepat (lihat daftar di atas), atau melakukan semua langkah tetapi sebagian kecil kurang tepat.',
 'Peserta ujian melakukan semua (3) langkah dengan tepat:\n1. Mencatat identitas diri pada lembar jawaban yang disediakan.\n2. Mengidentifikasi semua diagnosis pada rekam medis.\n3. Mengidentifikasi semua tindakan medis pada rekam medis.'),

(2, 'Seleksi data', 1.00, 3,
 'Peserta ujian tidak melakukan atau dilakukan tetapi tidak satu langkah pun yang tepat.',
 'Peserta ujian melakukan minimal 1 dari 3 langkah dengan tepat:\n1. Melakukan pencatatan diagnosis utama dan tindakan berdasarkan rekam medis yang ada.\n2. Menentukan reseleksi diagnosis utama dan/atau diagnosis sekunder.\n3. Menentukan kode diagnosis utama.\nAtau semua langkah dilakukan tetapi sebagian besar kurang tepat.',
 'Peserta ujian melakukan minimal 2 dari 3 langkah dengan tepat, atau semua langkah dilakukan tetapi sebagian kecil kurang tepat.',
 'Peserta ujian melakukan semua (3) langkah dengan tepat:\n1. Mencatat diagnosis utama dan tindakan berdasarkan rekam medis.\n2. Menentukan reseleksi diagnosis utama dan/atau sekunder.\n3. Menentukan kode diagnosis utama.'),

(3, 'Perilaku profesional', 1.00, 3,
 'Peserta ujian tidak menunjukkan.',
 'Peserta ujian menunjukkan 1 dari 3 perilaku profesional:\n1. Ketelitian.\n2. Kehati-hatian menelaah rekam medis.\n3. Kerapihan meja kerja.',
 'Peserta ujian menunjukkan 2 dari 3 perilaku profesional (lihat di atas).',
 'Peserta ujian menunjukkan semua (3) perilaku profesional:\n1. Ketelitian.\n2. Kehati-hatian menelaah rekam medis.\n3. Kerapihan meja kerja.');
