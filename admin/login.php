<?php
session_start();
require_once '../includes/koneksi.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $koneksi->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin - GON Printing</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
    <h1 class="text-2xl font-bold text-blue-900 mb-6 text-center">Login Admin</h1>

    <?php if ($error): ?>
        <p class="text-red-600 mb-4 text-sm"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label class="block mb-2 text-sm font-medium">Username</label>
        <input type="text" name="username" class="w-full border rounded px-3 py-2 mb-4" required>

        <label class="block mb-2 text-sm font-medium">Password</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2 mb-6" required>

        <button type="submit" class="w-full bg-blue-900 text-white py-2 rounded hover:bg-blue-800">
            Login
        </button>
    </form>
</div>
</body>
</html>
