<?php
session_start();
session_destroy();
header("Location: travel.php"); // Wapas Signup page par
exit();
?>