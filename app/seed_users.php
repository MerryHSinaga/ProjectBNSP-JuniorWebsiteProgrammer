<?php
require_once 'db.php'; // path ke koneksi database

$name = 'Merry';
$email = 'merry@gmail.com';
$password = 'Theo';
$role = 'admin';
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare gagal: " . $conn->error);
}
$stmt->bind_param("ssss", $name, $email, $hash, $role);
$stmt->execute();

echo "Admin berhasil ditambahkan!";
?>
