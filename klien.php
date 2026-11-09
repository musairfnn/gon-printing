<?php
require_once 'includes/koneksi.php';
include 'includes/header.php';

// Klien bernama diurutkan abjad, yang tanpa nama ditaruh paling akhir
$result = $koneksi->query("SELECT * FROM klien ORDER BY (nama = '') ASC, nama ASC, id ASC");
?>

<p class="font-display text-blue-600 text-sm font-semibold mb-1">Dipercaya oleh</p>
<h1 class="font-display text-3xl font-bold text-[#0b1b3a] mb-8">Klien Kami</h1>

<div class="grid grid-cols-2 md:grid-cols-5 gap-4">
    <?php while ($row = $result->fetch_assoc()): ?>
        <?php $punyaNama = trim($row['nama']) !== ''; ?>
        <div class="card p-4 flex flex-col items-center justify-center text-center">
            <img src="assets/uploads/klien/<?= htmlspecialchars($row['logo']) ?>"
                 alt="<?= htmlspecialchars($punyaNama ? $row['nama'] : 'Logo klien') ?>"
                 class="max-h-16 object-contain <?= $punyaNama ? 'mb-2' : '' ?>">
            <?php if ($punyaNama): ?>
                <p class="text-xs text-slate-600"><?= htmlspecialchars($row['nama']) ?></p>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/footer.php'; ?>
