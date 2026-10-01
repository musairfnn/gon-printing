<?php
require_once 'auth.php';
require_once '../includes/koneksi.php';

$layanan_id = (int) ($_GET['layanan_id'] ?? 0);

$stmt = $koneksi->prepare("SELECT * FROM layanan WHERE id = ?");
$stmt->bind_param("i", $layanan_id);
$stmt->execute();
$layanan = $stmt->get_result()->fetch_assoc();

if (!$layanan) {
    header("Location: layanan.php");
    exit;
}

// Hapus foto produk
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];

    $stmt = $koneksi->prepare("SELECT gambar FROM produk_layanan WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    if ($row) {
        $file = "../assets/uploads/produk/" . $row['gambar'];
        if (file_exists($file)) {
            unlink($file);
        }

        $stmt2 = $koneksi->prepare("DELETE FROM produk_layanan WHERE id = ?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
    }
    header("Location: produk.php?layanan_id=" . $layanan_id);
    exit;
}

// Tambah foto produk
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array(strtolower($ext), $allowed)) {
            $error = "Format file harus jpg, jpeg, png, atau webp.";
        } else {
            $namaFile = uniqid('produk_') . '.' . $ext;
            $tujuan = "../assets/uploads/produk/" . $namaFile;

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $tujuan)) {
                $stmt = $koneksi->prepare("INSERT INTO produk_layanan (layanan_id, gambar) VALUES (?, ?)");
                $stmt->bind_param("is", $layanan_id, $namaFile);
                $stmt->execute();

                header("Location: produk.php?layanan_id=" . $layanan_id);
                exit;
            } else {
                $error = "Gagal mengunggah file.";
            }
        }
    } else {
        $error = "Silakan pilih file gambar.";
    }
}

$stmt = $koneksi->prepare("SELECT * FROM produk_layanan WHERE layanan_id = ? ORDER BY id DESC");
$stmt->bind_param("i", $layanan_id);
$stmt->execute();
$produk = $stmt->get_result();

$judul = "Ragam Produk - " . $layanan['nama'];
$aktif = "layanan";
include 'includes/layout_atas.php';
?>

<a href="layanan.php" class="text-sm text-blue-700 hover:underline">&larr; Kembali ke Kelola Layanan</a>

<h1 class="text-2xl font-bold text-blue-900 mt-2 mb-1">Ragam Produk</h1>
<p class="text-slate-500 mb-6">Layanan: <?= htmlspecialchars($layanan['nama']) ?></p>

<?php if ($error): ?>
    <p class="text-red-600 mb-4 text-sm"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded-lg shadow mb-6 flex gap-3 items-end max-w-lg">
    <div class="flex-1">
        <label class="block mb-2 text-sm font-medium">Tambah Foto Produk</label>
        <input type="file" name="gambar" accept="image/*" class="w-full border rounded px-3 py-2" required>
    </div>
    <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800">
        Upload
    </button>
</form>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <?php while ($row = $produk->fetch_assoc()): ?>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <img src="../assets/uploads/produk/<?= htmlspecialchars($row['gambar']) ?>"
                 class="w-full aspect-square object-cover">
            <a href="produk.php?layanan_id=<?= $layanan_id ?>&hapus=<?= $row['id'] ?>"
               onclick="return confirm('Yakin hapus foto ini?')"
               class="block text-center text-red-600 text-xs py-2 hover:underline">Hapus</a>
        </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/layout_bawah.php'; ?>
