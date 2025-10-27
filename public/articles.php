<?php
require_once __DIR__ . '/../app/db.php';
require_once __DIR__ . '/../app/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
<title>Artikel / Lirik Lagu - Cyrus</title>
<link rel="stylesheet" href="../assets/css/style.css">
<style>
    body {
        font-family: sans-serif;
        margin: 0;
        background: linear-gradient(to bottom, #123458, #1a3a7a);
        color: #fff;
    }
    header {
        background: #0d2348;
        color: #fff;
        padding: 20px 0;
        text-align: center;
    }
    header h1 { margin: 0; font-size: 32px; }
    nav a {
        color: #fff;
        margin: 0 12px;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.2s;
    }
    nav a:hover { color: #f1c40f; }
    .search-bar {
        margin: 25px auto;
        text-align: center;
    }
    .search-bar input {
        padding: 10px;
        width: 250px;
        border-radius: 5px;
        border: none;
        font-size: 16px;
    }
    .search-bar button {
        padding: 10px 15px;
        border-radius: 5px;
        border: none;
        background: #f1c40f;
        color: #123458;
        font-weight: bold;
        cursor: pointer;
    }
    .song-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, 220px);
        gap: 15px;
        justify-content: center;
        padding: 20px;
    }
    .song-card {
        background: #123458;
        color: #fff;
        border-radius: 10px;
        padding: 12px;
        text-align: center;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 6px rgba(0,0,0,0.25);
    }
    .song-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.35);
    }
    .song-card img {
        width: 100%;
        height: 140px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
        border: 2px solid #fff;
    }
    .song-card h3 {
        margin: 5px 0;
        color: #f1c40f;
        font-size: 18px;
    }
    .song-card p {
        margin: 0;
        font-size: 14px;
        color: #eee;
    }
</style>
</head>
<body>
<header>
    <h1>🎸 CYRUS</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="articles.php">Artikel</a>
        <a href="about.php">Tentang</a>
        <a href="contact.php">Kontak</a>
        <?php if (isLoggedIn()): ?>
            | <a href="admin/dashboard.php">Dashboard</a>
            | <a href="logout.php" onclick="return confirm('Logout?')">Logout</a>
        <?php else: ?>
            | <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>

<div class="search-bar">
    <form method="GET" action="articles.php">
        <input type="text" name="search" placeholder="Cari judul lagu atau penyanyi..." value="<?= e($search) ?>">
        <button type="submit">Cari</button>
    </form>
</div>

<div class="song-grid">
    <?php if ($res && $res->num_rows > 0): ?>
        <?php while($row = $res->fetch_assoc()): ?>
            <div class="song-card" onclick="window.location='article_detail.php?id=<?= e($row['id']) ?>'">
                <?php if (!empty($row['image'])): ?>
                    <img src="../assets/images/<?= e($row['image']) ?>" alt="Thumbnail">
                <?php else: ?>
                    <img src="../assets/images/default.jpg" alt="Thumbnail">
                <?php endif; ?>
                <h3><?= e($row['title']) ?></h3>
                <p><?= e($row['artist']) ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center; grid-column:1/-1;">Tidak ada lagu ditemukan.</p>
    <?php endif; ?>
</div>
</body>
</html>
