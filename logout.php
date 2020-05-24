<?php
session_start();
unset($_SESSION['auth']);
session_destroy();
header("Location: register.php");
?>
