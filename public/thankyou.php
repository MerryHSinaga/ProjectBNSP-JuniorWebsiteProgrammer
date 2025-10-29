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

/* HEADER */
header {
    background: #081c3c;
    padding: 15px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}


header h1 {
    margin: 0;
    font-size: 26px;
    color: #f1c40f;
    letter-spacing: 1px;
}


nav a {
    color: #fff;
    margin: 0 12px;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

nav a:hover {
    color: #f1c40f;
}


main {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 70vh;
}

.message-box {
    background: rgba(255, 255, 255, 0.05);
    padding: 40px 50px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.4);
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

/* Footer */
footer {
    text-align: center;
    padding: 15px;
    font-size: 13px;
    background: #081c3c;
    color: #ffffff;
}

footer a {
    color: #f1c40f;
    text-decoration: none;
    margin: 0 5px;
}

footer a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>
<header>
  <h1>🎸Cyrus</h1>
  <nav>
    <a href="index.php">Home</a> |
    <a href="articles.php">Artikel</a> |
    <a href="about.php">Tentang</a> |
    <a href="contact.php">Kontak</a>
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
  &copy; <?= date('Y') ?> <span style="color:#ffffff;">Cyrus</span> | 
  <a href="https://instagram.com/merry.el.sinaga" target="_blank">Instagram</a> |
  <a href="https://wa.me/6281996950000" target="_blank">WhatsApp</a>
</footer>
</body>
</html>
