<?php
// Mulai session
if (session_status() === PHP_SESSION_NONE) session_start();

// Load database dan fungsi
require_once __DIR__ . '/../../app/db.php';
require_once __DIR__ . '/../../app/functions.php';

// Ambil query search
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
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    background: linear-gradient(to bottom, #123458, #1a3a7a);
    color: #fff;
}


header {
    background: #0d2348;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 40px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

header h1 {
    font-size: 26px;
    font-weight: bold;
    margin: 0;
    color: #f1c40f;
    letter-spacing: 2px;
}

nav a {
    color: #fff;
    margin-left: 18px;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s;
}

nav a:hover {
    color: #f1c40f;
}


.search-bar {
    margin: 25px auto;
    text-align: center;
}

.search-bar input {
    padding: 10px;
    width: 280px;
    border-radius: 6px;
    border: none;
    font-size: 16px;
}

.search-bar button {
    padding: 10px 18px;
    border-radius: 6px;
    border: none;
    background: #f1c40f;
    color: #123458;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
}

.search-bar button:hover {
    background: #ffd447;
}

.song-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, 220px);
    gap: 20px;
    justify-content: center;
    padding: 20px;
}

.song-card {
    background: #123458;
    color: #fff;
    border-radius: 12px;
    padding: 12px;
    text-align: center;
    cursor: pointer;
    transition: transform 0.25s, box-shadow 0.25s;
    box-shadow: 0 4px 10px rgba(0,0,0,0.25);
}

.song-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.35);
}

.song-card img {
    width: 100%;
    height: 140px;
    object-fit: cover;
    border-radius: 10px;
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
    color: #ddd;
}
</style>
</head>
<body>

<!-- HEADER -->
<header>
    <h1>🎸Cyrus</h1>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="../admin/articles.php">Artikel</a>
        <a href="about_admin.php">Tentang</a>
        <a href="contactresponse.php">Kontak</a>
        <a href="../admin/logout.php">Logout</a>
    </nav>
</header>

<!-- SEARCH BAR -->
<div class="search-bar">
    <form method="GET" action="articles.php">
        <input type="text" name="search" placeholder="Cari judul lagu atau penyanyi..." value="<?= e($search) ?>">
        <button type="submit">Cari</button>
    </form>
</div>

<!-- KOTAK LAGU -->
<div class="song-grid">
    <?php if ($res && $res->num_rows > 0): ?>
        <?php while($row = $res->fetch_assoc()): ?>
            <div class="song-card" onclick="window.location='../admin/articles_detail.php?id=<?= e($row['id']) ?>'">
                <?php if (!empty($row['image'])): ?>
                    <img src="../../assets/images/<?= e($row['image']) ?>" alt="Thumbnail">
                <?php else: ?>
                    <img src="../../assets/images/default.jpg" alt="Thumbnail">
                <?php endif; ?>
                <h3><?= e($row['title']) ?></h3>
                <p><?= e($row['artist']) ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center; grid-column:1/-1;">Tidak ada lagu ditemukan.</p>
    <?php endif; ?>
</div>
<footer style="text-align:center; padding:15px; font-size:13px; background:#081c3c; color:#ffffff;">
  &copy; <?= date('Y') ?> <span style="color:#ffffff;">Cyrus</span> | 
  <a href="https://instagram.com/merry.el.sinaga" target="_blank" style="color:#f1c40f; text-decoration:none;">Instagram</a> |
  <a href="https://wa.me/6281996950000" target="_blank" style="color:#f1c40f; text-decoration:none;">WhatsApp</a>
</footer>

</body>
</html>
