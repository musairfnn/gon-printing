<?php
require_once 'includes/koneksi.php';
include 'includes/header.php';

$result = $koneksi->query("SELECT * FROM profil LIMIT 1");
$data = $result->fetch_assoc();
?>

<p class="font-display text-blue-600 text-sm font-semibold mb-1">Ada pertanyaan?</p>
<h1 class="font-display text-3xl font-bold text-[#0b1b3a] mb-8">Hubungi Kami</h1>

<div class="card p-6 space-y-4 max-w-lg">
    <div>
        <p class="text-sm text-slate-500">Alamat</p>
        <p class="font-medium"><?= htmlspecialchars($data['alamat']) ?></p>
    </div>
    <div>
        <p class="text-sm text-slate-500">Telepon</p>
        <p class="font-medium"><?= htmlspecialchars($data['telp']) ?></p>
    </div>
    <div>
        <p class="text-sm text-slate-500">WhatsApp</p>
        <p class="font-medium"><?= htmlspecialchars($data['whatsapp']) ?></p>
    </div>
    <div>
        <p class="text-sm text-slate-500">Email</p>
        <p class="font-medium"><?= htmlspecialchars($data['email']) ?></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
