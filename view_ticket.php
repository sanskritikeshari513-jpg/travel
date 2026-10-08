<?php
session_start();
include 'db_connect.php';

// 1. Security Check: Redirect if ID is missing
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: my_bookings.php");
    exit();
}

// 2. Database Connection Check
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$booking_id = mysqli_real_escape_string($conn, $_GET['id']);

// 3. Query: Fetching all details including cancellation info
$query = "SELECT b.*, p.title, p.image_url, p.state, p.price AS pkg_price 
          FROM booking_table b 
          JOIN packages p ON b.package_id = p.id 
          WHERE b.id = '$booking_id'";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    
    // Status Check logic
    $current_status = strtolower($data['status']);
    $is_cancelled = (strpos($current_status, 'cancelled') !== false);

    // Price Calculation
    $unit_price = (!empty($data['pkg_price'])) ? (float)$data['pkg_price'] : 0;
    $total_guests = (isset($data['guest']) && $data['guest'] > 0) ? (int)$data['guest'] : 1;
    $final_bill = $unit_price * $total_guests;

    $theme_display = ucfirst(strtolower(!empty($data['theme']) ? $data['theme'] : 'standard'));
    $display_img = !empty($data['image_url']) ? $data['image_url'] : 'https://via.placeholder.com/400x300?text=No+Image+Available';

} else {
    die("<div style='text-align:center; margin-top:100px; font-family:sans-serif;'>
            <h1 style='color:#ef4444;'>404</h1>
            <h2>E-Ticket Not Found!</h2>
            <a href='my_bookings.php'>Return to My Bookings</a>
         </div>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelWay Ticket - <?php echo htmlspecialchars($data['title']); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { 
            --primary: <?php echo $is_cancelled ? '#64748b' : '#2563eb'; ?>; 
            --secondary: #0f172a; 
            --success: #10b981; 
            --danger: #ef4444;
        }
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; padding: 40px 20px; color: #334155; }
        
        .ticket-card { 
            max-width: 850px; margin: auto; background: white; border-radius: 24px; 
            overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1); position: relative;
            filter: <?php echo $is_cancelled ? 'grayscale(0.4)' : 'none'; ?>;
        }

        .ticket-header { 
            background: <?php echo $is_cancelled ? '#1e293b' : 'var(--secondary)'; ?>; 
            color: white; padding: 30px 40px; display: flex; justify-content: space-between; align-items: center; 
        }

        .ticket-body { padding: 40px; position: relative; }

        /* Status Stamp Styling */
        .stamp { 
            position: absolute; top: 20px; right: 40px; border: 5px solid; 
            padding: 8px 25px; border-radius: 12px; transform: rotate(-15deg); 
            font-weight: 900; font-size: 24px; text-transform: uppercase; opacity: 0.8; z-index: 10;
        }
        .stamp-confirmed { border-color: var(--success); color: var(--success); }
        .stamp-cancelled { border-color: var(--danger); color: var(--danger); }

        .dest-box { 
            display: flex; align-items: center; gap: 20px; background: #f8fafc; 
            padding: 20px; border-radius: 16px; margin-bottom: 30px; border: 1px solid #e2e8f0;
        }
        .dest-box img { width: 110px; height: 110px; border-radius: 12px; object-fit: cover; }

        /* Fixed Grid for all 9-10 info items */
        .info-grid { 
            display: grid; 
            grid-template-columns: repeat(3, 1fr); 
            gap: 25px; 
            margin-bottom: 20px;
        }
        .info-item .label { font-size: 10px; text-transform: uppercase; color: #94a3b8; font-weight: 800; letter-spacing: 0.5px; }
        .info-item .value { font-size: 14px; color: #1e293b; font-weight: 600; margin-top: 4px; word-break: break-word; }

        .cancellation-note {
            background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.2);
            padding: 15px; border-radius: 12px; margin-top: 20px; color: var(--danger); font-size: 13px;
        }

        .footer { 
            background: #f8fafc; padding: 30px 40px; border-top: 2px dashed #cbd5e1; 
            display: flex; justify-content: space-between; align-items: center;
        }

        .print-btn { 
            background: var(--primary); color: white; padding: 12px 28px; border-radius: 12px; 
            text-decoration: none; font-weight: 700; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;
        }

        @media print { .print-btn, .back-nav { display: none !important; } }
        @media (max-width: 650px) { .info-grid { grid-template-columns: repeat(2, 1fr); } }
    </style>
</head>
<body>

    <div class="back-nav" style="max-width:850px; margin: 0 auto 20px;">
        <a href="my_bookings.php" style="text-decoration:none; color:var(--primary); font-weight:700; font-size: 14px;">
            <i class="fa fa-arrow-left"></i> BACK TO MY ADVENTURES
        </a>
    </div>

    <div class="ticket-card">
        <div class="ticket-header">
            <div>
                <h2 style="margin:0; letter-spacing:2px; font-weight: 800;">TRAVELWAY</h2>
                <p style="margin:5px 0 0; opacity:0.8; font-size:12px;">E-Ticket & Booking Confirmation</p>
            </div>
            <div style="text-align:right">
                <p style="margin:0; font-size: 11px; opacity:0.8; font-weight: 700;">TOTAL AMOUNT PAID</p>
                <div style="font-size: 26px; font-weight: 800;">₹<?php echo number_format($final_bill); ?></div>
            </div>
        </div>

        <div class="ticket-body">
            <?php if($is_cancelled): ?>
                <div class="stamp stamp-cancelled">Cancelled</div>
            <?php else: ?>
                <div class="stamp stamp-confirmed">Confirmed</div>
            <?php endif; ?>

            <div class="dest-box">
                <img src="<?php echo $display_img; ?>" alt="Package Image">
                <div>
                    <span style="font-size:10px; font-weight:800; color:var(--primary); text-transform:uppercase; background: rgba(37, 99, 235, 0.1); padding: 3px 8px; border-radius: 4px;">
                        <i class="fa fa-tag"></i> <?php echo $theme_display; ?> Package
                    </span>
                    <h2 style="margin:8px 0; font-size: 22px; color: var(--secondary);"><?php echo htmlspecialchars($data['title']); ?></h2>
                    <p style="margin:0; font-size:14px; color:#64748b; font-weight: 600;">
                        <i class="fa fa-map-marker-alt" style="color:var(--danger)"></i> <?php echo htmlspecialchars($data['state']); ?>, India
                    </p>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <div class="label">Passenger Name</div>
                    <div class="value"><?php echo htmlspecialchars($data['name']); ?></div>
                </div>
                
                <div class="info-item">
                    <div class="label">Booking Reference</div>
                    <div class="value" style="color:var(--primary); font-weight: 800;">#TW-<?php echo str_pad($data['id'], 6, "0", STR_PAD_LEFT); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">Plan Type</div>
                    <div class="value"><?php echo $theme_display; ?> Plan</div>
                </div>

                <div class="info-item">
                    <div class="label">Travelers</div>
                    <div class="value"><?php echo $total_guests; ?> Person(s)</div>
                </div>

                <div class="info-item">
                    <div class="label">Check-in (Arrival)</div>
                    <div class="value"><?php echo date('d M, Y', strtotime($data['arrival'])); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">Check-out (Departure)</div>
                    <div class="value"><?php echo date('d M, Y', strtotime($data['leaving'])); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">Payment Mode</div>
                    <div class="value">Online / Prepaid</div>
                </div>

                <div class="info-item">
                    <div class="label">Booked On</div>
                    <div class="value"><?php echo date('d M, Y', strtotime($data['booking_date'])); ?></div>
                </div>

                <div class="info-item">
                    <div class="label">Booking Status</div>
                    <div class="value" style="color:<?php echo $is_cancelled ? 'var(--danger)' : 'var(--success)'; ?>;">
                        <?php echo strtoupper($data['status']); ?>
                    </div>
                </div>

                
            </div>

            <?php if($is_cancelled): ?>
                <div class="cancellation-note">
                    <div style="font-weight: 800; margin-bottom: 5px;">
                        <i class="fa fa-exclamation-circle"></i> CANCELLATION SUMMARY
                    </div>
                    Cancelled on: <?php echo !empty($data['cancellation_date']) ? date('d M, Y (H:i)', strtotime($data['cancellation_date'])) : 'N/A'; ?><br>
                    Refund Status: <span style="font-weight: 700;"><?php echo !empty($data['refund_status']) ? strtoupper($data['refund_status']) : 'IN PROGRESS'; ?></span>
                </div>
            <?php endif; ?>
        </div>

        <div class="footer">
            <div style="font-size:11px; color:#64748b; max-width: 60%; line-height: 1.4;">
                <?php if($is_cancelled): ?>
                    <i class="fa fa-info-circle"></i> This booking is void. This receipt is only for refund and accounting purposes.
                <?php else: ?>
                    <i class="fa fa-info-circle" style="color: var(--primary);"></i> <strong>Note:</strong> Please present a government photo ID and this e-ticket during check-in.
                <?php endif; ?>
            </div>
            
            <?php if(!$is_cancelled): ?>
                <button onclick="window.print()" class="print-btn">
                    <i class="fa fa-print"></i> PRINT E-TICKET
                </button>
            <?php else: ?>
                <button disabled class="print-btn" style="background:#cbd5e1; cursor:not-allowed; color: #64748b;">
                    <i class="fa fa-ban"></i> VOID TICKET
                </button>
            <?php endif; ?>
        </div>
    </div>

    <div style="text-align:center; margin-top:30px;">
        <p style="color:#94a3b8; font-size:11px; margin:0;">&copy; 2026 TRAVELWAY PORTAL. ALL RIGHTS RESERVED.</p>
        <p style="color:#cbd5e1; font-size:10px; margin-top:5px;">Digital Document Generated on <?php echo date('d M Y, H:i:s'); ?></p>
    </div>

</body>
</html>