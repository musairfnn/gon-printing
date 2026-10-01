<?php
require_once 'includes/koneksi.php';
include 'includes/header.php';

$result = $koneksi->query("SELECT * FROM layanan");
?>

<p class="font-display text-blue-600 text-sm font-semibold mb-1">Apa yang kami kerjakan</p>
<h1 class="font-display text-3xl font-bold text-[#0b1b3a] mb-8">Ragam Layanan</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card card-accent p-6">
            <?php if ($row['gambar_mesin']): ?>
                <img src="assets/uploads/layanan/<?= htmlspecialchars($row['gambar_mesin']) ?>"
                     class="w-full h-48 object-cover rounded-lg mb-4">
            <?php endif; ?>
            <h2 class="font-display text-xl font-semibold text-[#0b1b3a]"><?= htmlspecialchars($row['nama']) ?></h2>
            <p class="text-sm text-slate-500 mb-2">Mesin: <?= htmlspecialchars($row['nama_mesin']) ?></p>
            <p class="leading-relaxed mb-4"><?= htmlspecialchars($row['deskripsi']) ?></p>

            <?php
            $stmtProduk = $koneksi->prepare("SELECT * FROM produk_layanan WHERE layanan_id = ? ORDER BY id DESC");
            $stmtProduk->bind_param("i", $row['id']);
            $stmtProduk->execute();
            $produk = $stmtProduk->get_result();
            ?>
            <?php if ($produk->num_rows > 0): ?>
                <p class="font-display text-sm font-semibold text-slate-600 mb-2">Ragam Produk</p>
                <div class="grid grid-cols-4 gap-2">
                    <?php while ($p = $produk->fetch_assoc()): ?>
                        <img src="assets/uploads/produk/<?= htmlspecialchars($p['gambar']) ?>"
                             class="w-full aspect-square object-cover rounded-lg">
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/footer.php'; ?>
