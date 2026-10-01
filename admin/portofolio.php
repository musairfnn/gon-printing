<?php
require_once 'auth.php';
require_once '../includes/koneksi.php';

// Hapus data
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];

    $stmt = $koneksi->prepare("SELECT gambar FROM portofolio WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    if ($row) {
        $file = "../assets/uploads/portofolio/" . $row['gambar'];
        if (file_exists($file)) {
            unlink($file);
        }

        $stmt2 = $koneksi->prepare("DELETE FROM portofolio WHERE id = ?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
    }
    header("Location: portofolio.php");
    exit;
}

$result = $koneksi->query("SELECT * FROM portofolio ORDER BY id DESC");

$judul = "Kelola Portofolio";
$aktif = "portofolio";
include 'includes/layout_atas.php';
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-blue-900">Kelola Portofolio</h1>
    <a href="portofolio_tambah.php" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800">
        + Tambah Foto
    </a>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <img src="../assets/uploads/portofolio/<?= htmlspecialchars($row['gambar']) ?>"
                 class="w-full h-32 object-cover">
            <div class="p-2">
                <p class="text-xs text-slate-600 truncate"><?= htmlspecialchars($row['keterangan']) ?></p>
                <a href="portofolio.php?hapus=<?= $row['id'] ?>"
                   onclick="return confirm('Yakin hapus foto ini?')"
                   class="text-red-600 text-xs hover:underline">Hapus</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/layout_bawah.php'; ?>
