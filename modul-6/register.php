<?php
include 'config.php';

$message = "";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'user'; 

    if ($password !== $confirm_password) {
        $message = "Konfirmasi password tidak cocok!";
    } else {

        $check_user = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $check_user->bind_param("s", $username);
        $check_user->execute();
        $check_user->store_result();

        if ($check_user->num_rows > 0) {

            $message = "Username sudah terdaftar! Silakan gunakan nama lain.";
        } else {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashed_password, $role);

            if ($stmt->execute()) {
                $message = "Registrasi berhasil! Silakan";
            } else {
                $message = "Terjadi kesalahan saat mendaftar.";
            }
            $stmt->close();
        }
        $check_user->close();

    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Registrasi - Gudang Digital</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96 border-t-4 border-blue-500">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Daftar Akun</h2>
        
        <?php if($message): ?>
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4 text-sm">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" name="username" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Masukkan username" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="********" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password</label>
                <input type="password" name="confirm_password" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="********" required>
            </div>
            <button type="submit" name="register" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                Daftar Sekarang
            </button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-600">
            Sudah punya akun? <a href="login.php" class="text-blue-500 font-semibold">Login di sini</a>
        </p>
    </div>
</body>
</html>