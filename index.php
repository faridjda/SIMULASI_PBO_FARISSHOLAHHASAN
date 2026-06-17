<?php

require_once 'koneksi.php';
require_once 'PendaftaranReguler.php';
require_once 'PendaftaranPrestasi.php';
require_once 'PendaftaranKedinasan.php';

// Inisialisasi koneksi database
$db = new Database();
$pdo = $db->connect();

// Ambil data dari database
$daftarReguler = PendaftaranReguler::getDaftarReguler($pdo);
$daftarPrestasi = PendaftaranPrestasi::getDaftarPrestasi($pdo);
$daftarKedinasan = PendaftaranKedinasan::getDaftarKedinasan($pdo);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pendaftaran Mahasiswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2em;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 0.95em;
            opacity: 0.9;
        }

        .tabs {
            display: flex;
            gap: 0;
            border-bottom: 2px solid #e0e0e0;
        }

        .tab-button {
            flex: 1;
            padding: 15px;
            background: #f5f5f5;
            border: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
            color: #333;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }

        .tab-button:hover {
            background: #efefef;
        }

        .tab-button.active {
            background: white;
            color: #667eea;
            border-bottom-color: #667eea;
        }

        .tab-content {
            display: none;
            padding: 30px;
        }

        .tab-content.active {
            display: block;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .stat-box h3 {
            font-size: 2em;
            margin-bottom: 5px;
        }

        .stat-box p {
            opacity: 0.9;
            font-size: 0.9em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th {
            background: #f5f5f5;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #ddd;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        table tr:hover {
            background: #f9f9f9;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
        }

        .badge-reguler {
            background: #e3f2fd;
            color: #1976d2;
        }

        .badge-prestasi {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .badge-kedinasan {
            background: #e8f5e9;
            color: #388e3c;
        }

        .biaya {
            font-weight: 600;
            color: #d32f2f;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .empty-state h3 {
            margin-bottom: 10px;
            color: #666;
        }

        .footer {
            background: #f5f5f5;
            padding: 15px;
            text-align: center;
            color: #666;
            font-size: 0.9em;
            border-top: 1px solid #ddd;
        }

    </style>
</head>
<body>

<div class="container">
    <!-- HEADER -->
    <div class="header">
        <h1>📋 Dashboard Pendaftaran Mahasiswa</h1>
        <p>Sistem Manajemen Pendaftaran Mahasiswa Baru Universitas</p>
    </div>

    <!-- TABS -->
    <div class="tabs">
        <button class="tab-button active" onclick="switchTab('reguler')">
            🎓 Jalur Reguler
        </button>
        <button class="tab-button" onclick="switchTab('prestasi')">
            ⭐ Jalur Prestasi
        </button>
        <button class="tab-button" onclick="switchTab('kedinasan')">
            🏛️ Jalur Kedinasan
        </button>
    </div>

    <!-- ========================================
         TAB 1: JALUR REGULER
    ======================================== -->
    <div id="reguler" class="tab-content active">
        <div class="stats">
            <div class="stat-box">
                <h3><?php echo count($daftarReguler); ?></h3>
                <p>Total Pendaftar</p>
            </div>
            <div class="stat-box">
                <h3>Rp 500.000</h3>
                <p>Biaya Pendaftaran</p>
            </div>
        </div>

        <?php if (count($daftarReguler) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Calon</th>
                        <th>Asal Sekolah</th>
                        <th>Nilai Ujian</th>
                        <th>Prodi</th>
                        <th>Lokasi Kampus</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($daftarReguler as $data): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['id_pendaftaran']; ?></td>
                            <td><?php echo $data['nama_calon']; ?></td>
                            <td><?php echo $data['asal_sekolah']; ?></td>
                            <td><?php echo $data['nilai_ujian']; ?></td>
                            <td><?php echo $data['pilihan_prodi']; ?></td>
                            <td><?php echo $data['lokasi_kampus']; ?></td>
                            <td class="biaya">Rp <?php echo number_format($data['biaya_pendaftaran_dasar'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <h3>Tidak ada data pendaftar reguler</h3>
                <p>Saat ini belum ada calon mahasiswa yang mendaftar melalui jalur reguler.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- ========================================
         TAB 2: JALUR PRESTASI
    ======================================== -->
    <div id="prestasi" class="tab-content">
        <div class="stats">
            <div class="stat-box">
                <h3><?php echo count($daftarPrestasi); ?></h3>
                <p>Total Pendaftar</p>
            </div>
            <div class="stat-box">
                <h3>Rp 450.000</h3>
                <p>Biaya Pendaftaran (Diskon)</p>
            </div>
        </div>

        <?php if (count($daftarPrestasi) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Calon</th>
                        <th>Asal Sekolah</th>
                        <th>Nilai Ujian</th>
                        <th>Prodi</th>
                        <th>Jenis Prestasi</th>
                        <th>Tingkat</th>
                        <th>Biaya Dasar</th>
                        <th>Diskon</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($daftarPrestasi as $data): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['id_pendaftaran']; ?></td>
                            <td><?php echo $data['nama_calon']; ?></td>
                            <td><?php echo $data['asal_sekolah']; ?></td>
                            <td><?php echo $data['nilai_ujian']; ?></td>
                            <td><?php echo $data['pilihan_prodi']; ?></td>
                            <td><?php echo $data['jenis_prestasi']; ?></td>
                            <td>
                                <span class="badge badge-prestasi">
                                    <?php echo $data['tingkat_prestasi']; ?>
                                </span>
                            </td>
                            <td>Rp <?php echo number_format($data['biaya_pendaftaran_dasar'], 0, ',', '.'); ?></td>
                            <td>Rp 50.000</td>
                            <td class="biaya">Rp <?php echo number_format($data['biaya_pendaftaran_dasar'] - 50000, 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <h3>Tidak ada data pendaftar prestasi</h3>
                <p>Saat ini belum ada calon mahasiswa yang mendaftar melalui jalur prestasi.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- ========================================
         TAB 3: JALUR KEDINASAN
    ======================================== -->
    <div id="kedinasan" class="tab-content">
        <div class="stats">
            <div class="stat-box">
                <h3><?php echo count($daftarKedinasan); ?></h3>
                <p>Total Pendaftar</p>
            </div>
            <div class="stat-box">
                <h3>Rp 625.000</h3>
                <p>Biaya Pendaftaran (+Surcharge)</p>
            </div>
        </div>

        <?php if (count($daftarKedinasan) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Calon</th>
                        <th>Asal Sekolah</th>
                        <th>Nilai Ujian</th>
                        <th>Prodi</th>
                        <th>SK Ikatan Dinas</th>
                        <th>Instansi Sponsor</th>
                        <th>Biaya Dasar</th>
                        <th>Surcharge (25%)</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($daftarKedinasan as $data): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['id_pendaftaran']; ?></td>
                            <td><?php echo $data['nama_calon']; ?></td>
                            <td><?php echo $data['asal_sekolah']; ?></td>
                            <td><?php echo $data['nilai_ujian']; ?></td>
                            <td><?php echo $data['pilihan_prodi']; ?></td>
                            <td><?php echo $data['sk_ikatan_dinas']; ?></td>
                            <td><?php echo $data['instansi_sponsor']; ?></td>
                            <td>Rp <?php echo number_format($data['biaya_pendaftaran_dasar'], 0, ',', '.'); ?></td>
                            <td>Rp <?php echo number_format($data['biaya_pendaftaran_dasar'] * 0.25, 0, ',', '.'); ?></td>
                            <td class="biaya">Rp <?php echo number_format($data['biaya_pendaftaran_dasar'] * 1.25, 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <h3>Tidak ada data pendaftar kedinasan</h3>
                <p>Saat ini belum ada calon mahasiswa yang mendaftar melalui jalur kedinasan.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <p>© 2024 Sistem Pendaftaran Mahasiswa Baru | Data Management System v1.0</p>
    </div>
</div>

<!-- JAVASCRIPT -->
<script>
    function switchTab(tabName) {
        // Sembunyikan semua tab content
        const contents = document.querySelectorAll('.tab-content');
        contents.forEach(content => {
            content.classList.remove('active');
        });

        // Hilangkan active dari semua button
        const buttons = document.querySelectorAll('.tab-button');
        buttons.forEach(button => {
            button.classList.remove('active');
        });

        // Tampilkan tab yang dipilih
        document.getElementById(tabName).classList.add('active');

        // Aktifkan button yang dipilih
        event.target.classList.add('active');
    }
</script>

</body>
</html>