<?php
// 1. Struktur Data: Array Asosiatif (Minimal 5 data)
$history_belajar = [
    [
        "tahun" => 2025,
        "kegiatan" => "Masuk Kuliah Teknik Sistem Informasi",
        "deskripsi" => "Mengenal dasar algoritma dan logika pemrograman."
    ],
    [
        "tahun" => 2025,
        "kegiatan" => "Mulai Belajar Python",
        "deskripsi" => "Memperdalam logika pemrograman."
    ],
    [
        "tahun" => 2025,
        "kegiatan" => "Membuat proyek pertama: Kerangka Pemesanan Makanan Online",
        "deskripsi" => "Belajar membuat Kerangka pemesanan dari web pemesanan online"
    ],
    [
        "tahun" => 2026,
        "kegiatan" => "Mengenal HTML, CSS & DLL",
        "deskripsi" => "Belejar membuat website sederhana"
    ],
    [
        "tahun" => 2026,
        "kegiatan" => "Membuat Web Form, timeline pembelajaran, dan Blog reflektif Development",
        "deskripsi" => "Mengerjakan Tugas Praktikum"
    ]
];

// 4. Fungsi Kustom: Memberikan penekanan pada tahun tertentu
function beriPenekanan($teks, $tahun) {
    // Memberikan warna biru dan tebal jika tahun adalah 2025 (Tahun Proyek Pertama)
    if ($tahun == 2026) {
        return "<strong style='color: #2980b9;'>[PENTING] $teks</strong>";
    }
    return $teks;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Timeline Perjalanan Belajar Coding</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 8px; }
        
        /* 2. Visualisasi: Timeline Vertikal Sederhana */
        .timeline {
            border-left: 3px solid #3498db;
            padding-left: 20px;
            position: relative;
            list-style: none;
        }
        .timeline-item { margin-bottom: 30px; position: relative; }
        .timeline-item::before {
            content: "";
            position: absolute;
            left: -27px;
            top: 5px;
            width: 12px;
            height: 12px;
            background: #3498db;
            border: 2px solid white;
            border-radius: 50%;
        }
        .tahun { font-weight: bold; color: #333; }
        .kegiatan { font-size: 1.1em; margin: 5px 0; display: block; }
        .deskripsi { font-size: 0.9em; color: #666; }
        
        /* 5. Navigasi */
        .nav-buttons { margin-top: 40px; text-align: center; }
        .btn {
            text-decoration: none;
            padding: 10px 20px;
            background: #2c3e50;
            color: white;
            border-radius: 5px;
            margin: 5px;
            display: inline-block;
        }
        .btn:hover { background: #34495e; }
    </style>
</head>
<body>

<div class="container">
    <h2>Timeline Perjalanan Belajar Coding</h2>
    
    <div class="timeline">
        <?php 
        // 3. Perulangan: Menggunakan foreach
        foreach ($history_belajar as $data) : 
        ?>
            <div class="timeline-item">
                <div class="tahun"><?php echo $data['tahun']; ?></div>
                <span class="kegiatan">
                    <?php echo beriPenekanan($data['kegiatan'], $data['tahun']); ?>
                </span>
                <p class="deskripsi"><?php echo $data['deskripsi']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- 5. Navigasi -->
    <div class="nav-buttons">
        <a href="form.php" class="btn">Kembali ke data formulir</a>
        <a href="blog.php" class="btn">kembali ke profil</a>
    </div>
</div>

</body>
</html>