<?php
session_start();
include 'db_connect.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: signup.php");
    exit();
}
$user_id = $_SESSION['user_id'];

// Sabhi bookings fetch karenge (Cancelled bhi taaki history dikhe)
$query = "SELECT p.title, p.image_url, p.price, b.arrival, b.leaving, b.status, b.guest, b.id as booking_id 
          FROM packages p 
          JOIN booking_table b ON p.id = b.package_id 
          WHERE b.user_id = '$user_id' 
          ORDER BY b.id DESC"; 

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Adventures | TravelWay</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3b82f6;
            --dark-bg: #030712;
            --card-bg: rgba(255, 255, 255, 0.03);
            --accent: #6366f1;
            --success: #10b981;
            --danger: #ef4444;
        }
        
        body {
            background: var(--dark-bg);
            color: #f3f4f6;
            font-family: 'Plus Jakarta Sans', sans-serif;
            padding: 50px 8%;
            margin: 0;
            background-image: radial-gradient(circle at 50% -20%, #1e293b 0%, #030712 100%);
        }
        
        .header { margin-bottom: 50px; }
        .header h1 { font-size: 2.5rem; font-weight: 800; margin: 30px 5px; background: linear-gradient(to right, #fff, #94a3b8); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .header p { color: #94a3b8; margin-top: 15px; font-size: 1.1rem; }
        
        .booking-container { display: grid; gap: 30px; }
        
        .booking-card {
            background: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 28px;
            display: flex;
            overflow: hidden;
            backdrop-filter: blur(20px);
            transition: 0.4s all ease;
        }
        
        .booking-card:hover {
            transform: scale(1.01);
            border-color: rgba(59, 130, 246, 0.5);
            background: rgba(255, 255, 255, 0.06);
        }
        
        .img-box { width: 320px; height: 240px; position: relative; }
        .img-box img { width: 100%; height: 100%; object-fit: cover; }
        .img-box::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to right, transparent, var(--dark-bg)); }

        .details { padding: 35px; flex: 1; display: flex; flex-direction: column; }
        
        .card-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
        .booking-date { font-size: 0.75rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        
        .status-pill {
            padding: 6px 14px; border-radius: 12px; font-size: 0.7rem; font-weight: 800;
            display: flex; align-items: center; gap: 5px;
        }

        /* Dynamic Status Colors */
        .status-confirmed { background: rgba(16, 185, 129, 0.1); color: var(--success); border: 1px solid rgba(16, 185, 129, 0.2); }
        .status-cancelled { background: rgba(239, 68, 68, 0.1); color: var(--danger); border: 1px solid rgba(239, 68, 68, 0.2); }

        .title-row { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; }
        .title-row h3 { margin: 0; font-size: 1.8rem; font-weight: 800; }

        .meta-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .meta-item { display: flex; flex-direction: column; gap: 5px; }
        .meta-item span { font-size: 0.75rem; color: #64748b; font-weight: 700; text-transform: uppercase; }
        .meta-item p { margin: 0; font-size: 1rem; font-weight: 600; color: #e2e8f0; }
        
        .card-footer {
            display: flex; justify-content: space-between; align-items: center;
            padding-top: 25px; border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .total-price { font-size: 1.5rem; font-weight: 800; }
        .total-price small { font-size: 0.8rem; color: #64748b; font-weight: 400; margin-left: 5px; }

        .btn-group { display: flex; gap: 12px; }
        .btn {
            padding: 12px 24px; border-radius: 14px; font-size: 0.9rem; font-weight: 700;
            text-decoration: none; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-ticket { background: var(--primary); color: white; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); }
        .btn-cancel { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); }
        .btn-cancel:hover { background: #ef4444; color: white; }

        .no-booking { text-align: center; padding: 100px; border: 2px dashed rgba(255,255,255,0.05); border-radius: 40px; }

        @media (max-width: 992px) {
            .booking-card { flex-direction: column; }
            .img-box { width: 100%; height: 200px; }
        }
         nav {
            position: fixed; top: 0; left: 0; width: 100%; z-index: 2000;
            display: flex; justify-content: space-between; align-items: center;
            padding: 20px 8%; background: rgba(2, 6, 23, 0.7);
            backdrop-filter: blur(15px); border-bottom: 1px solid var(--glass-border);
        }
        .logo { font-size: 1.9rem; font-weight: 800; color: white; text-decoration: none; }
         .logo span { color: var(--primary); }
    </style>
</head>
<body>
<nav>
    <!-- <nav style="margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center;">
        <a href="travel.php" style="color:white; text-decoration:none; font-weight:1000; font-size:2.5rem;">Travel<span style="color:var(--primary)">Way</span></a>
    </nav> -->
     <a href="travel.php" class="logo">Travel<span>Way</span></a>
        <div class="menu-toggle" id="mobile-menu" style="display: none; cursor: pointer; font-size: 1.5rem;">
        <i class="fas fa-bars"></i>
    </div>
    </nav>

    <div class="header">
        <h1>My <span style="color: var(--primary);">Adventures</span></h1>
        <p>Manage your upcoming trips and travel history</p>
    </div>

    <div class="booking-container">
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)):
                $totalPrice = $row['price'] * $row['guest'];
                $status = $row['status'];
                
                // Logic for Status Styling
                $statusClass = (strpos(strtolower($status), 'cancelled') !== false) ? 'status-cancelled' : 'status-confirmed';
                $statusIcon = (strpos(strtolower($status), 'cancelled') !== false) ? 'fa-circle-xmark' : 'fa-circle-check';
            ?>
                <div class="booking-card">
                    <div class="img-box">
                        <img src="<?php echo $row['image_url']; ?>" alt="Package">
                    </div>
                    <div class="details">
                        <div class="card-top">
                            <div class="booking-date">
                                <i class="fa-solid fa-hashtag"></i> Booking Ref: #TW-<?php echo $row['booking_id']; ?>
                            </div>
                            <div class="status-pill <?php echo $statusClass; ?>">
                                <i class="fa-solid <?php echo $statusIcon; ?>"></i> <?php echo strtoupper($status); ?>
                            </div>
                        </div>

                        <div class="title-row">
                            <h3><?php echo $row['title']; ?></h3>
                        </div>
                        
                        <div class="meta-grid">
                            <div class="meta-item">
                                <span>Travel Duration</span>
                                <p><?php echo date('d M', strtotime($row['arrival'])); ?> — <?php echo date('d M, Y', strtotime($row['leaving'])); ?></p>
                            </div>
                            <div class="meta-item">
                                <span>Travelers</span>
                                <p><?php echo $row['guest']; ?> Person(s)</p>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="total-price">
                                ₹<?php echo number_format($totalPrice); ?><small>incl. taxes</small>
                            </div>
                            <div class="btn-group">
                                <a href="view_ticket.php?id=<?php echo $row['booking_id']; ?>" class="btn btn-ticket">
                                    <i class="fa-solid fa-ticket"></i> View Ticket
                                </a>

                                <?php if(strpos(strtolower($status), 'cancelled') === false): ?>
                                    <a href="cancel_booking.php?id=<?php echo $row['booking_id']; ?>" 
                                       class="btn btn-cancel" 
                                       onclick="return confirm('Are you sure you want to cancel this trip?')">
                                        <i class="fa-solid fa-xmark"></i> Cancel
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-booking">
                <i class="fa-solid fa-compass fa-4x" style="color: #1e293b; margin-bottom: 20px;"></i>
                <h2>No active bookings found</h2>
                <p>Looks like you haven't planned any trips yet.</p>
                <br>
                <a href="packages.php" class="btn btn-ticket">Explore Packages</a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>