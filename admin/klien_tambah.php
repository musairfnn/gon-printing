<?php
require_once 'auth.php';
require_once '../includes/koneksi.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];

    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {
        $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

        if (!in_array(strtolower($ext), $allowed)) {
            $error = "Format file harus jpg, jpeg, png, webp, atau svg.";
        } else {
            $namaFile = uniqid('klien_') . '.' . $ext;
            $tujuan = "../assets/uploads/klien/" . $namaFile;

            if (move_uploaded_file($_FILES['logo']['tmp_name'], $tujuan)) {
                $stmt = $koneksi->prepare("INSERT INTO klien (nama, logo) VALUES (?, ?)");
                $stmt->bind_param("ss", $nama, $namaFile);
                $stmt->execute();

                header("Location: klien.php");
                exit;
            } else {
                $error = "Gagal mengunggah file.";
            }
        }
    } else {
        $error = "Silakan pilih file logo.";
    }
}

$judul = "Tambah Klien";
$aktif = "klien";
include 'includes/layout_atas.php';
?>

<h1 class="text-2xl font-bold text-blue-900 mb-6">Tambah Klien</h1>

<?php if ($error): ?>
    <p class="text-red-600 mb-4 text-sm"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow max-w-lg">
    <label class="block mb-2 text-sm font-medium">Nama Klien</label>
    <input type="text" name="nama" class="w-full border rounded px-3 py-2 mb-4" required>

    <label class="block mb-2 text-sm font-medium">Logo</label>
    <input type="file" name="logo" accept="image/*" class="w-full border rounded px-3 py-2 mb-6" required>

    <div class="flex gap-3">
        <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800">
            Simpan
        </button>
        <a href="klien.php" class="px-4 py-2 rounded border">Batal</a>
    </div>
</form>

<?php include 'includes/layout_bawah.php'; ?>
