<?php
require_once __DIR__ . '/../app/db.php';
require_once __DIR__ . '/../app/functions.php'; // pastikan session_start() ada

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();

    // plain text password (sesuai permintaan)
    if ($user && $password === $user['password']) {
        $_SESSION['user'] = $user;
        if (isset($user['role']) && $user['role'] === 'admin') {
            header('Location: admin/dashboard.php');
        } else {
            header('Location: index.php');
        }
        exit;
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
<link rel="stylesheet" href="../assets/css/style.css">
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

  .login-container h1 {
    margin-bottom: 10px;
    font-size: 24px;
    color: #ffd700;
  }

  .login-container p.subtitle {
    margin-bottom: 30px;
    color: #ccc;
    font-size: 14px;
  }

  .login-container input[type="email"],
  .login-container input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 20px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
  }

  .login-container button {
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

  .login-container button:hover {
    background-color: #e6c200;
  }

  .login-container .register-link {
    margin-top: 20px;
    display: block;
    color: #ccc;
    font-size: 14px;
    text-decoration: none;
  }

  .login-container .register-link:hover {
    text-decoration: underline;
    color: #ffd700;
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
      <div class="error-msg"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="post" action="">
      <input name="email" type="email" placeholder="Email" required>
      <input name="password" type="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>

    <a href="register.php" class="register-link">Belum punya akun? Daftar</a>
  </div>
</body>
</html>
