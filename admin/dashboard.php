<?php
require_once 'auth.php';
require_once '../includes/koneksi.php';

$judul = "Dashboard";
$aktif = "dashboard";
include 'includes/layout_atas.php';
?>

<h1 class="text-2xl font-bold text-blue-900 mb-6">Dashboard</h1>
<p class="text-slate-600">Selamat datang, <?= htmlspecialchars($_SESSION['admin_username']) ?>. Pilih menu di sidebar untuk mulai mengelola konten.</p>

<?php include 'includes/layout_bawah.php'; ?>
