<?php
session_start();
include 'db_connect.php';

// Check karein user login hai ya nahi
if(!isset($_SESSION['user_id'])) {
    echo "not_logged_in";
    exit();
}

if(isset($_POST['package_id'])) {
    $user_id = $_SESSION['user_id'];
    $p_id = mysqli_real_escape_string($conn, $_POST['package_id']);

    // Check karein ki ye package pehle se wishlist mein hai?
    $check = mysqli_query($conn, "SELECT * FROM wishlist WHERE user_id = '$user_id' AND package_id = '$p_id'");

    if(mysqli_num_rows($check) > 0) {
        // Agar hai toh delete kar dein (Toggle effect)
        mysqli_query($conn, "DELETE FROM wishlist WHERE user_id = '$user_id' AND package_id = '$p_id'");
        echo "removed";
    } else {
        // Agar nahi hai toh insert karein
        mysqli_query($conn, "INSERT INTO wishlist (user_id, package_id) VALUES ('$user_id', '$p_id')");
        echo "success";
    }
}
?>