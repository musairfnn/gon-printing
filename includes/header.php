<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GON Printing</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="min-h-screen flex flex-col">

<div class="colorbar"></div>
<nav class="bg-[#0b1b3a] text-white px-6 py-4 flex justify-between items-center">
    <a href="index.php" class="flex items-center gap-3">
        <img src="assets/img/logo.png" alt="GON Printing" class="h-9 w-auto">
        <span class="font-display font-extrabold text-lg tracking-tight">GON PRINTING</span>
    </a>

    <div class="hidden md:flex space-x-6 font-display text-sm font-medium">
        <a href="index.php" class="hover:text-sky-300">Beranda</a>
        <a href="profil.php" class="hover:text-sky-300">Profil</a>
        <a href="layanan.php" class="hover:text-sky-300">Layanan</a>
        <a href="portofolio.php" class="hover:text-sky-300">Portofolio</a>
        <a href="klien.php" class="hover:text-sky-300">Klien</a>
        <a href="kontak.php" class="hover:text-sky-300">Kontak</a>
    </div>

    <button id="menuBtn" class="md:hidden" aria-label="Buka menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</nav>

<div id="menuMobile" class="hidden md:hidden bg-[#0b1b3a] text-white font-display text-sm font-medium">
    <a href="index.php" class="block px-6 py-3 border-t border-blue-900 hover:bg-[#14285c]">Beranda</a>
    <a href="profil.php" class="block px-6 py-3 border-t border-blue-900 hover:bg-[#14285c]">Profil</a>
    <a href="layanan.php" class="block px-6 py-3 border-t border-blue-900 hover:bg-[#14285c]">Layanan</a>
    <a href="portofolio.php" class="block px-6 py-3 border-t border-blue-900 hover:bg-[#14285c]">Portofolio</a>
    <a href="klien.php" class="block px-6 py-3 border-t border-blue-900 hover:bg-[#14285c]">Klien</a>
    <a href="kontak.php" class="block px-6 py-3 border-t border-blue-900 hover:bg-[#14285c]">Kontak</a>
</div>

<script>
document.getElementById('menuBtn').addEventListener('click', function () {
    document.getElementById('menuMobile').classList.toggle('hidden');
});
</script>

<main class="max-w-6xl mx-auto px-6 py-10 flex-1 w-full">
