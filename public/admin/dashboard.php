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
        $fileType = mime_content_type($_FILES['image']['tmp_name']);
        if (!str_starts_with($fileType, 'image/')) {
            die("File yang diunggah harus berupa gambar (jpg, png, dll).");
        }

        $uploadDir = '../../assets/images/';
        $tmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        move_uploaded_file($tmpName, $uploadDir . $imageName);
    } else {
        die("Gambar thumbnail wajib diunggah.");
    }

    if (!empty($title) && !empty($artist) && !empty($lyrics) && !empty($imageName)) {
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

// === Search Lagu ===
$search = trim($_GET['search'] ?? '');
if (!empty($search)) {
    $stmt = $conn->prepare("SELECT * FROM songs WHERE title LIKE ? OR artist LIKE ? ORDER BY id DESC");
    $keyword = "%$search%";
    $stmt->bind_param("ss", $keyword, $keyword);
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
  <title>Dashboard Admin - Cyrus</title>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom, #0d2348, #122b66);
      color: #fff;
      margin: 0;
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
    .logo { color:#f1c40f; font-weight:700; font-size:20px; }
    nav a { color:#fff; margin-left:12px; text-decoration:none; font-weight:600; }
    nav a:hover { color:#f1c40f; }

    main {
      flex: 1;
      max-width: 1200px;
      margin: 30px auto;
      padding: 0 20px;
      box-sizing: border-box;
    }

    .columns {
      display: flex;
      gap: 28px;
      align-items: flex-start;
    }

    .col-left {
      width: 360px;
      min-width: 300px;
      background: rgba(255,255,255,0.03);
      padding: 20px;
      border-radius: 10px;
    }

    .col-left h2 { color:#f1c40f; margin-top:0; }

    .admin-form {
      display:flex;
      flex-direction:column;
      gap:12px;
    }
    .admin-form label { font-weight:600; margin-bottom:6px; display:block; color:#fff; }
    .admin-form input[type="text"],
    .admin-form textarea,
    .admin-form input[type="file"] {
      padding:10px;
      border-radius:8px;
      border: none;
      background: rgba(255,255,255,0.12);
      color: #fff;
      font-size:14px;
      width:100%;
      box-sizing:border-box;
    }
    .admin-form textarea { min-height:140px; resize:vertical; }
    .admin-form input::placeholder, .admin-form textarea::placeholder { color: #e6e6e6cc; }
    .admin-form button {
      background:#f1c40f;
      color:#0d2348;
      border:none;
      padding:10px 14px;
      font-weight:700;
      border-radius:8px;
      cursor:pointer;
    }
    .admin-form button:hover { background:#ffe066; }

    /* kanan:*/
    .col-right {
      flex:1;
      background: rgba(255,255,255,0.03);
      padding: 20px;
      border-radius: 10px;
      box-sizing: border-box;
    }

    .col-right h3 { color:#f1c40f; margin-top:0; }

    .search-bar { text-align:center; margin-bottom:18px; }
    .search-bar form { display:inline-flex; gap:8px; align-items:center; }
    .search-bar input[type="text"] {
      padding:10px 12px;
      width:420px;
      border-radius:8px;
      border:none;
      outline:none;
      background:#fff;
      color:#123458;
    }
    .search-bar button {
      background:#f1c40f;
      border:none;
      padding:10px 14px;
      border-radius:8px;
      font-weight:700;
      cursor:pointer;
      color:#123458;
    }

    .song-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap:24px;
      align-items:start;
    }

    .song-card {
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      border-radius:10px;
      padding:12px;
      text-align:center;
      box-shadow: 0 6px 18px rgba(0,0,0,0.35);
      transition: transform .18s ease, box-shadow .18s ease;
      display:flex;
      flex-direction:column;
      gap:10px;
    }
    .song-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 28px rgba(0,0,0,0.45);
    }
    .song-card img {
      width:100%;
      height:140px;
      object-fit:cover;
      border-radius:8px;
      border:2px solid rgba(255,255,255,0.12);
    }
    .song-card h3 { margin:0; color:#f1c40f; font-size:16px; }
    .song-card p { margin:0; color:#e6e6e6; font-size:14px; }
    .song-actions { margin-top:auto; display:flex; gap:8px; justify-content:center; }
    .song-actions a { padding:6px 10px; border-radius:6px; text-decoration:none; font-weight:600; color:#fff; }
    .btn-view { background:#3498db; } .btn-edit { background:#f1c40f; color:#000; } .btn-delete { background:#e74c3c; }

    footer { background:#081c3c; padding:14px 0; text-align:center; color:#ccc; margin-top:30px; }
    footer a { color:#f1c40f; text-decoration:none; }

    @media (max-width: 920px) {
      .columns { flex-direction:column; }
      .col-left, .col-right { width:100%; min-width:unset; }
      .search-bar input { width: 70vw; max-width: 420px; }
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
  <div class="columns">
    <div class="col-left">
      <h2>Tambah Lagu / Lirik</h2>
      <form method="POST" enctype="multipart/form-data" class="admin-form">
        <label for="title">Judul Lagu:</label>
        <input id="title" type="text" name="title" required placeholder="Masukkan judul lagu...">

        <label for="artist">Nama Penyanyi / Pencipta:</label>
        <input id="artist" type="text" name="artist" required placeholder="Masukkan nama artis...">

        <label for="lyrics">Lirik Lagu:</label>
        <textarea id="lyrics" name="lyrics" required placeholder="Masukkan lirik lagu..."></textarea>

        <label for="image">Gambar lagu:</label>
        <input id="image" type="file" name="image" accept="image/*" required>

        <button type="submit" name="add_song">Tambah Lagu</button>
      </form>
    </div>

    <div class="col-right">
      <h3>Daftar Lagu</h3>

      <div class="search-bar">
        <form method="GET" action="">
          <input type="text" name="search" placeholder="Cari judul lagu atau penyanyi..." value="<?= e($search) ?>">
          <button type="submit">Cari</button>
        </form>
      </div>

      <div class="song-grid">
        <?php if ($res && $res->num_rows > 0): ?>
          <?php while ($row = $res->fetch_assoc()): ?>
            <div class="song-card">
              <img src="../../assets/images/<?= e($row['image'] ?: 'default.jpg') ?>" alt="Thumbnail">
              <h3><?= e($row['title']) ?></h3>
              <p><?= e($row['artist']) ?></p>
              <div class="song-actions">
                <a class="btn-view" href="../admin/articles_detail.php?id=<?= e($row['id']) ?>">Lihat</a>
                <a class="btn-edit" href="edit_song.php?id=<?= e($row['id']) ?>">Edit</a>
                <a class="btn-delete" href="?delete=<?= e($row['id']) ?>" onclick="return confirm('Hapus lagu ini?')">Hapus</a>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p style="text-align:center; color:#ddd;">Tidak ada lagu ditemukan.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</main>

<footer>
  &copy; <?= date('Y') ?> Cyrus |
  <a href="https://instagram.com/merry.el.sinaga" target="_blank">Instagram</a> |
  <a href="https://wa.me/6281996950000" target="_blank">WhatsApp</a>
</footer>

</body>
</html>
