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
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header h1 {
    color: #f1c40f;
    margin: 0;
    font-size: 28px;
}

nav a {
    color: #fff;
    text-decoration: none;
    margin-left: 20px;
    font-weight: bold;
    transition: color 0.3s;
}

nav a:hover {
    color: #fffdfdff;
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
    margin-bottom: 30px;
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
    flex: 0 0 220px;
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

//responsibel untuk ukuran mobie
@media (max-width: 700px) {
    header {
        flex-direction: column;
        align-items: center;
    }
    nav {
        margin-top: 10px;
    }
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
    <h1>🎸CYRUS</h1>
    <nav>
         <a href="dashboard.php">Dashboard</a> |
        <a href="../admin/articles.php">Artikel</a>
        <a href="../admin/about_admin.php">Tentang</a>
        <a href="../admin/contactresponse.php">Kontak</a>
        <a href="../admin/logout.php">Logout</a>
    </nav>
</header>

<main>
    <h2>Tentang Kami</h2>
    <div class="about-container">
        <div class="about-photo">
            <img src="../../assets/images/foto2.jpg" alt="Foto Merry Helty Sinaga">
        </div>
        <div class="about-text">
            <p>
                <strong>Cyrus</strong> adalah website bagi pecinta musik untuk menemukan dan menikmati lirik lagu dari berbagai genre dan artis. Pengguna dapat mencari lirik favorit, membaca lirik lengkap, dan memahami makna tiap bait. Website ini dirancang responsif dan nyaman digunakan di komputer maupun mobile.
            </p>
            <p>
                Cyrus juga memudahkan pengunjung menemukan lagu baru melalui fitur pencarian dan kategori, menjadikannya sumber informasi lirik yang cepat, akurat, dan menyenangkan bagi penggemar musik.
            </p>
            <p>
                Dibuat oleh <strong>Merry Helty Sinaga</strong> sebagai bagian dari proyek sertifikasi BSNP.
            </p>
        </div>
    </div>
</main>

<footer>
  &copy; <?= date('Y') ?> Cyrus | 
  <a href="https://instagram.com/merry.el.sinaga" target="_blank">Instagram</a> |
  <a href="https://wa.me/6281996953237" target="_blank">WhatsApp</a>
</footer>

</body>
</html>
