<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'db_simulasi_pbo_ti-1c_farissholahhasan'; // ⚠️ GANTI DENGAN NAMA DB ANDA
    private $user = 'root';
    private $password = '';
    private $pdo;

    public function connect() {
        try {
            $this->pdo = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->user,
                $this->password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            die('Koneksi Gagal: ' . $e->getMessage());
        }
    }

    public function getPDO() {
        return $this->pdo;
    }
}

// ========================================
// TEST KONEKSI
// ========================================
$db = new Database();
$db->connect();
echo "<h2 style='color: green;'>✓ Koneksi Database Berhasil!</h2>";

?>