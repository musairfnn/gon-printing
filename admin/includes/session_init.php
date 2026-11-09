<?php
// Paksa PHP simpan data session di folder milik project sendiri,
// supaya tidak gagal gara-gara folder session default sistem tidak bisa ditulis.
$sessionPath = __DIR__ . '/../../tmp_sessions';

if (!is_dir($sessionPath)) {
    mkdir($sessionPath, 0777, true);
}

session_save_path($sessionPath);
session_start();
?>
