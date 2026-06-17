<?php

require_once 'Pendaftaran.php';

class PendaftaranReguler extends Pendaftaran {
    protected $pilihanProdi;
    protected $lokasiKampus;

    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar, $pilihanProdi, $lokasiKampus) {
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar);
        $this->pilihanProdi = $pilihanProdi;
        $this->lokasiKampus = $lokasiKampus;
    }

    // ========================================
    // IMPLEMENTASI ABSTRACT METHOD
    // ========================================
    public function hitungTotalBiaya() {
        // Jalur Reguler: Biaya dasar + 0% (Tidak ada potongan/tambahan)
        return $this->biayaPendaftaranDasar;
    }

    public function tampilkanInfoJalur() {
        return "Jalur Pendaftaran: REGULER";
    }

    // ========================================
    // GETTER
    // ========================================
    public function getPilihanProdi() {
        return $this->pilihanProdi;
    }

    public function getLokasiKampus() {
        return $this->lokasiKampus;
    }

    // ========================================
    // INFO LENGKAP
    // ========================================
    public function infoLengkap() {
        return "
            ID: {$this->id_pendaftaran}
            Nama: {$this->nama_calon}
            Asal Sekolah: {$this->asal_sekolah}
            Nilai Ujian: {$this->nilai_ujian}
            Prodi: {$this->pilihanProdi}
            Lokasi Kampus: {$this->lokasiKampus}
            {$this->tampilkanInfoJalur()}
            Total Biaya: Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "
        ";
    }
}

?>