<?php
require_once __DIR__ . '/../app/db.php';
require_once __DIR__ . '/../app/functions.php'; // asumsi functions.php memanggil session_start()

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? ''); // disimpan plain

    if ($name === '' || $email === '' || $password === '') {
        $error = 'Semua kolom wajib diisi.';
    } else {
        // cek email
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $res = $check->get_result();
        if ($res->num_rows > 0) {
            $error = 'Email sudah digunakan.';
        } else {
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
            $stmt->bind_param("sss", $name, $email, $password); // plain insert
            if ($stmt->execute()) {
                $success = 'Registrasi berhasil. Silakan login.';
            } else {
                $error = 'Gagal menyimpan data: ' . $stmt->error;
            }
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Daftar - Cyrus</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
  <h1>🎸 CYRUS</h1>
</header>

<main>
  <h2>Daftar Akun</h2>
  <?php if ($error) echo "<p style='color:red;'>".e($error)."</p>"; ?>
  <?php if ($success) echo "<p style='color:green;'>".e($success)."</p>"; ?>
  <form method="post" action="">
    <input name="name" placeholder="Nama" required><br><br>
    <input name="email" type="email" placeholder="Email" required><br><br>
    <input name="password" type="password" placeholder="Password (boleh singkat)" required><br><br>
    <button type="submit">Daftar</button>
  </form>
  <p>Sudah punya akun? <a href="login.php">Login</a></p>
</main>
</body>
</html>
