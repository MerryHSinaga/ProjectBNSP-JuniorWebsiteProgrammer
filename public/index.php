<?php
require_once '../app/db.php';
require_once '../app/functions.php';

// Ambil daftar lagu terbaru
$res = $conn->query("SELECT * FROM songs ORDER BY id DESC LIMIT 12");
$songs = [];
while ($row = $res->fetch_assoc()) {
    $songs[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Home - Cyrus</title>
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
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 50px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
      position: sticky;
      top: 0;
      z-index: 10;
    }
    header h1 {
      font-size: 26px;
      color: #f1c40f;
      margin: 0;
      letter-spacing: 1px;
    }
    nav {
      display: flex;
      gap: 25px;
    }
    nav a {
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s;
    }
    nav a:hover {
      color: #f1c40f;
    }

    
    .hero {
      text-align: center;
      padding: 80px 20px;
    }
    .hero h1 {
      font-size: 42px;
      color: #f1c40f;
      margin-bottom: 15px;
    }
    .hero p {
      font-size: 18px;
      margin-bottom: 25px;
    }
    .hero a {
      padding: 12px 25px;
      background: #f1c40f;
      color: #0d2348;
      font-weight: bold;
      text-decoration: none;
      border-radius: 6px;
      transition: background 0.3s;
    }
    .hero a:hover {
      background: #ffe066;
    }

    
    .song-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: 20px;
      padding: 20px 50px;
      justify-items: center;
    }
    .song-card {
      background: #1b3570;
      border-radius: 12px;
      overflow: hidden;
      width: 220px;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .song-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 14px rgba(0,0,0,0.4);
    }
    .song-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
    }
    .song-info {
      padding: 12px;
    }
    .song-info h4 {
      margin: 6px 0;
      color: #f1c40f;
      font-size: 18px;
    }
    .song-info p {
      margin: 0;
      font-size: 14px;
      color: #ddd;
    }
    .song-info a {
      display: inline-block;
      margin-top: 8px;
      padding: 6px 12px;
      background: #3498db;
      color: #fff;
      border-radius: 6px;
      text-decoration: none;
      font-size: 13px;
    }
    .song-info a:hover {
      background: #2980b9;
    }

    
    footer {
      text-align: center;
      padding: 20px;
      background: #081c3c;
      margin-top: 40px;
    }
    footer a {
      color: #f1c40f;
      margin: 0 10px;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
<header>
  <h1>🎸Cyrus</h1>
  <nav>
    <a href="index.php">Home</a>
    <a href="articles.php">Artikel</a>
    <a href="about.php">Tentang</a>
    <a href="contact.php">Kontak</a>
  </nav>
</header>

<section class="hero">
  <h1>Selamat Datang di Cyrus!</h1>
  <p>Temukan lirik lagu favoritmu dari berbagai artis dan genre dengan mudah.</p>
  <a href="articles.php">Lihat Lagu</a>
</section>

<section class="song-grid">
  <?php foreach ($songs as $song): ?>
    <div class="song-card">
      <img src="../assets/images/<?= e($song['image'] ?: 'default.jpg') ?>" alt="Thumbnail">
      <div class="song-info">
        <h4><?= e($song['title']) ?></h4>
        <p><?= e($song['artist']) ?></p>
        <a href="article_detail.php?id=<?= e($song['id']) ?>">Lihat Lirik</a>
      </div>
    </div>
  <?php endforeach; ?>
</section>

<footer style="text-align:center; padding:15px; font-size:13px; background:#081c3c; color:#ffffff;">
  &copy; <?= date('Y') ?> <span style="color:#ffffff;">Cyrus</span> | 
  <a href="https://instagram.com/merry.el.sinaga" target="_blank" style="color:#f1c40f; text-decoration:none;">Instagram</a> |
  <a href="https://wa.me/6281996950000" target="_blank" style="color:#f1c40f; text-decoration:none;">WhatsApp</a>
</footer>

</body>
</html>
