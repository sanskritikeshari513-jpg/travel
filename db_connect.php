<?php
// Database se connection jodne ke liye
$conn = mysqli_connect("localhost", "root", "", "travel_db");

// Agar connection fail ho jaye toh error dikhaye
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

