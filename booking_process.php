 <?php
session_start();
include 'db_connect.php'; 

// if(isset($_POST['send'])) {
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Data receive karna aur sanitize karna
    $user_id    = mysqli_real_escape_string($conn, $_POST['user_id']);
    $package_id = mysqli_real_escape_string($conn, $_POST['package_id']);
    $name       = mysqli_real_escape_string($conn, $_POST['name']);
    // $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $phone      = mysqli_real_escape_string($conn, $_POST['phone']);
    $arrival    = mysqli_real_escape_string($conn, $_POST['arrival']);
    $leaving    = mysqli_real_escape_string($conn, $_POST['leaving']);
    $guest      = mysqli_real_escape_string($conn, $_POST['guest']); // Form mein name='guest' hai
    $theme      = mysqli_real_escape_string($conn, $_POST['theme']); // Form mein name='theme' hai
    $status     = "Confirmed";
    $booking_date = date('Y-m-d');

// 1. Pehle query taiyaar karein
$query = "INSERT INTO booking_table (user_id, package_id, theme, name, phone, arrival, leaving, guest, status) 
          VALUES ('$user_id', '$package_id', '$theme', '$name', '$phone', '$arrival', '$leaving', '$guest', '$status')";

// 2. IS LINE KO ZAROOR LIKHEIN (Ye query run karegi)
$result = mysqli_query($conn, $query); 

// 3. Ab result check karein
if($result) {
    echo "<script>
            alert('Booking Successful!');
            window.location.href='my_bookings.php'; 
          </script>";
    exit();
} else {
    die("Query Failed: " . mysqli_error($conn));
}
}
?>