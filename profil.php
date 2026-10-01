<?php
require_once 'includes/koneksi.php';
include 'includes/header.php';

$data = $koneksi->query("SELECT * FROM profil LIMIT 1")->fetch_assoc();
$jml_layanan = $koneksi->query("SELECT COUNT(*) AS total FROM layanan")->fetch_assoc()['total'];
$jml_klien = $koneksi->query("SELECT COUNT(*) AS total FROM klien")->fetch_assoc()['total'];

// Angka ringkas (angka tahun ditulis manual, sisanya otomatis dari database)
$stats = [['11+', 'Tahun Berpengalaman']];
if ($jml_layanan > 0) $stats[] = [$jml_layanan, 'Jenis Layanan'];
if ($jml_klien > 0) $stats[] = [$jml_klien, 'Klien Kami'];
?>

<!-- Banner judul -->
<div class="relative overflow-hidden rounded-2xl bg-[#0b1b3a] text-white p-6 md:p-12 mb-6 md:mb-8">
    <div class="absolute inset-0 halftone opacity-30"></div>
    <div class="relative max-w-2xl">
        <p class="font-display text-sky-300 text-xs md:text-sm font-semibold tracking-wide mb-2">Tentang Kami</p>
        <h1 class="font-display text-2xl md:text-4xl font-extrabold leading-tight mb-2 md:mb-3">Profil Perusahaan</h1>
        <p class="text-blue-100 text-sm md:text-base">
            GON Printing, percetakan digital &amp; advertising
        </p>
    </div>
</div>

<!-- Angka ringkas -->
<div class="flex gap-2 md:gap-4 mb-6 md:mb-8">
    <?php foreach ($stats as $s): ?>
        <div class="card flex-1 p-3 md:p-6 text-center">
            <p class="font-display text-xl md:text-4xl font-extrabold text-[#0b1b3a]"><?= htmlspecialchars($s[0]) ?></p>
            <p class="text-[10px] md:text-sm text-slate-500 mt-1"><?= htmlspecialchars($s[1]) ?></p>
        </div>
    <?php endforeach; ?>
</div>

<!-- Tentang -->
<div class="card border-l-4 border-blue-600 p-5 md:p-8 mb-6 md:mb-8">
    <h2 class="font-display text-lg md:text-xl font-bold text-[#0b1b3a] mb-3">Tentang GON Printing</h2>
    <p class="leading-relaxed text-sm md:text-base"><?= nl2br(htmlspecialchars($data['deskripsi'])) ?></p>
</div>

<!-- Why Us -->
<div class="relative overflow-hidden rounded-2xl bg-[#0b1b3a] text-white p-5 md:p-8 mb-6 md:mb-8">
    <div class="absolute inset-0 halftone opacity-20"></div>
    <div class="relative">
        <p class="font-display text-sky-300 text-xs md:text-sm font-semibold tracking-wide mb-1">Keunggulan</p>
        <h2 class="font-display text-lg md:text-xl font-bold mb-3">Kenapa Memilih Kami</h2>
        <p class="leading-relaxed text-blue-100 text-sm md:text-base"><?= nl2br(htmlspecialchars($data['why_us'])) ?></p>
    </div>
</div>

<!-- Lokasi & ajakan -->
<div class="card p-5 md:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <p class="text-sm text-slate-500 mb-1">Kunjungi kami di</p>
        <p class="font-medium text-[#0b1b3a]"><?= htmlspecialchars($data['alamat']) ?></p>
    </div>
    <a href="kontak.php" class="btn-primary text-center">Hubungi Kami</a>
</div>

<?php include 'includes/footer.php'; ?>