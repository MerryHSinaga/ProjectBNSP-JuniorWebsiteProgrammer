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
    nav a {
        color: #fff;
        margin: 0 10px;
        text-decoration: none;
        font-weight: bold;
    }
    nav a:hover {
        color: #ffe066;
    }
    main {
        max-width: 900px;
        margin: 30px auto;
        padding: 20px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
    }
    h2 {
        text-align: center;
        color: #f1c40f;
    }
    .message-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
        max-height: 500px;
        overflow-y: auto;
        margin-top: 20px;
        padding-right: 10px;
    }
    .message-card {
        background: #1b3570;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        position: relative;
    }
    .message-card strong {
        color: #f1c40f;
    }
    .message-card p {
        margin: 5px 0 0 0;
        color: #ddd;
    }
    .delete-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #e74c3c;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 5px 10px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.2s;
        text-decoration: none;
    }
    .delete-btn:hover {
        background: #c0392b;
    }
    .back-home {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background: #f1c40f;
        color: #0d2348;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        transition: 0.2s;
    }
    .back-home:hover {
        background: #ffe066;
    }
</style>
</head>
<body>
<header>
    <h1>🎸 Pesan Kontak - Admin</h1>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="../admin/logout.php">Logout</a>
    </nav>
</header>

<main>
    <h2>Pesan dari Pengunjung</h2>

    <?php if($res->num_rows > 0): ?>
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

    <div style="text-align:center;">
        <a href="../index.php" class="back-home">🏠 Kembali ke Home</a>
    </div>
</main>
</body>
</html>
