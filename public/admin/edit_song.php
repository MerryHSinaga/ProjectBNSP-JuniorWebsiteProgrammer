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

// Update Lagu
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
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    header {
      background: #081c3c;
      padding: 12px 28px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .logo {
      color:#f1c40f;
      font-weight:700;
      font-size:20px;
    }
    nav a {
      color:#fff;
      margin-left:12px;
      text-decoration:none;
      font-weight:600;
      transition:color .2s ease;
    }
    nav a:hover { color:#f1c40f; }

    /* === Bagian utamanya === */
    main {
      flex: 1;
      padding: 40px 20px;
      max-width: 700px;
      margin: 0 auto;
      box-sizing: border-box;
    }
    form {
      background: rgba(255,255,255,0.03);
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.35);
    }
    label {
      font-weight:600;
      display:block;
      margin-top:10px;
      margin-bottom:4px;
    }
    input, textarea, button {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 8px;
      border: none;
      font-size: 15px;
      box-sizing: border-box;
    }
    input, textarea {
      background: rgba(255,255,255,0.12);
      color: #fff;
    }
    input::placeholder, textarea::placeholder { color: #e6e6e6cc; }
    button {
      background: #f1c40f;
      color: #0d2348;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }
    button:hover { background: #ffe066; }
    img.preview {
      display: block;
      width: 200px;
      height: auto;
      margin-bottom: 10px;
      border-radius: 8px;
      border:2px solid rgba(255,255,255,0.12);
    }

    footer {
      background:#081c3c;
      padding:14px 0;
      text-align:center;
      color:#ccc;
      margin-top:30px;
    }
    footer a {
      color:#f1c40f;
      text-decoration:none;
    }
  </style>
</head>
<body>
<header>
  <div class="logo">🎸Cyrus</div>
  <nav>
    <a href="dashboard.php">Dashboard</a>
    <a href="../admin/articles.php">Artikel</a>
    <a href="../admin/about_admin.php">Tentang</a>
    <a href="../admin/contactresponse.php">Kontak</a>
    <a href="../admin/logout.php">Logout</a>
  </nav>
</header>

<main>
  <h2 style="color:#f1c40f; text-align:center;">Edit Lagu / Lirik</h2>
  <form method="POST" enctype="multipart/form-data">
    <label>Judul Lagu:</label>
    <input type="text" name="title" value="<?= e($song['title']) ?>" required>

    <label>Nama Penyanyi / Pencipta:</label>
    <input type="text" name="artist" value="<?= e($song['artist']) ?>" required>

    <label>Lirik Lagu:</label>
    <textarea name="lyrics" rows="5" required><?= e($song['lyrics']) ?></textarea>

    <label>Thumbnail:</label>
    <img src="../../assets/images/<?= e($song['image'] ?: 'default.jpg') ?>" class="preview">

    <label>Ganti Thumbnail (opsional):</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit" name="update_song">Simpan Perubahan</button>
  </form>
</main>

<footer>
  &copy; <?= date('Y') ?> Cyrus |
  <a href="https://instagram.com/merry.el.sinaga" target="_blank">Instagram</a> |
  <a href="https://wa.me/6281996950000" target="_blank">WhatsApp</a>
</footer>
</body>
</html>
