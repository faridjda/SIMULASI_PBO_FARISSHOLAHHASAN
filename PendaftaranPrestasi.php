<?php

require_once 'Pendaftaran.php';

class PendaftaranPrestasi extends Pendaftaran {
    protected $pilihanProdi;
    protected $lokasiKampus;
    protected $jenisPrestasi;
    protected $tingkatPrestasi;

    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar, $pilihanProdi, $lokasiKampus, $jenisPrestasi, $tingkatPrestasi) {
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar);
        $this->pilihanProdi = $pilihanProdi;
        $this->lokasiKampus = $lokasiKampus;
        $this->jenisPrestasi = $jenisPrestasi;
        $this->tingkatPrestasi = $tingkatPrestasi;
    }

    // ========================================
    // IMPLEMENTASI ABSTRACT METHOD
    // ========================================
    public function hitungTotalBiaya() {
        // Jalur Prestasi: Diskon berdasarkan tingkat prestasi
        $diskon = 0;
        
        if ($this->tingkatPrestasi === 'Internasional') {
            $diskon = 0.50; // Diskon 50%
        } elseif ($this->tingkatPrestasi === 'Nasional') {
            $diskon = 0.30; // Diskon 30%
        } elseif ($this->tingkatPrestasi === 'Lokal') {
            $diskon = 0.15; // Diskon 15%
        }

        return $this->biayaPendaftaranDasar * (1 - $diskon);
    }

    public function tampilkanInfoJalur() {
        return "Jalur Pendaftaran: PRESTASI ({$this->tingkatPrestasi})";
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

    public function getJenisPrestasi() {
        return $this->jenisPrestasi;
    }

    public function getTingkatPrestasi() {
        return $this->tingkatPrestasi;
    }

    // ========================================
    // INFO LENGKAP
    // ========================================
    public function infoLengkap() {
        $diskon = ($this->biayaPendaftaranDasar - $this->hitungTotalBiaya());
        return "
            ID: {$this->id_pendaftaran}
            Nama: {$this->nama_calon}
            Asal Sekolah: {$this->asal_sekolah}
            Nilai Ujian: {$this->nilai_ujian}
            Prodi: {$this->pilihanProdi}
            Lokasi Kampus: {$this->lokasiKampus}
            Jenis Prestasi: {$this->jenisPrestasi}
            {$this->tampilkanInfoJalur()}
            Biaya Dasar: Rp " . number_format($this->biayaPendaftaranDasar, 0, ',', '.') . "
            Diskon: Rp " . number_format($diskon, 0, ',', '.') . "
            Total Biaya: Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "
        ";
    }
}

?>