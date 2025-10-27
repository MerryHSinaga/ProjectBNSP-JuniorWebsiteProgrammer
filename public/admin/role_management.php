<?php
require_once '../../app/functions.php';
require_once '../../app/db.php';

if (!isAdmin()) redirect('../login.php');

$result = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Role Management | Cyrus</title>
  <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
  <h1>Role Management</h1>
  <table border="1">
    <tr><th>Nama</th><th>Email</th><th>Role</th></tr>
    <?php while ($user = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $user['name'] ?></td>
        <td><?= $user['email'] ?></td>
        <td><?= $user['role'] ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
