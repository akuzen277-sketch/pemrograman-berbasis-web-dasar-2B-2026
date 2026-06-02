<?php
include 'config.php';
include 'auth_check.php';

if (isset($_POST['add'])) {
    checkAdmin();
    $nama = $_POST['nama_barang'];
    $kat = $_POST['kategori'];
    $qty = $_POST['jumlah'];
    $harga = $_POST['harga_satuan'];
    $tgl = $_POST['tanggal_masuk'];

    if ($harga < 0) {
        $message = "Harga barang tidak boleh kurang dari 0!";
    }

    elseif ($tgl > $today) {
        $message = "Tanggal masuk tidak boleh melebihi hari ini!";
    }
    else {
        $stmt = $conn->prepare("INSERT INTO barang (nama_barang, kategori, jumlah, harga_satuan, tanggal_masuk) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssids", $nama, $kat, $qty, $harga, $tgl);
        $stmt->execute();
    }

}




if (isset($_GET['delete'])) {
    checkAdmin();
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM barang WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: index.php");
}

$result = $conn->query("SELECT * FROM barang");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard Gudang</title>
</head>
<body class="p-10 bg-gray-50">
    <div class="flex justify-between mb-6">
        <h1 class="text-3xl font-bold">Data Inventaris</h1>
        <div>
            <span class="mr-4">Halo, <b><?= htmlspecialchars($_SESSION['username']) ?></b> (<?= $_SESSION['role'] ?>)</span>
            <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded">Logout</a>
        </div>
    </div>

    <?php if ($_SESSION['role'] == 'admin'): ?>
    <div class="bg-white p-6 rounded shadow mb-8">
        <h2 class="text-xl font-semibold mb-4 text-blue-600">Tambah Barang Baru</h2>
        <form method="POST" class="grid grid-cols-2 gap-4">
            <input type="text" name="nama_barang" placeholder="Nama Barang" class="border p-2" required>
            <input type="text" name="kategori" placeholder="Kategori" class="border p-2">
            <input type="number" name="jumlah" placeholder="Jumlah" class="border p-2" required>
            <input type="number" step="0.01" name="harga_satuan" placeholder="Harga" class="border p-2">
            <input type="date" name="tanggal_masuk" class="border p-2">
            <button type="submit" name="add" class="bg-green-600 text-white p-2 rounded">Simpan Barang</button>
        </form>
    </div>
    <?php endif; ?>

    <table class="w-full bg-white rounded shadow text-left">
        <thead class="bg-blue-500 text-white">
            <tr>
                <th class="p-3">Nama</th>
                <th class="p-3">Kategori</th>
                <th class="p-3">Stok</th>
                <th class="p-3">Harga</th>
                <th class="p-3">Tanggal</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr class="border-b">
                <td class="p-3"><?= htmlspecialchars($row['nama_barang']) ?></td>
                <td class="p-3"><?= htmlspecialchars($row['kategori']) ?></td>
                <td class="p-3"><?= (int)$row['jumlah'] ?></td>
                <td class="p-3">Rp <?= number_format($row['harga_satuan'], 0, ',', '.') ?></td>
                <td class="p-3"><?= $row['tanggal_masuk'] ?></td>
                <td class="p-3">
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="text-blue-500 mr-2">Edit</a>
                        <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Hapus?')" class="text-red-500">Hapus</a>
                    <?php else: ?>
                        <span class="text-gray-400 italic text-sm">View Only</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>