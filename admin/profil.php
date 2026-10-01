<?php
require_once 'auth.php';
require_once '../includes/koneksi.php';

$result = $koneksi->query("SELECT * FROM profil LIMIT 1");
$profil = $result->fetch_assoc();

$sukses = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deskripsi = $_POST['deskripsi'];
    $why_us = $_POST['why_us'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $whatsapp = $_POST['whatsapp'];
    $email = $_POST['email'];

    if ($profil) {
        $stmt = $koneksi->prepare("UPDATE profil SET deskripsi=?, why_us=?, alamat=?, telp=?, whatsapp=?, email=? WHERE id=?");
        $stmt->bind_param("ssssssi", $deskripsi, $why_us, $alamat, $telp, $whatsapp, $email, $profil['id']);
        $stmt->execute();
    } else {
        $stmt = $koneksi->prepare("INSERT INTO profil (deskripsi, why_us, alamat, telp, whatsapp, email) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $deskripsi, $why_us, $alamat, $telp, $whatsapp, $email);
        $stmt->execute();
    }

    // ambil ulang data terbaru
    $result = $koneksi->query("SELECT * FROM profil LIMIT 1");
    $profil = $result->fetch_assoc();
    $sukses = true;
}

$judul = "Kelola Profil";
$aktif = "profil";
include 'includes/layout_atas.php';
?>

<h1 class="text-2xl font-bold text-blue-900 mb-6">Kelola Profil</h1>

<?php if ($sukses): ?>
    <p class="text-green-700 bg-green-50 border border-green-200 rounded p-3 mb-4 text-sm">
        Perubahan berhasil disimpan.
    </p>
<?php endif; ?>

<form method="POST" class="bg-white p-6 rounded-lg shadow max-w-2xl space-y-4">
    <div>
        <label class="block mb-2 text-sm font-medium">Deskripsi / Tentang Kami</label>
        <textarea name="deskripsi" rows="5" class="w-full border rounded px-3 py-2"><?= htmlspecialchars($profil['deskripsi'] ?? '') ?></textarea>
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium">Why Us</label>
        <textarea name="why_us" rows="5" class="w-full border rounded px-3 py-2"><?= htmlspecialchars($profil['why_us'] ?? '') ?></textarea>
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium">Alamat</label>
        <input type="text" name="alamat" value="<?= htmlspecialchars($profil['alamat'] ?? '') ?>"
               class="w-full border rounded px-3 py-2">
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-2 text-sm font-medium">Telepon</label>
            <input type="text" name="telp" value="<?= htmlspecialchars($profil['telp'] ?? '') ?>"
                   class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium">WhatsApp</label>
            <input type="text" name="whatsapp" value="<?= htmlspecialchars($profil['whatsapp'] ?? '') ?>"
                   class="w-full border rounded px-3 py-2">
        </div>
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium">Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($profil['email'] ?? '') ?>"
               class="w-full border rounded px-3 py-2">
    </div>

    <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800">
        Simpan Perubahan
    </button>
</form>

<?php include 'includes/layout_bawah.php'; ?>
