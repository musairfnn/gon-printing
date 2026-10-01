<?php
require_once 'includes/koneksi.php';
include 'includes/header.php';

$profil = $koneksi->query("SELECT * FROM profil LIMIT 1")->fetch_assoc();
$layanan = $koneksi->query("SELECT * FROM layanan LIMIT 4");
$portofolio = $koneksi->query("SELECT * FROM portofolio ORDER BY id DESC LIMIT 4");
?>

<!-- Hero -->
<div class="relative left-1/2 right-1/2 -mx-[50vw] w-screen -mt-10 overflow-hidden bg-[#0b1b3a] text-white mb-8 md:mb-14 border-t-2 border-white">
    <img src="assets/img/hero.jpg" alt=""
         class="absolute inset-0 w-full h-full object-cover opacity-25">
    <div class="absolute inset-0 bg-gradient-to-r from-[#0b1b3a] via-[#0b1b3a]/90 to-transparent"></div>
    <div class="absolute inset-0 halftone opacity-20"></div>
    <div class="relative max-w-6xl mx-auto px-6 py-8 md:py-16">
        <div class="max-w-2xl">
            <p class="font-display text-sky-300 text-xs md:text-sm font-semibold tracking-wide mb-2 md:mb-3">
                Percetakan Digital &amp; Advertising 
            </p>
            <h1 class="font-display text-2xl md:text-5xl font-extrabold leading-tight mb-3 md:mb-5">
                Cetak yang selesai tepat waktu, setiap waktu.
            </h1>
            <p class="text-blue-100 text-sm md:text-base leading-relaxed mb-5 md:mb-8">
                Melayani cetak baliho, banner, spanduk, brosur, hingga katalog sesuai kebutuhan Anda —
                didukung layanan antar (delivery order) dan pemesanan online.
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="kontak.php" class="btn-light text-sm md:text-base">Hubungi Kami</a>
                <a href="layanan.php" class="btn-outline text-sm md:text-base">Lihat Layanan</a>
            </div>
        </div>
    </div>
</div>

<!-- Ragam Layanan -->
<div class="mb-8 md:mb-14">
    <div class="flex justify-between items-end mb-4 md:mb-6">
        <div>
            <p class="font-display text-blue-600 text-sm font-semibold mb-1">Layanan</p>
            <h2 class="font-display text-xl md:text-2xl font-bold text-[#0b1b3a]">Ragam Layanan</h2>
        </div>
        <a href="layanan.php" class="text-sm font-display font-semibold text-blue-600 hover:text-blue-800">
            Lihat semua &rarr;
        </a>
    </div>
    <div class="grid grid-cols-4 gap-2 md:gap-5">
    <?php while ($row = $layanan->fetch_assoc()): ?>
        <div class="card border-l-2 md:border-l-4 border-blue-600 p-2 md:p-5">
            <?php if ($row['gambar_mesin']): ?>
                <img src="assets/uploads/layanan/<?= htmlspecialchars($row['gambar_mesin']) ?>"
                     class="w-full h-12 md:h-28 object-cover rounded-md md:rounded-lg mb-2 md:mb-4">
            <?php endif; ?>
            <h3 class="font-display font-semibold text-[#0b1b3a] text-[10px] leading-tight md:text-base">
                <?= htmlspecialchars($row['nama']) ?>
            </h3>
        </div>
    <?php endwhile; ?>
</div>
</div>

<!-- Portofolio Preview -->
<?php if ($portofolio->num_rows > 0): ?>
<div class="mb-6">
    <div class="flex justify-between items-end mb-4 md:mb-6">
        <div>
            <p class="font-display text-blue-600 text-sm font-semibold mb-1">Galeri</p>
            <h2 class="font-display text-xl md:text-2xl font-bold text-[#0b1b3a]">Portofolio Kami</h2>
        </div>
        <a href="portofolio.php" class="text-sm font-display font-semibold text-blue-600 hover:text-blue-800">
            Lihat semua &rarr;
        </a>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <?php while ($row = $portofolio->fetch_assoc()): ?>
            <img src="assets/uploads/portofolio/<?= htmlspecialchars($row['gambar']) ?>"
                 class="w-full aspect-square object-cover rounded-xl card">
        <?php endwhile; ?>
    </div>
</div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>