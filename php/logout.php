<?php
session_start();
$_SESSION['rights'] = 0;
$_SESSION['username'] = "";
echo "<script>location.href='../index.php'; alert('You were correctly disconnected');</script>";
?>
