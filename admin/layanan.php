<?php
require_once 'auth.php';
require_once '../includes/koneksi.php';

// Hapus data
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];

    $stmt = $koneksi->prepare("SELECT gambar_mesin FROM layanan WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    if ($row && $row['gambar_mesin']) {
        $file = "../assets/uploads/layanan/" . $row['gambar_mesin'];
        if (file_exists($file)) {
            unlink($file);
        }
    }

    $stmt2 = $koneksi->prepare("DELETE FROM layanan WHERE id = ?");
    $stmt2->bind_param("i", $id);
    $stmt2->execute();

    header("Location: layanan.php");
    exit;
}

$result = $koneksi->query("SELECT * FROM layanan ORDER BY id ASC");

$judul = "Kelola Layanan";
$aktif = "layanan";
include 'includes/layout_atas.php';
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-blue-900">Kelola Layanan</h1>
    <a href="layanan_tambah.php" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800">
        + Tambah Layanan
    </a>
</div>

<div class="space-y-4">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="bg-white rounded-lg shadow p-4 flex gap-4 items-start">
            <?php if ($row['gambar_mesin']): ?>
                <img src="../assets/uploads/layanan/<?= htmlspecialchars($row['gambar_mesin']) ?>"
                     class="w-24 h-24 object-cover rounded shrink-0">
            <?php else: ?>
                <div class="w-24 h-24 bg-slate-100 rounded shrink-0 flex items-center justify-center text-xs text-slate-400">
                    Tanpa foto
                </div>
            <?php endif; ?>

            <div class="flex-1">
                <h2 class="font-semibold text-blue-800"><?= htmlspecialchars($row['nama']) ?></h2>
                <p class="text-sm text-slate-500 mb-1">Mesin: <?= htmlspecialchars($row['nama_mesin']) ?></p>
                <p class="text-sm text-slate-600"><?= htmlspecialchars($row['deskripsi']) ?></p>
                <div class="mt-2 space-x-3 text-sm">
                    <a href="produk.php?layanan_id=<?= $row['id'] ?>" class="text-emerald-700 hover:underline">Kelola Produk</a>
                    <a href="layanan_edit.php?id=<?= $row['id'] ?>" class="text-blue-700 hover:underline">Edit</a>
                    <a href="layanan.php?hapus=<?= $row['id'] ?>"
                       onclick="return confirm('Yakin hapus layanan ini?')"
                       class="text-red-600 hover:underline">Hapus</a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/layout_bawah.php'; ?>
