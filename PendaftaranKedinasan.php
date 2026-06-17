<?php

require_once 'Pendaftaran.php';

class PendaftaranKedinasan extends Pendaftaran {
    protected $pilihanProdi;
    protected $lokasiKampus;
    protected $skIkatanDinas;
    protected $instansiSponsor;

    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar, $pilihanProdi, $lokasiKampus, $skIkatanDinas, $instansiSponsor) {
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biayaPendaftaranDasar);
        $this->pilihanProdi = $pilihanProdi;
        $this->lokasiKampus = $lokasiKampus;
        $this->skIkatanDinas = $skIkatanDinas;
        $this->instansiSponsor = $instansiSponsor;
    }

    // ========================================
    // IMPLEMENTASI ABSTRACT METHOD
    // ========================================
    public function hitungTotalBiaya() {
        // Jalur Kedinasan: Gratis (Biaya ditanggung instansi sponsor)
        return 0;
    }

    public function tampilkanInfoJalur() {
        return "Jalur Pendaftaran: KEDINASAN (Sponsor: {$this->instansiSponsor})";
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

    public function getSkIkatanDinas() {
        return $this->skIkatanDinas;
    }

    public function getInstansiSponsor() {
        return $this->instansiSponsor;
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
            SK Ikatan Dinas: {$this->skIkatanDinas}
            {$this->tampilkanInfoJalur()}
            Total Biaya: GRATIS (Ditanggung Instansi)
        ";
    }
}

?>