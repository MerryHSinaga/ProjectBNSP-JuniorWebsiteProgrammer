<?php
require_once dirname(__DIR__, 2) . '/app/db.php';
require_once dirname(__DIR__, 2) . '/app/functions.php';

if (!isAdmin()) redirect('../admin/login.php');

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
      padding: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

  
    header {
      background: #081c3c;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 3px 6px rgba(0,0,0,0.3);
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
      color: #f1c40f;
      letter-spacing: 1px;
    }

    nav a {
      color: #fff;
      margin: 0 12px;
      text-decoration: none;
      font-weight: 600;
      transition: 0.3s;
    }

    nav a:hover {
      color: #f1c40f;
    }

  
    main {
      flex: 1;
      max-width: 1100px;
      margin: 40px auto;
      padding: 0 20px;
    }

    .admin-section {
      background: rgba(255,255,255,0.05);
      border-radius: 10px;
      padding: 25px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      margin-bottom: 40px;
    }

    .admin-section h2, .admin-section h3 {
      color: #f1c40f;
      margin-bottom: 15px;
      text-align: left;
    }

    /* === FORM === */
    .admin-form {
      display: flex;
      flex-direction: column;
      gap: 15px;
      max-width: 600px;
    }

    .admin-form label {
      font-weight: 600;
      margin-bottom: 5px;
      color: #f9f9f9;
    }

    .admin-form input[type="text"],
    .admin-form textarea,
    .admin-form input[type="file"] {
      width: 100%;
      padding: 10px 12px;
      border-radius: 6px;
      border: none;
      outline: none;
      font-size: 15px;
      color: #f1f1f1ff;
    }

    .admin-form textarea {
      resize: vertical;
    }

    .admin-form button {
      width: 180px;
      background: #f1c40f;
      color: #0d2348;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      padding: 10px;
      cursor: pointer;
      transition: 0.3s;
      align-self: flex-start;
    }

    .admin-form button:hover {
      background: #ffe066;
    }

   
    .song-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
      gap: 20px;
    }

    .song-card {
      background: #1b3570;
      border-radius: 12px;
      overflow: hidden;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .song-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 14px rgba(0,0,0,0.4);
    }

    .song-card img {
      width: 100%;
      height: 160px;
      object-fit: cover;
    }

    .song-info {
      padding: 12px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 6px;
    }

    .song-info h4 {
      background: #f1c40f;
      color: #0d2348;
      border-radius: 8px;
      padding: 6px 10px;
      margin: 5px 0;
      font-size: 18px;
      width: fit-content;
    }

    .song-info p {
      background: rgba(255,255,255,0.1);
      padding: 5px 8px;
      border-radius: 6px;
      margin: 0;
      font-size: 14px;
      color: #ffffffff;
      width: fit-content;
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

    footer {
      text-align: center;
      color: #ccc;
      padding: 15px;
      font-size: 13px;
      background: #081c3c;
      margin-top: auto;
    }

    footer a {
      color: #f1c40f;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<header>
  <div class="logo">CYRUS</div>
  <nav>
    <a href="dashboard.php">Dashboard</a>
    <a href="../admin/articles.php">Artikel</a>
    <a href="../admin/about_admin.php">Tentang</a>
    <a href="../admin/contactresponse.php">Kontak</a>
    <a href="../admin/logout.php">Logout</a>
  </nav>
</header>

<main>
  <section class="admin-section">
    <h2>🎵 Tambah Lagu / Lirik</h2>
    <form method="POST" enctype="multipart/form-data" class="admin-form">
      <div>
        <label>Judul Lagu:</label>
        <input type="text" name="title" required>
      </div>

      <div>
        <label>Nama Penyanyi / Pencipta:</label>
        <input type="text" name="artist" required>
      </div>

      <div>
        <label>Lirik Lagu:</label>
        <textarea name="lyrics" rows="6" required></textarea>
      </div>

      <div>
        <label>Gambar Thumbnail (opsional):</label>
        <input type="file" name="image" accept="image/*">
      </div>

      <button type="submit" name="add_song">Tambah Lagu</button>
    </form>
  </section>

  <section class="admin-section">
    <h3>📜 Daftar Lagu</h3>
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
              <a href="../admin/articles_detail.php?id=<?= e($row['id']) ?>" class="btn-view">Lihat</a>
              <a href="edit_song.php?id=<?= e($row['id']) ?>" class="btn-edit">Edit</a>
              <a href="?delete=<?= e($row['id']) ?>" class="btn-delete" onclick="return confirm('Hapus lagu ini?')">Hapus</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<footer>
  &copy; <?= date('Y') ?> Cyrus |
  <a href="https://instagram.com/merry.el.sinaga" target="_blank">Instagram</a> |
  <a href="https://wa.me/6281996953237" target="_blank">WhatsApp</a>
</footer>

</body>
</html>
