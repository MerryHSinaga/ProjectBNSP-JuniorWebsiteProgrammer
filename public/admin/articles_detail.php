<?php
require_once __DIR__ . '/../../app/db.php';
require_once __DIR__ . '/../../app/functions.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM songs WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$song = $result->fetch_assoc();

if (!$song) {
    echo "<p style='color:white; text-align:center;'>Lagu tidak ditemukan.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= e($song['title']) ?> - Cyrus</title>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom, #0d2348, #122b66);
      color: #fff;
      margin: 0;
    }
    header {
      background: #081c3c;
      padding: 20px;
      text-align: center;
      color: #f1c40f;
    }
    main {
      max-width: 800px;
      margin: 40px auto;
      padding: 20px;
      background: rgba(255,255,255,0.05);
      border-radius: 10px;
      text-align: center;
    }
    img.cover {
      width: 100%;
      max-width: 400px;
      height: auto;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    pre.lyrics {
      text-align: left;
      white-space: pre-wrap;
      line-height: 1.6;
      font-size: 16px;
      background: rgba(255,255,255,0.05);
      padding: 15px;
      border-radius: 8px;
    }
    .action-menu {
      margin-top: 20px;
    }
    .action-menu a {
      display: inline-block;
      margin: 0 8px;
      padding: 8px 14px;
      background: #f1c40f;
      color: #0d2348;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
      transition: 0.3s;
    }
    .action-menu a:hover { background: #ffe066; }
  </style>
</head>
<body>
<header>
  <h1>🎶 <?= e($song['title']) ?></h1>
</header>

<main>
  <img src="../../assets/images/<?= e($song['image'] ?: 'default.jpg') ?>" class="cover" alt="Cover Lagu">
  <h2><?= e($song['artist']) ?></h2>

  <pre class="lyrics"><?= e($song['lyrics']) ?></pre>

  <div class="action-menu">
    <a href="articles.php">Kembali</a>
    <a href="edit_song.php?id=<?= e($song['id']) ?>">Edit</a>
    <a href="delete_song.php?id=<?= e($song['id']) ?>" onclick="return confirm('Yakin ingin menghapus lagu ini?')">Hapus</a>
  </div>
</main>

</body>
</html>
,