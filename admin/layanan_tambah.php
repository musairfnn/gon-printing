<?php
require_once 'auth.php';
require_once '../includes/koneksi.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nama_mesin = $_POST['nama_mesin'];
    $deskripsi = $_POST['deskripsi'];
    $namaFile = null;

    if (isset($_FILES['gambar_mesin']) && $_FILES['gambar_mesin']['error'] === 0) {
        $ext = pathinfo($_FILES['gambar_mesin']['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array(strtolower($ext), $allowed)) {
            $error = "Format file harus jpg, jpeg, png, atau webp.";
        } else {
            $namaFile = uniqid('layanan_') . '.' . $ext;
            $tujuan = "../assets/uploads/layanan/" . $namaFile;

            if (!move_uploaded_file($_FILES['gambar_mesin']['tmp_name'], $tujuan)) {
                $error = "Gagal mengunggah file.";
                $namaFile = null;
            }
        }
    }

    if (!$error) {
        $stmt = $koneksi->prepare("INSERT INTO layanan (nama, nama_mesin, deskripsi, gambar_mesin) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $nama_mesin, $deskripsi, $namaFile);
        $stmt->execute();

        header("Location: layanan.php");
        exit;
    }
}

$judul = "Tambah Layanan";
$aktif = "layanan";
include 'includes/layout_atas.php';
?>

<h1 class="text-2xl font-bold text-blue-900 mb-6">Tambah Layanan</h1>

<?php if ($error): ?>
    <p class="text-red-600 mb-4 text-sm"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow max-w-lg">
    <label class="block mb-2 text-sm font-medium">Nama Layanan</label>
    <input type="text" name="nama" class="w-full border rounded px-3 py-2 mb-4" required>

    <label class="block mb-2 text-sm font-medium">Nama Mesin</label>
    <input type="text" name="nama_mesin" class="w-full border rounded px-3 py-2 mb-4">

    <label class="block mb-2 text-sm font-medium">Deskripsi</label>
    <textarea name="deskripsi" rows="4" class="w-full border rounded px-3 py-2 mb-4"></textarea>

    <label class="block mb-2 text-sm font-medium">Gambar Mesin (opsional)</label>
    <input type="file" name="gambar_mesin" accept="image/*" class="w-full border rounded px-3 py-2 mb-6">

    <div class="flex gap-3">
        <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800">
            Simpan
        </button>
        <a href="layanan.php" class="px-4 py-2 rounded border">Batal</a>
    </div>
</form>

<?php include 'includes/layout_bawah.php'; ?>
