<?php
session_start();
if(!isset($_SESSION['temp_booking_id'])) { header("Location: index.php"); exit(); }

$amount = $_SESSION['temp_amount']; // Paisa (e.g. 5000)
$display_amount = $amount * 100;    // Razorpay paise mein calculate karta hai (5000 * 100)
?>

<!DOCTYPE html>
<html>
<head>
    <title>Processing Payment...</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body onload="payNow()">
    <div style="text-align:center; margin-top:100px;">
        <h2>Connecting to Secure Gateway...</h2>
        <p>Please do not refresh or close the window.</p>
    </div>

    <script>
    function payNow() {
        var options = {
            "key": "YOUR_RAZORPAY_KEY_HERE", // Apni API key yahan dalein
            "amount": "<?php echo $display_amount; ?>", 
            "currency": "INR",
            "name": "TravelWay",
            "description": "Travel Package Booking",
            "handler": function (response){
                // Agar payment success ho jaye
                window.location.href = "verify_payment.php?payment_id=" + response.razorpay_payment_id;
            },
            "prefill": {
                "name": "User",
                "email": "user@example.com"
            },
            "theme": { "color": "#2563eb" }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
    }
    </script>
</body>
</html>