<?php
require_once 'auth.php';
require_once '../includes/koneksi.php';

// Token CSRF untuk form ini
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Akun admin yang sedang login (akun tetap satu, kita hanya meng-update barisnya)
$id = (int) $_SESSION['admin_id'];
$stmt = $koneksi->prepare("SELECT id, username, password FROM admin WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$admin = $stmt->get_result()->fetch_assoc();

if (!$admin) {
    header("Location: logout.php");
    exit;
}

$error = "";
$sukses = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_baru = trim($_POST['username'] ?? '');
    $password_lama = $_POST['password_lama'] ?? '';
    $password_baru = $_POST['password_baru'] ?? '';
    $konfirmasi    = $_POST['konfirmasi'] ?? '';

    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        $error = "Sesi form tidak valid. Muat ulang halaman lalu coba lagi.";
    } elseif (!password_verify($password_lama, $admin['password'])) {
        $error = "Password saat ini salah.";
    } elseif (strlen($username_baru) < 3 || strlen($username_baru) > 50) {
        $error = "Username harus 3 sampai 50 karakter.";
    } elseif ($password_baru !== '' && strlen($password_baru) < 8) {
        $error = "Password baru minimal 8 karakter.";
    } elseif ($password_baru !== $konfirmasi) {
        $error = "Konfirmasi password baru tidak cocok.";
    } else {
        // Kalau password baru dikosongkan, password lama tetap dipakai
        $hash = ($password_baru !== '')
            ? password_hash($password_baru, PASSWORD_DEFAULT)
            : $admin['password'];

        $stmt2 = $koneksi->prepare("UPDATE admin SET username = ?, password = ? WHERE id = ?");
        $stmt2->bind_param("ssi", $username_baru, $hash, $id);
        $stmt2->execute();

        session_regenerate_id(true);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $_SESSION['admin_username'] = $username_baru;
        $admin['username'] = $username_baru;
        $sukses = true;
    }
}

$judul = "Pengaturan Akun";
$aktif = "akun";
include 'includes/layout_atas.php';
?>

<h1 class="text-2xl font-bold text-blue-900 mb-2">Pengaturan Akun</h1>
<p class="text-slate-600 mb-6">Ubah username dan password admin. Password saat ini wajib diisi untuk konfirmasi.</p>

<?php if ($sukses): ?>
    <p class="text-green-700 bg-green-50 border border-green-200 rounded p-3 mb-4 text-sm">
        Perubahan berhasil disimpan.
    </p>
<?php endif; ?>

<?php if ($error): ?>
    <p class="text-red-600 mb-4 text-sm"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" autocomplete="off" class="bg-white p-6 rounded-lg shadow max-w-lg">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

    <label class="block mb-2 text-sm font-medium">Username</label>
    <input type="text" name="username" value="<?= htmlspecialchars($admin['username']) ?>"
           autocomplete="username" class="w-full border rounded px-3 py-2 mb-4" required>

    <label class="block mb-2 text-sm font-medium">Password Saat Ini</label>
    <input type="password" name="password_lama" autocomplete="current-password"
           class="w-full border rounded px-3 py-2 mb-4" required>

    <label class="block mb-2 text-sm font-medium">Password Baru (kosongkan jika tidak ingin mengganti)</label>
    <input type="password" name="password_baru" autocomplete="new-password" minlength="8"
           class="w-full border rounded px-3 py-2 mb-4">

    <label class="block mb-2 text-sm font-medium">Konfirmasi Password Baru</label>
    <input type="password" name="konfirmasi" autocomplete="new-password" minlength="8"
           class="w-full border rounded px-3 py-2 mb-6">

    <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800">
        Simpan Perubahan
    </button>
</form>

<?php include 'includes/layout_bawah.php'; ?>
