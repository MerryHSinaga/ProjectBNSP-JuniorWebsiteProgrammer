<?php
require_once 'functions.php';
if (!isLoggedIn()) {
    redirect('../login.php');
}
?>
