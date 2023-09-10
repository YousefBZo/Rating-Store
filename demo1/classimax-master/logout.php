<?php
session_start();
session_unset();
session_destroy();
setcookie('username', '', time() - 3600, '/');
echo "<script>window.open('login.php','_self')</script>";
?>