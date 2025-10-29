<?php
require_once __DIR__ . '/../../app/db.php';
require_once __DIR__ . '/../../app/functions.php';

if (!isAdmin()) {
    header("Location: ../login.php");
    exit;
}

// === Hapus Pesan ===
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM contacts WHERE id = $id");
    header("Location: contactresponse.php");
    exit;
}

$res = $conn->query("SELECT * FROM contacts ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pesan Kontak - Admin</title>
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to bottom, #123458, #1a3a7a);
    color: #fff;
    margin: 0;
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


main {
    max-width: 900px;
    margin: 40px auto;
    padding: 25px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}
h2 {
    text-align: center;
    color: #f1c40f;
    margin-bottom: 25px;
}


.message-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
    max-height: 500px;
    overflow-y: auto;
    padding-right: 10px;
}
.message-card {
    background: #1b3570;
    border-radius: 10px;
    padding: 15px 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    position: relative;
}
.message-card strong {
    color: #f1c40f;
}
.message-card p {
    margin: 5px 0 0;
    color: #ddd;
}

.delete-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #e74c3c;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 5px 10px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.25s;
    text-decoration: none;
}
.delete-btn:hover {
    background: #c0392b;
}
</style>
</head>
<body>

<header>
    <h1>🎸Cyrus</h1>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="../admin/articles.php">Artikel</a>
        <a href="../admin/about_admin.php">Tentang</a>
        <a href="../admin/contactresponse.php">Kontak</a>
        <a href="../admin/logout.php">Logout</a>
    </nav>
</header>

<main>
    <h2>Pesan dari Pengunjung</h2>

    <?php if ($res->num_rows > 0): ?>
        <div class="message-list">
            <?php while($row = $res->fetch_assoc()): ?>
                <div class="message-card">
                    <strong><?= e($row['name']) ?></strong> (<?= e($row['email']) ?>)
                    <p><?= e($row['message']) ?></p>
                    <a href="?delete=<?= e($row['id']) ?>" class="delete-btn" onclick="return confirm('Hapus pesan ini?')">Hapus</a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p style="text-align:center;">Belum ada pesan masuk.</p>
    <?php endif; ?>
</main>
<footer style="text-align:center; padding:15px; font-size:13px; background:#081c3c; color:#ffffff;">
  &copy; <?= date('Y') ?> <span style="color:#ffffff;">Cyrus</span> | 
  <a href="https://instagram.com/merry.el.sinaga" target="_blank" style="color:#f1c40f; text-decoration:none;">Instagram</a> |
  <a href="https://wa.me/6281996950000" target="_blank" style="color:#f1c40f; text-decoration:none;">WhatsApp</a>
</footer>

</body>
</html>
