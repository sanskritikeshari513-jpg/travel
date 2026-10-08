<?php
session_start();
include 'db_connect.php';

$payment_id = $_GET['payment_id'];
$booking_id = $_SESSION['temp_booking_id'];

if($payment_id) {
    // Payment successful! Status update karo
    $sql = "UPDATE booking_table SET status = 'Confirmed', payment_id = '$payment_id' WHERE id = '$booking_id'";
    mysqli_query($conn, $sql);
    
    unset($_SESSION['temp_booking_id']);
    header("Location: view_ticket.php?id=" . $booking_id);
} else {
    echo "Payment Failed!";
}
?>