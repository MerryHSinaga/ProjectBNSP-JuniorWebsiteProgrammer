<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Terima Kasih - Cyrus</title>
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
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 70vh;
}

.message-box {
    background: rgba(255, 255, 255, 0.05);
    padding: 30px 40px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

.message-box h2 {
    color: #f1c40f;
    margin-bottom: 15px;
}

.message-box p {
    color: #ddd;
    margin-bottom: 25px;
    font-size: 16px;
}

.message-box a {
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 8px;
    background: #f1c40f;
    color: #0d2348;
    font-weight: bold;
    transition: 0.3s;
}

.message-box a:hover {
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
  </nav>
</header>

<main>
  <div class="message-box">
    <h2>Terima Kasih atas Pesan Anda!</h2>
    <p>Kami akan segera menindaklanjuti pesan Anda.</p>
    <a href="index.php">Kembali ke Home</a>
  </div>
</main>
<footer>
  &copy; <?= date('Y') ?> Cyrus | 
  <a href="https://instagram.com/merry.el.sinaga" target="_blank">Instagram</a> |
  <a href="https://wa.me/6281996953237" target="_blank">WhatsApp</a>
</footer>

</body>
</html>
