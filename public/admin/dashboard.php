<?php
require_once dirname(__DIR__, 2) . '/app/db.php';
require_once dirname(__DIR__, 2) . '/app/functions.php';

if (!isAdmin()) redirect('../login.php');

// === Tambah Lagu ===
if (isset($_POST['add_song'])) {
    $title = trim($_POST['title']);
    $artist = trim($_POST['artist']);
    $lyrics = trim($_POST['lyrics']);
    $imageName = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../assets/images/';
        $tmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        move_uploaded_file($tmpName, $uploadDir . $imageName);
    }

    if (!empty($title) && !empty($artist) && !empty($lyrics)) {
        $stmt = $conn->prepare("INSERT INTO songs (title, artist, lyrics, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $artist, $lyrics, $imageName);
        $stmt->execute();
    }
}

// === Hapus Lagu ===
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM songs WHERE id = $id");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - Cyrus</title>
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
    nav a {
      color: #fff;
      margin: 0 10px;
      text-decoration: none;
      font-weight: bold;
    }
    main {
      padding: 30px;
      max-width: 1100px;
      margin: 0 auto;
    }
    .admin-section {
      margin-bottom: 40px;
      background: rgba(255,255,255,0.05);
      border-radius: 10px;
      padding: 20px;
    }
    .admin-form input, .admin-form textarea, .admin-form button {
      width: 100%;
      max-width: 600px;
      padding: 10px;
      border-radius: 6px;
      border: none;
      margin-bottom: 10px;
      font-size: 15px;
    }
    .admin-form button {
      background: #f1c40f;
      color: #0d2348;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }
    .admin-form button:hover { background: #ffe066; }

    /* === GRID LAGU === */
    .song-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .song-card {
      background: #1b3570;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
      text-align: center;
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
    .song-actions {
      display: flex;
      justify-content: center;
      gap: 8px;
      margin-top: 10px;
    }
    .song-actions a {
      text-decoration: none;
      padding: 6px 10px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: bold;
      transition: 0.2s;
    }
    .btn-view { background: #3498db; color: #fff; }
    .btn-edit { background: #f1c40f; color: #000; }
    .btn-delete { background: #e74c3c; color: #fff; }
    .btn-view:hover { background: #2980b9; }
    .btn-edit:hover { background: #ffe066; }
    .btn-delete:hover { background: #c0392b; }
  </style>
</head>
<body>
<header>
  <h1>🎸 Dashboard Admin - CYRUS</h1>
  <nav>
    <a href="../index.php">Home</a> |
    <a href="../articles.php">Artikel</a> |
    <a href="../about.php">Tentang</a> |
    <a href="../admin/contactresponse.php">Kontak</a> |
    <a href="../logout.php">Logout</a>

  </nav>
</header>

<main>
  <section class="admin-section">
    <h2>🎵 Tambah Lagu / Lirik</h2>
    <form method="POST" enctype="multipart/form-data" class="admin-form">
      <label>Judul Lagu:</label>
      <input type="text" name="title" required>

      <label>Nama Penyanyi / Pencipta:</label>
      <input type="text" name="artist" required>

      <label>Lirik Lagu:</label>
      <textarea name="lyrics" rows="5" required></textarea>

      <label>Gambar Thumbnail (opsional):</label>
      <input type="file" name="image" accept="image/*">

      <button type="submit" name="add_song">Tambah Lagu</button>
    </form>
  </section>

  <section class="admin-section">
    <h3>📋 Daftar Lagu</h3>
    <div class="song-grid">
      <?php
      $res = $conn->query("SELECT * FROM songs ORDER BY id DESC");
      while ($row = $res->fetch_assoc()):
      ?>
        <div class="song-card">
          <img src="../../assets/images/<?= e($row['image'] ?: 'default.jpg') ?>" alt="Thumbnail">
          <div class="song-info">
            <h4><?= e($row['title']) ?></h4>
            <p><?= e($row['artist']) ?></p>
            <div class="song-actions">
              <a href="../article_detail.php?id=<?= e($row['id']) ?>" class="btn-view">👁️ Lihat</a>
              <a href="edit_song.php?id=<?= e($row['id']) ?>" class="btn-edit">✏️ Edit</a>
              <a href="?delete=<?= e($row['id']) ?>" class="btn-delete" onclick="return confirm('Hapus lagu ini?')">🗑️ Hapus</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
</main>
</body>
</html>
