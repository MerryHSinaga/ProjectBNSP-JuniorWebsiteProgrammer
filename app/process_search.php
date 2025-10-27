<?php
include '../app/db.php';
include '../app/functions.php';

$keyword = isset($_GET['search']) ? trim($_GET['search']) : '';
$songs = getSongs($conn, $keyword);

include '../public/index.php';
?>
