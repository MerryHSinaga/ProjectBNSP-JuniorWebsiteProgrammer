<?php
require_once dirname(__DIR__, 2) . '/app/db.php';
require_once dirname(__DIR__, 2) . '/app/functions.php';

if (!isAdmin()) redirect('../login.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data lagu
$stmt = $conn->prepare("SELECT * FROM songs WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$song = $result->fetch_assoc();

if (!$song) {
    echo "<p style='color:white; text-align:center;'>Lagu tidak ditemukan.</p>";
    exit;
}

//Update Lagu
if (isset($_POST['update_song'])) {
    $title = trim($_POST['title']);
    $artist = trim($_POST['artist']);
    $lyrics = trim($_POST['lyrics']);

    // upload gambar baru jika ada
    $imageName = $song['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../assets/images/';
        $tmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        move_uploaded_file($tmpName, $uploadDir . $imageName);
    }

    $stmt = $conn->prepare("UPDATE songs SET title = ?, artist = ?, lyrics = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $title, $artist, $lyrics, $imageName, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Lagu - Cyrus</title>
  <link rel="stylesheet" href="../../assets/css/style.css">
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
      color: #f1c40f;
    }
    main {
      padding: 30px;
      max-width: 700px;
      margin: 0 auto;
    }
    form {
      background: rgba(255,255,255,0.05);
      padding: 25px;
      border-radius: 10px;
    }
    input, textarea, button {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 6px;
      border: none;
      font-size: 15px;
    }
    button {
      background: #f1c40f;
      color: #0d2348;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover { background: #ffe066; }
    img.preview {
      display: block;
      width: 200px;
      height: auto;
      margin-bottom: 10px;
      border-radius: 8px;
    }
  </style>
</head>
<body>
<header>
  <h1>✏️ Edit Lagu - CYRUS</h1>
  <nav>
    <a href="dashboard.php" style="color:#fff;">Kembali ke Dashboard</a>
    <a href="../admin/logout.php">Logout</a>
  </nav>
</header>

<main>
  <form method="POST" enctype="multipart/form-data">
    <label>Judul Lagu:</label>
    <input type="text" name="title" value="<?= e($song['title']) ?>" required>

    <label>Nama Penyanyi / Pencipta:</label>
    <input type="text" name="artist" value="<?= e($song['artist']) ?>" required>

    <label>Lirik Lagu:</label>
    <textarea name="lyrics" rows="5" required><?= e($song['lyrics']) ?></textarea>

    <label>Thumbnail Saat Ini:</label><br>
    <img src="../../assets/images/<?= e($song['image'] ?: 'default.jpg') ?>" class="preview">

    <label>Ganti Thumbnail (opsional):</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit" name="update_song">Simpan Perubahan</button>
  </form>
</main>
</body>
</html>
