<?php
require_once 'auth.php';
require_once '../includes/koneksi.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $keterangan = $_POST['keterangan'];

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array(strtolower($ext), $allowed)) {
            $error = "Format file harus jpg, jpeg, png, atau webp.";
        } else {
            $namaFile = uniqid('portofolio_') . '.' . $ext;
            $tujuan = "../assets/uploads/portofolio/" . $namaFile;

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $tujuan)) {
                $stmt = $koneksi->prepare("INSERT INTO portofolio (gambar, keterangan) VALUES (?, ?)");
                $stmt->bind_param("ss", $namaFile, $keterangan);
                $stmt->execute();

                header("Location: portofolio.php");
                exit;
            } else {
                $error = "Gagal mengunggah file.";
            }
        }
    } else {
        $error = "Silakan pilih file gambar.";
    }
}

$judul = "Tambah Portofolio";
$aktif = "portofolio";
include 'includes/layout_atas.php';
?>

<h1 class="text-2xl font-bold text-blue-900 mb-6">Tambah Foto Portofolio</h1>

<?php if ($error): ?>
    <p class="text-red-600 mb-4 text-sm"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow max-w-lg">
    <label class="block mb-2 text-sm font-medium">Keterangan</label>
    <input type="text" name="keterangan" class="w-full border rounded px-3 py-2 mb-4">

    <label class="block mb-2 text-sm font-medium">Gambar</label>
    <input type="file" name="gambar" accept="image/*" class="w-full border rounded px-3 py-2 mb-6" required>

    <div class="flex gap-3">
        <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800">
            Simpan
        </button>
        <a href="portofolio.php" class="px-4 py-2 rounded border">Batal</a>
    </div>
</form>

<?php include 'includes/layout_bawah.php'; ?>
