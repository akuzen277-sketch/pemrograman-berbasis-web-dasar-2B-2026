<?php
$daftar_artikel = [
    "html-dasar" => [
        "judul" => "Belajar HTML Pertama Kali",
        "tanggal" => "10 Februari 2023",
        "refleksi" => "Awalnya saya bingung dengan banyaknya tag, tapi setelah mencoba membuat struktur sederhana, saya mulai jatuh cinta dengan dunia web.",
        "gambar" => "HTML1.png",
        "referensi" => "https://www.w3schools.com/html/"
    ],
    "error-pertama" => [
        "judul" => "Menghadapi Error Pertama",
        "tanggal" => "15 Maret 2023",
        "refleksi" => "Hanya karena kurang satu titik koma (;), seluruh halaman web mati. Pelajaran berharga tentang ketelitian dalam coding.",
        "gambar" => "error1.png",
        "referensi" => "https://www.w3schools.com/html/"
    ],
    "proyek-futsal" => [
        "judul" => "Analisis Kerangka Sistem Pemesanan Makanan Online ",
        "tanggal" => "05 April 2024",
        "refleksi" => "Membuat activity diagram membantu saya memahami alur proses bisnis pemesanan makanan online dengan lebih jelas sebelum mulai coding.",
        "gambar" => "error2.png",
        "referensi" => "https://www.w3schools.com/html/"
    ]
];

$quotes = [
    "Coding bukan tentang apa yang kamu tahu, tapi apa yang bisa kamu cari solusinya.",
    "Setiap error adalah langkah menuju pemahaman yang lebih baik.",
    "Jangan berhenti ketika lelah, berhentilah ketika selesai.",
    "Pemrograman adalah seni memberi tahu manusia lain apa yang kita inginkan agar komputer lakukan."
];
$random_quote = $quotes[array_rand($quotes)];

$id_artikel = isset($_GET['id']) ? $_GET['id'] : null;
$artikel_pilihan = null;

if ($id_artikel && array_key_exists($id_artikel, $daftar_artikel)) {
    $artikel_pilihan = $daftar_artikel[$id_artikel];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Blog Reflektif Developer</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; background: #eceff1; padding: 20px; }
        .container { max-width: 900px; margin: auto; display: flex; gap: 20px; }
        .sidebar { flex: 1; background: white; padding: 20px; border-radius: 8px; height: fit-content; }
        .main-content { flex: 2; background: white; padding: 20px; border-radius: 8px; min-height: 400px; }
        .quote-box { background: #fff3e0; padding: 15px; border-left: 5px solid #ff9800; margin-bottom: 20px; font-style: italic; }
        .nav-link { display: block; padding: 10px; color: #2c3e50; text-decoration: none; border-bottom: 1px solid #eee; }
        .nav-link:hover { background: #f0f0f0; color: #3498db; }
        img { max-width: 100%; border-radius: 5px; margin-top: 15px; }
        .back-nav { margin-top: 20px; border-top: 2px solid #eee; padding-top: 10px; }
        .btn-small { font-size: 0.8em; color: #666; text-decoration: none; margin-right: 15px; }
    </style>
</head>
<body>

<div class="container">
    <aside class="sidebar">
        <h3>Daftar Artikel</h3>
        <?php foreach ($daftar_artikel as $key => $art) : ?>
            <a href="blog.php?id=<?php echo $key; ?>" class="nav-link">
                <?php echo $art['judul']; ?>
            </a>
        <?php endforeach; ?>

        <div class="back-nav">
            <p>Navigasi Halaman:</p>
            <a href="form.php" class="btn-small">← form</a>
            <a href="timeline.php" class="btn-small">← Timeline</a>
        </div>
    </aside>

    <!-- 2. Konten Dinamis -->
    <main class="main-content">
        <div class="quote-box">
            "<?php echo $random_quote; ?>"
        </div>

        <?php if ($artikel_pilihan): ?>
            <h2><?php echo $artikel_pilihan['judul']; ?></h2>
            <small>Diposting pada: <?php echo $artikel_pilihan['tanggal']; ?></small>
            
            <p><strong>Refleksi:</strong><br>
            <?php echo $artikel_pilihan['refleksi']; ?></p>

            <!-- Ilustrasi dari folder lokal /img/ -->
            <img src="<?php echo $artikel_pilihan['gambar']; ?>" alt="Ilustrasi Artikel">

            <p>Pelajari lebih lanjut: 
                <a href="<?php echo $artikel_pilihan['referensi']; ?>" target="_blank">https://www.w3schools.com/php/default.asp</a>
            </p>
        <?php else: ?>
            <div style="text-align:center; color: #999; margin-top: 50px;">
                <h3>Selamat Datang di Blog Saya</h3>
                <p>Silakan pilih judul artikel di samping untuk membaca refleksi saya.</p>
            </div>
        <?php endif; ?>
    </main>
</div>

</body>
</html>