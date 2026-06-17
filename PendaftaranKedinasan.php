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
    // POLIMORFISME - OVERRIDING hitungTotalBiaya()
    // Kedinasan: Total Biaya = biayaPendaftaranDasar * 1.25
    // (Surcharge/biaya tambahan 25% untuk pengurusan administrasi khusus)
    // ========================================
    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar * 1.25;
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
    // QUERY SPESIFIK: SELECT WHERE KEDINASAN
    // ========================================
    public static function getDaftarKedinasan($pdo) {
        try {
            $query = "SELECT * FROM tabel_pendaftaran 
                      WHERE jalur_pendaftaran = 'Kedinasan' 
                      ORDER BY instansi_sponsor ASC, nama_calon ASC";
            
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query Error: " . $e->getMessage());
        }
    }

    // ========================================
    // QUERY SPESIFIK: SELECT WHERE INSTANSI SPONSOR
    // ========================================
    public static function getDaftarKedinasanByInstansi($pdo, $instansi) {
        try {
            $query = "SELECT * FROM tabel_pendaftaran 
                      WHERE jalur_pendaftaran = 'Kedinasan' 
                      AND instansi_sponsor = ? 
                      ORDER BY nama_calon ASC";
            
            $stmt = $pdo->prepare($query);
            $stmt->execute([$instansi]);
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query Error: " . $e->getMessage());
        }
    }

    // ========================================
    // INFO LENGKAP
    // ========================================
    public function infoLengkap() {
        $surcharge = $this->biayaPendaftaranDasar * 0.25;
        return "
            ================================
            ID PENDAFTARAN: {$this->id_pendaftaran}
            NAMA: {$this->nama_calon}
            ASAL SEKOLAH: {$this->asal_sekolah}
            NILAI UJIAN: {$this->nilai_ujian}
            PRODI: {$this->pilihanProdi}
            LOKASI KAMPUS: {$this->lokasiKampus}
            SK IKATAN DINAS: {$this->skIkatanDinas}
            {$this->tampilkanInfoJalur()}
            BIAYA DASAR: Rp " . number_format($this->biayaPendaftaranDasar, 0, ',', '.') . "
            SURCHARGE (25%): Rp " . number_format($surcharge, 0, ',', '.') . "
            TOTAL BIAYA: Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "
            ================================
        ";
    }
}

?>