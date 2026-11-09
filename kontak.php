<?php
require_once 'includes/koneksi.php';
include 'includes/header.php';

$data = $koneksi->query("SELECT * FROM profil LIMIT 1")->fetch_assoc();
$wa_nomor = preg_replace('/\D/', '', $data['whatsapp'] ?? '');
$telp_nomor = preg_replace('/\D/', '', $data['telp'] ?? '');
?>

<p class="font-display text-blue-600 text-sm font-semibold mb-1">Ada pertanyaan?</p>
<h1 class="font-display text-3xl font-bold text-[#0b1b3a] mb-8">Hubungi Kami</h1>

<div class="grid grid-cols-1 md:grid-cols-5 gap-6">
    <!-- Info kontak -->
    <div class="md:col-span-3 card p-6 md:p-8 space-y-6">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-slate-500">Alamat</p>
                <p class="font-medium text-[#0b1b3a]"><?= htmlspecialchars($data['alamat']) ?></p>
            </div>
        </div>

        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-slate-500">Telepon</p>
                <p class="font-medium text-[#0b1b3a]"><?= htmlspecialchars($data['telp']) ?></p>
            </div>
        </div>

        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-4 4v-4z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-slate-500">WhatsApp</p>
                <p class="font-medium text-[#0b1b3a]"><?= htmlspecialchars($data['whatsapp']) ?></p>
            </div>
        </div>

        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-slate-500">Email</p>
                <p class="font-medium text-[#0b1b3a]"><?= htmlspecialchars($data['email']) ?></p>
            </div>
        </div>
    </div>

    <!-- Aksi cepat -->
    <div class="md:col-span-2 card border-l-4 border-blue-600 p-6 md:p-8 flex flex-col justify-center gap-3">
        <p class="font-display font-semibold text-[#0b1b3a] mb-1">Hubungi Langsung</p>

        <a href="https://wa.me/<?= $wa_nomor ?>" target="_blank" class="btn-primary text-center">
            Chat via WhatsApp
        </a>
        <a href="tel:<?= $telp_nomor ?>" class="btn-outline-dark text-center">
            Telepon Kami
        </a>
        <a href="mailto:<?= htmlspecialchars($data['email']) ?>" class="text-sm text-blue-600 hover:underline text-center mt-2">
            Atau kirim email &rarr;
        </a>
    </div>

    <!-- Peta lokasi -->
    <div class="card card-soft overflow-hidden" style="grid-column: 1 / -1;">
        <iframe
            src="https://maps.google.com/maps?q=-6.1780214,106.7029087&z=17&output=embed"
            style="border:0; width:100%; height:380px; display:block;"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Lokasi GON Printing di Google Maps"></iframe>
        <div class="p-4 md:p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <p class="text-sm text-slate-500">Buka di aplikasi Google Maps untuk melihat rute dari lokasi kamu.</p>
            <a href="https://maps.app.goo.gl/1ExWevt64XxtBZb96" target="_blank" rel="noopener" class="btn-primary text-center">
                Buka di Google Maps
            </a>
        </div>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
