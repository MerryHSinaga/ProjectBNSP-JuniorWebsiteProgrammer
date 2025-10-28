<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../../app/db.php';
require_once __DIR__ . '/../../app/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();

    if ($user && $password === $user['password']) {
        $_SESSION['user'] = $user;

        if ($user['role'] === 'admin') {
            redirect('dashboard.php');
        } else {
            redirect('../index.php');
        }
    } else {
        $error = 'Email atau password salah!';
    }
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Login - Cyrus</title>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(to bottom, #123458, #1a3a6d);
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
.login-container {
    background: #1f2a4b;
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    width: 320px;
    text-align: center;
}
h1 {
    margin-bottom: 10px;
    font-size: 24px;
    color: #ffd700;
}
.subtitle {
    margin-bottom: 30px;
    color: #ccc;
    font-size: 14px;
}
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 20px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
}
button {
    width: 100%;
    padding: 12px;
    background-color: #ffd700;
    border: none;
    border-radius: 6px;
    color: #123458;
    font-size: 16px;
    cursor: pointer;
    font-weight: bold;
}
button:hover { background-color: #e6c200; }
a {
    color: #ffd700;
    text-decoration: underline;
    font-size: 14px;
    display: inline-block;
    margin-top: 10px;
}
.error-msg {
    color: #ff6b6b;
    margin-bottom: 20px;
}
</style>
</head>
<body>
<div class="login-container">
    <h1>Selamat datang di Cyrus!</h1>
    <p class="subtitle">Masuk untuk melihat daftar lagu dan liriknya</p>
    
    <?php if ($error): ?>
      <div class="error-msg"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
      <input name="email" type="email" placeholder="Email" required>
      <input name="password" type="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>

    <a href="register.php">Belum punya akun? Daftar di sini</a>
</div>
</body>
</html>
