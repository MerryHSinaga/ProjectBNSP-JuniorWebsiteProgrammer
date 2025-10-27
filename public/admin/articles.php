<?php
require_once '../app/db.php';
require_once '../app/functions.php';

$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM songs";
if ($search) {
    $search_param = "%$search%";
    $stmt = $conn->prepare("SELECT * FROM songs WHERE title LIKE ? OR artist LIKE ?");
    $stmt->bind_param("ss", $search_param, $search_param);
    $stmt->execute();
    $res = $stmt->get_result();
} else {
    $res = $conn->query("SELECT * FROM songs ORDER BY id DESC");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Artikel | Cyrus</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
  <h1>🎸 Cyrus</h1>
  <nav>
    <a href="index.php">Home</a> |
    <a href="articles.php">Artikel</a> |
    <a href="about.php">Tentang</a> |
    <a href="contact.php">Kontak</a> |
    <a href="login.php">Login</a>
  </nav>
</header>

<main>
<h2>Artikel / Lagu</h2>

<form method="GET" class="search-form">
  <input type="text" name="search" placeholder="Cari judul atau penyanyi..." value="<?= e($search) ?>">
  <button type="submit">Cari</button>
</form>

<div class="song-grid">
  <?php while ($row = $res->fetch_assoc()): ?>
    <div class="song-card">
      <?php if (!empty($row['image'])): ?>
        <img src="assets/images/<?= e($row['image']) ?>" class="thumb">
      <?php endif; ?>
      <h3><?= e($row['title']) ?></h3>
      <p><?= e($row['artist']) ?></p>
      <a href="song_detail.php?id=<?= e($row['id']) ?>">Lihat Lirik</a>
    </div>
  <?php endwhile; ?>
</div>
</main>
</body>
</html>
