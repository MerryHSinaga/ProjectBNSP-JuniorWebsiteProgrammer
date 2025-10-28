<?php
// Hubungkan ke database 
require_once __DIR__ . '/../app/db.php';
require_once __DIR__ . '/../app/functions.php';

// Proses kirim pesan
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
    font-size: 26px;
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
    max-width: 1000px;
    margin: 60px auto;
    padding: 40px 20px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: space-between;
    gap: 40px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.4);
}


.contact-form {
    flex: 1 1 420px;
}

.contact-form h3 {
    color: #f1c40f;
    text-align: center;
    margin-bottom: 25px;
    font-size: 22px;
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

form input::placeholder,
form textarea::placeholder {
    color: #ccc;
}

form textarea {
    resize: none;
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


.contact-info {
    flex: 1 1 400px;
    text-align: left;
}

.contact-info h2 {
    color: #f1c40f;
    margin-bottom: 15px;
    text-align: center;
}

.contact-info p {
    font-size: 15px;
    line-height: 1.6;
    color: #eee;
    text-align: center;
}

.social-icons {
    margin-top: 25px;
    text-align: center;
}

.social-icons a {
    display: inline-block;
    margin: 6px 10px;
    padding: 10px 18px;
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


@media (max-width: 768px) {
    main {
        flex-direction: column;
        text-align: center;
        padding: 25px;
    }

    .contact-info, .contact-form {
        flex: 1 1 100%;
    }
}
</style>
</head>

<body>
<header>
    <div class="logo">CYRUS</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="articles.php">Artikel</a>
        <a href="about.php">Tentang</a>
        <a href="contact.php">Kontak</a>
    </nav>
</header>

<main>
   
    <div class="contact-info">
        <h2>Hubungi Kami</h2>
        <p>
            Kami senang mendengar pesan dan masukan dari Anda!  
            Silakan kirimkan pertanyaan atau saran Anda melalui form di samping.
        </p>

        <div class="social-icons">
            <a href="https://instagram.com/merry.el.sinaga" target="_blank">Instagram</a>
            <a href="https://wa.me/6281996953237" target="_blank">WhatsApp</a>
        </div>
    </div>

    
    <div class="contact-form">
        <h3>Kirim Pesan ke Cyrus</h3>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Nama Anda" required>
            <input type="email" name="email" placeholder="Alamat Email" required>
            <textarea name="message" placeholder="Pesan Anda..." rows="5" required></textarea>
            <button type="submit">Kirim</button>
        </form>
    </div>
</main>

<footer>
    &copy; <?= date('Y') ?> Cyrus |
    <a href="https://instagram.com/merry.el.sinaga" target="_blank">Instagram</a> |
    <a href="https://wa.me/6281996953237" target="_blank">WhatsApp</a>
</footer>

</body>
</html>
