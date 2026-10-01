<?php
require_once 'includes/koneksi.php';
include 'includes/header.php';

$result = $koneksi->query("SELECT * FROM portofolio ORDER BY id DESC");
?>

<p class="font-display text-blue-600 text-sm font-semibold mb-1">Galeri</p>
<h1 class="font-display text-3xl font-bold text-[#0b1b3a] mb-2">Portofolio Kami</h1>
<p class="mb-8 text-slate-600">Beberapa hasil cetak dan produk kami.</p>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card overflow-hidden">
            <img src="assets/uploads/portofolio/<?= htmlspecialchars($row['gambar']) ?>"
                 class="w-full aspect-square object-cover">
            <?php if ($row['keterangan']): ?>
                <p class="p-2 text-xs text-slate-600"><?= htmlspecialchars($row['keterangan']) ?></p>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/footer.php'; ?>
