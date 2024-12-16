CREATE DATABASE sekolah;
USE sekolah;

CREATE TABLE siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    alamat TEXT,
    jenis_kelamin VARCHAR(10),
    agama VARCHAR(10)
);

ALTER TABLE siswa ADD foto VARCHAR(255);
