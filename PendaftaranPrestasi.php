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
    // POLIMORFISME - OVERRIDING hitungTotalBiaya()
    // Prestasi: Total Biaya = biayaPendaftaranDasar - 50000
    // (Potongan/insentif apresiasi prestasi Rp50.000)
    // ========================================
    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar - 50000;
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
    // QUERY SPESIFIK: SELECT WHERE PRESTASI
    // ========================================
    public static function getDaftarPrestasi($pdo) {
        try {
            $query = "SELECT * FROM tabel_pendaftaran 
                      WHERE jalur_pendaftaran = 'Prestasi' 
                      ORDER BY tingkat_prestasi DESC, nama_calon ASC";
            
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query Error: " . $e->getMessage());
        }
    }

    // ========================================
    // QUERY SPESIFIK: SELECT WHERE TINGKAT PRESTASI
    // ========================================
    public static function getDaftarPrestasiByTingkat($pdo, $tingkat) {
        try {
            $query = "SELECT * FROM tabel_pendaftaran 
                      WHERE jalur_pendaftaran = 'Prestasi' 
                      AND tingkat_prestasi = ? 
                      ORDER BY nama_calon ASC";
            
            $stmt = $pdo->prepare($query);
            $stmt->execute([$tingkat]);
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query Error: " . $e->getMessage());
        }
    }

    // ========================================
    // INFO LENGKAP
    // ========================================
    public function infoLengkap() {
        $potongan = 50000;
        return "
            ================================
            ID PENDAFTARAN: {$this->id_pendaftaran}
            NAMA: {$this->nama_calon}
            ASAL SEKOLAH: {$this->asal_sekolah}
            NILAI UJIAN: {$this->nilai_ujian}
            PRODI: {$this->pilihanProdi}
            LOKASI KAMPUS: {$this->lokasiKampus}
            JENIS PRESTASI: {$this->jenisPrestasi}
            {$this->tampilkanInfoJalur()}
            BIAYA DASAR: Rp " . number_format($this->biayaPendaftaranDasar, 0, ',', '.') . "
            POTONGAN PRESTASI: Rp " . number_format($potongan, 0, ',', '.') . "
            TOTAL BIAYA: Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "
            ================================
        ";
    }
}

?>