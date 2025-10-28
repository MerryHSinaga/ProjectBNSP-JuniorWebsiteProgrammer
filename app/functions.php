<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login
function isLoggedIn(): bool {
    return isset($_SESSION['user']);
}


function isAdmin(): bool {
    return isLoggedIn() && isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';
}

function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Redirect ke URL tertentu
function redirect(string $url): void {
    header("Location: $url");
    exit;
}

// Mengambil nama user yang login
function getUserName(): ?string {
    return isLoggedIn() && isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : null;
}
?>
