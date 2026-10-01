<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $judul ?? 'Admin' ?> - GON Printing</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-slate-50 flex min-h-screen">

<div id="sidebarOverlay" class="hidden fixed inset-0 bg-black/40 z-20 md:hidden"></div>

<div class="md:hidden fixed top-0 left-0 right-0 bg-[#0b1b3a] text-white flex items-center justify-between px-4 py-3 z-20">
    <div class="flex items-center gap-2">
        <img src="../assets/img/logo.png" alt="GON Printing" class="h-7 w-auto">
        <span class="font-display font-extrabold text-sm">GON PRINTING</span>
    </div>
    <button id="sidebarBtn" aria-label="Buka menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<aside id="sidebar" class="w-64 bg-[#0b1b3a] text-white flex flex-col shrink-0 h-screen overflow-y-auto
    fixed md:sticky top-0 left-0 z-30 -translate-x-full md:translate-x-0 transition-transform duration-200">
    <div class="px-6 py-5 border-b border-blue-900 flex items-center gap-3">
        <img src="../assets/img/logo.png" alt="GON Printing" class="h-8 w-auto">
        <div>
            <span class="font-display font-extrabold text-base leading-tight block">GON PRINTING</span>
            <p class="text-xs text-blue-300">Admin Panel</p>
        </div>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1 font-display text-sm">
        <a href="dashboard.php"
           class="block px-4 py-2 rounded hover:bg-[#14285c] <?= ($aktif ?? '') === 'dashboard' ? 'bg-[#14285c]' : '' ?>">
            Dashboard
        </a>
        <a href="portofolio.php"
           class="block px-4 py-2 rounded hover:bg-[#14285c] <?= ($aktif ?? '') === 'portofolio' ? 'bg-[#14285c]' : '' ?>">
            Kelola Portofolio
        </a>
        <a href="klien.php"
           class="block px-4 py-2 rounded hover:bg-[#14285c] <?= ($aktif ?? '') === 'klien' ? 'bg-[#14285c]' : '' ?>">
            Kelola Klien
        </a>
        <a href="layanan.php"
           class="block px-4 py-2 rounded hover:bg-[#14285c] <?= ($aktif ?? '') === 'layanan' ? 'bg-[#14285c]' : '' ?>">
            Kelola Layanan
        </a>
        <a href="profil.php"
           class="block px-4 py-2 rounded hover:bg-[#14285c] <?= ($aktif ?? '') === 'profil' ? 'bg-[#14285c]' : '' ?>">
            Kelola Profil
        </a>
    </nav>

    <div class="px-4 py-4 border-t border-blue-900 text-sm">
        <p class="text-blue-300 mb-2">Halo, <?= htmlspecialchars($_SESSION['admin_username'] ?? '') ?></p>
        <a href="logout.php" class="block text-center bg-red-600 py-2 rounded hover:bg-red-700 font-display">
            Logout
        </a>
    </div>
</aside>

<main class="flex-1 px-4 md:px-8 py-8 mt-14 md:mt-0">
