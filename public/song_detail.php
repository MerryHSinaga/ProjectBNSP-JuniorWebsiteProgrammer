<?php
require_once '../app/db.php';
require_once '../app/functions.php';

$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM songs WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$song = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= e($song['title'] ?? 'Lirik Lagu') ?> | Cyrus</title>
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
<?php if ($song): ?>
  <h2><?= e($song['title']) ?></h2>
  <h4><?= e($song['artist']) ?></h4>
  <pre><?= e($song['lyrics']) ?></pre>
<?php else: ?>
  <p>Lagu tidak ditemukan.</p>
<?php endif; ?>
</main>
</body>
</html>
