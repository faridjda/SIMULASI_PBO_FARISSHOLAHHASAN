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
    // POLIMORFISME - OVERRIDING hitungTotalBiaya()
    // Reguler: Total Biaya = biayaPendaftaranDasar (Tarif standar murni)
    // ========================================
    public function hitungTotalBiaya() {
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
    // QUERY SPESIFIK: SELECT WHERE REGULER
    // ========================================
    public static function getDaftarReguler($pdo) {
        try {
            $query = "SELECT * FROM tabel_pendaftaran 
                      WHERE jalur_pendaftaran = 'Reguler' 
                      ORDER BY nama_calon ASC";
            
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query Error: " . $e->getMessage());
        }
    }

    // ========================================
    // QUERY SPESIFIK: SELECT WHERE PRODI
    // ========================================
    public static function getDaftarRegulerByProdi($pdo, $prodi) {
        try {
            $query = "SELECT * FROM tabel_pendaftaran 
                      WHERE jalur_pendaftaran = 'Reguler' 
                      AND pilihan_prodi = ? 
                      ORDER BY nama_calon ASC";
            
            $stmt = $pdo->prepare($query);
            $stmt->execute([$prodi]);
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query Error: " . $e->getMessage());
        }
    }

    // ========================================
    // INFO LENGKAP
    // ========================================
    public function infoLengkap() {
        return "
            ================================
            ID PENDAFTARAN: {$this->id_pendaftaran}
            NAMA: {$this->nama_calon}
            ASAL SEKOLAH: {$this->asal_sekolah}
            NILAI UJIAN: {$this->nilai_ujian}
            PRODI: {$this->pilihanProdi}
            LOKASI KAMPUS: {$this->lokasiKampus}
            {$this->tampilkanInfoJalur()}
            TOTAL BIAYA: Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "
            ================================
        ";
    }
}

?>