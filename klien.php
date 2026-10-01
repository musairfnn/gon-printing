<?php
require_once 'includes/koneksi.php';
include 'includes/header.php';

$result = $koneksi->query("SELECT * FROM klien ORDER BY nama ASC");
?>

<p class="font-display text-blue-600 text-sm font-semibold mb-1">Dipercaya oleh</p>
<h1 class="font-display text-3xl font-bold text-[#0b1b3a] mb-8">Klien Kami</h1>

<div class="grid grid-cols-2 md:grid-cols-5 gap-4">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card p-4 flex flex-col items-center justify-center text-center">
            <img src="assets/uploads/klien/<?= htmlspecialchars($row['logo']) ?>"
                 alt="<?= htmlspecialchars($row['nama']) ?>"
                 class="max-h-16 object-contain mb-2">
            <p class="text-xs text-slate-600"><?= htmlspecialchars($row['nama']) ?></p>
        </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/footer.php'; ?>
