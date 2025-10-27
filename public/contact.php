<?php
require_once __DIR__ . '/../app/db.php';
require_once __DIR__ . '/../app/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if ($name && $email && $message) {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        $stmt->execute();

        header("Location: thankyou.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kontak - Cyrus</title>
<link rel="stylesheet" href="../assets/css/style.css">
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
}
nav a {
    color: #fff;
    margin: 0 10px;
    text-decoration: none;
    font-weight: bold;
}
main {
    max-width: 600px;
    margin: 40px auto;
    padding: 20px;
    background: rgba(255,255,255,0.05);
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}
h2, h3 {
    text-align: center;
    color: #f1c40f;
}
.social-icons {
    text-align: center;
    margin-bottom: 20px;
}
.social-icons a {
    display: inline-block;
    margin: 0 10px;
    padding: 10px 15px;
    border-radius: 8px;
    background: #3498db;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}
.social-icons a:hover {
    background: #2980b9;
}
form input, form textarea, form button {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: none;
    font-size: 14px;
}
form input, form textarea {
    background: #1b3570;
    color: #fff;
}
form button {
    background: #f1c40f;
    color: #0d2348;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}
form button:hover {
    background: #ffe066;
}
</style>
</head>
<body>
<header>
    <h1>🎸 CYRUS</h1>
    <nav>
        <a href="index.php">Home</a> |
        <a href="articles.php">Artikel</a> |
        <a href="about.php">Tentang</a> |
        <a href="contact.php">Kontak</a> |
        <a href="login.php">Login</a>
    </nav>
</header>

<main>
    <h2>Hubungi Kami</h2>
    <div class="social-icons">
        <a href="https://instagram.com/merry.el.sinaga" target="_blank">Instagram</a>
        <a href="https://wa.me/6281996953237" target="_blank">WhatsApp</a>
    </div>

    <h3>Sampaikan pesan Anda kepada Cyrus</h3>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Nama" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="message" placeholder="Pesan" rows="5" required></textarea>
        <button type="submit">Kirim</button>
    </form>
</main>
</body>
</html>
