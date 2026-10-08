<?php
session_start();
include 'db_connect.php';

// 1. Check karein ki User Login hai aur ID mili hai
if(isset($_GET['id']) && isset($_SESSION['user_id'])) {
    
    $booking_id = mysqli_real_escape_string($conn, $_GET['id']);
    $user_id = $_SESSION['user_id'];

    // 2. Booking details fetch karein (Validation ke liye)
    $check_query = "SELECT arrival, payment_status FROM booking_table 
                    WHERE id = '$booking_id' AND user_id = '$user_id'";
    $result = mysqli_query($conn, $check_query);
    $booking = mysqli_fetch_assoc($result);

    if($booking) {
        // --- LOGIC A: Date Validation (24 Hours Rule) ---
        $arrival_date = strtotime($booking['arrival']); 
        $current_time = time();
        $diff_in_hours = ($arrival_date - $current_time) / 3600;

        if($diff_in_hours < 24) {
            // Agar trip mein 24 ghante se kam bache hain toh cancel nahi hoga
            header("Location: my_bookings.php?error=too_late");
            exit();
        }

        // --- LOGIC B: Refund Management ---
        $status_to_update = 'Cancelled';
        $refund_to_update = 'N/A';

        if($booking['payment_status'] == 'Paid') {
            $status_to_update = 'Cancelled (Refund Pending)';
            $refund_to_update = 'Initiated';
        }

        // 3. Final Update Query
        $update_query = "UPDATE booking_table SET 
                         status = '$status_to_update', 
                         refund_status = '$refund_to_update',
                         cancellation_date = NOW() 
                         WHERE id = '$booking_id' AND user_id = '$user_id'";
        
        if(mysqli_query($conn, $update_query)) {
            // Success: Wapas bhejien success message ke saath
            header("Location: my_bookings.php?status=cancelled_success");
            exit();
        } else {
            echo "Database Error: " . mysqli_error($conn);
        }
    } else {
        // Agar booking ID galat hai ya user ki apni nahi hai
        header("Location: my_bookings.php?error=invalid_access");
        exit();
    }
} else {
    header("Location: my_bookings.php");
    exit();
}
?>