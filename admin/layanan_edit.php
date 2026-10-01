<?php
require_once 'auth.php';
require_once '../includes/koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = $koneksi->prepare("SELECT * FROM layanan WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$layanan = $stmt->get_result()->fetch_assoc();

if (!$layanan) {
    header("Location: layanan.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nama_mesin = $_POST['nama_mesin'];
    $deskripsi = $_POST['deskripsi'];
    $namaFile = $layanan['gambar_mesin'];

    if (isset($_FILES['gambar_mesin']) && $_FILES['gambar_mesin']['error'] === 0) {
        $ext = pathinfo($_FILES['gambar_mesin']['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array(strtolower($ext), $allowed)) {
            $error = "Format file harus jpg, jpeg, png, atau webp.";
        } else {
            $baru = uniqid('layanan_') . '.' . $ext;
            $tujuan = "../assets/uploads/layanan/" . $baru;

            if (move_uploaded_file($_FILES['gambar_mesin']['tmp_name'], $tujuan)) {
                if ($namaFile && file_exists("../assets/uploads/layanan/" . $namaFile)) {
                    unlink("../assets/uploads/layanan/" . $namaFile);
                }
                $namaFile = $baru;
            } else {
                $error = "Gagal mengunggah file.";
            }
        }
    }

    if (!$error) {
        $stmt2 = $koneksi->prepare("UPDATE layanan SET nama = ?, nama_mesin = ?, deskripsi = ?, gambar_mesin = ? WHERE id = ?");
        $stmt2->bind_param("ssssi", $nama, $nama_mesin, $deskripsi, $namaFile, $id);
        $stmt2->execute();

        header("Location: layanan.php");
        exit;
    }
}

$judul = "Edit Layanan";
$aktif = "layanan";
include 'includes/layout_atas.php';
?>

<h1 class="text-2xl font-bold text-blue-900 mb-6">Edit Layanan</h1>

<?php if ($error): ?>
    <p class="text-red-600 mb-4 text-sm"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow max-w-lg">
    <label class="block mb-2 text-sm font-medium">Nama Layanan</label>
    <input type="text" name="nama" value="<?= htmlspecialchars($layanan['nama']) ?>"
           class="w-full border rounded px-3 py-2 mb-4" required>

    <label class="block mb-2 text-sm font-medium">Nama Mesin</label>
    <input type="text" name="nama_mesin" value="<?= htmlspecialchars($layanan['nama_mesin']) ?>"
           class="w-full border rounded px-3 py-2 mb-4">

    <label class="block mb-2 text-sm font-medium">Deskripsi</label>
    <textarea name="deskripsi" rows="4" class="w-full border rounded px-3 py-2 mb-4"><?= htmlspecialchars($layanan['deskripsi']) ?></textarea>

    <?php if ($layanan['gambar_mesin']): ?>
        <img src="../assets/uploads/layanan/<?= htmlspecialchars($layanan['gambar_mesin']) ?>"
             class="w-32 h-32 object-cover rounded mb-2">
    <?php endif; ?>

    <label class="block mb-2 text-sm font-medium">Ganti Gambar Mesin (opsional)</label>
    <input type="file" name="gambar_mesin" accept="image/*" class="w-full border rounded px-3 py-2 mb-6">

    <div class="flex gap-3">
        <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800">
            Simpan Perubahan
        </button>
        <a href="layanan.php" class="px-4 py-2 rounded border">Batal</a>
    </div>
</form>

<?php include 'includes/layout_bawah.php'; ?>
