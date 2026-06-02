<?php
include 'config.php';
include 'auth_check.php';

checkAdmin();

$id = $_GET['id'];
$message = "";

$stmt = $conn->prepare("SELECT * FROM barang WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan!");
}

if (isset($_POST['update'])) {
    $nama = $_POST['nama_barang'];
    $kat = $_POST['kategori'];
    $qty = $_POST['jumlah'];
    $harga = $_POST['harga_satuan'];
    $tgl = $_POST['tanggal_masuk'];

    $update_stmt = $conn->prepare("UPDATE barang SET nama_barang=?, kategori=?, jumlah=?, harga_satuan=?, tanggal_masuk=? WHERE id=?");
    $update_stmt->bind_param("ssidsi", $nama, $kat, $qty, $harga, $tgl, $id);

    if ($update_stmt->execute()) {
        header("Location: index.php?status=updated");
        exit();
    } else {
        $message = "Gagal memperbarui data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Barang - Admin</title>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Data Barang</h2>
        
        <?php if($message): ?>
            <p class="text-red-500 mb-4"><?= $message ?></p>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
                <input type="text" name="nama_barang" value="<?= htmlspecialchars($data['nama_barang']) ?>" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <input type="text" name="kategori" value="<?= htmlspecialchars($data['kategori']) ?>" class="w-full border p-2 rounded">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stok (Jumlah)</label>
                    <input type="number" name="jumlah" value="<?= (int)$data['jumlah'] ?>" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga Satuan</label>
                    <input type="number" step="0.01" name="harga_satuan" value="<?= $data['harga_satuan'] ?>" class="w-full border p-2 rounded">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" value="<?= $data['tanggal_masuk'] ?>" class="w-full border p-2 rounded">
            </div>
            
            <div class="flex gap-4 pt-4">
                <button type="submit" name="update" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Simpan Perubahan</button>
                <a href="index.php" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 transition">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>