<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tentang Kami - Cyrus</title>
<link rel="stylesheet" href="../assets/css/style.css">
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to bottom, #0d2348, #122b66);
    color: #fff;
    margin: 0;
    padding: 0;
}

header {
    background: #081c3c;
    padding: 20px;
    text-align: center;
}

header h1 {
    color: #f1c40f;
    margin: 0;
    font-size: 28px;
}

nav {
    margin-top: 10px;
}

nav a {
    color: #fff;
    text-decoration: none;
    margin: 0 12px;
    font-weight: bold;
    transition: color 0.3s;
}

nav a:hover {
    color: #f1c40f;
}

main {
    max-width: 900px;
    margin: 40px auto;
    padding: 20px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
}

main h2 {
    color: #f1c40f;
    text-align: center;
    margin-bottom: 20px;
    font-size: 32px;
}

.about-container {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 20px;
}

.about-text {
    flex: 1 1 300px;
    font-size: 16px;
    line-height: 1.7;
    text-align: justify;
}

.about-text strong {
    color: #ffe066;
}

.about-photo {
    flex: 0 0 200px;
    border-radius: 12px;
    overflow: hidden;
}

.about-photo img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.5);
}

footer {
    text-align: center;
    margin: 40px 0;
    font-size: 14px;
    color: #ccc;
}

/* Responsif untuk mobile */
@media (max-width: 700px) {
    .about-container {
        flex-direction: column;
        align-items: center;
    }
    .about-text {
        text-align: center;
    }
}
</style>
</head>
<body>
<header>
    <h1>🎸 CYRUS</h1>
    <nav>
        <a href="index.php">Home</a> |
        <a href="articles.php">Artikel</a> |
        <a href="about.php">Tentang</a> |
        <a href="contact.php">Kontak</a> |
        <a href="login.php">Login</a>
    </nav>
</header>

<main>
    <h2>Tentang Kami</h2>
    <div class="about-container">
        <div class="about-photo">
            <img src="../assets/images/merry.jpg" alt="Foto Merry Helty Sinaga">
        </div>
        <div class="about-text">
            <p>
                <strong>Cyrus</strong> adalah website yang diciptakan khusus bagi para pecinta musik untuk menemukan dan menikmati lirik lagu dari berbagai genre dan artis. Di sini, pengguna dapat dengan mudah mencari lirik lagu favorit mereka, membaca lirik secara lengkap, dan memahami makna dari setiap baitnya. Website ini dirancang dengan antarmuka yang sederhana dan responsif sehingga pengalaman menjelajah lirik menjadi lebih nyaman, baik melalui komputer maupun perangkat mobile.
            </p>
            <p>
                Cyrus juga memberikan kemudahan bagi pengunjung untuk menemukan lagu baru melalui fitur pencarian dan kategori, menjadikannya sumber informasi lirik yang cepat, akurat, dan menyenangkan bagi semua penggemar musik.
            </p>
            <p>
                Dibuat oleh <strong>Merry Helty Sinaga</strong> sebagai bagian dari proyek sertifikasi BSNP.
            </p>
        </div>
    </div>
</main>

<footer>
    &copy; 2025 Cyrus. All rights reserved.
</footer>
</body>
</html>
