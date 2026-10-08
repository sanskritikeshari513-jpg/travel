<?php 
include 'db_connect.php'; 

// 1. URL se destination pakadna (Agar kuch na mile toh default 'Manali')
$dest = isset($_GET['dest']) ? mysqli_real_escape_string($conn, $_GET['dest']) : 'Manali';

// 2. Database se specific package ka data nikalna
$query = "SELECT * FROM trip_packages WHERE destination = '$dest'";
$result = mysqli_query($conn, $query);
$pkg = mysqli_fetch_assoc($result);

// Agar package nahi mila toh error dikhana
if(!$pkg) { 
    die("<h2 style='text-align:center; margin-top:50px;'>Package Not Found!</h2>"); 
}

// 3. Data ko format karna (Inclusions, Itinerary, aur Images)
$inclusions = json_decode($pkg['inclusions'], true);
$itinerary = explode(';', $pkg['itinerary']);
$images = explode(',', $pkg['image']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pkg['destination']); ?> | TravelWay Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --primary: #2563eb; --dark: #0f172a; --gray: #64748b; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; margin: 0; padding: 20px; color: #334155; }
        .container { max-width: 1100px; margin: 0 auto; }
        
        .header-section { margin-bottom: 30px; }
        .badge { background: #dbeafe; color: var(--primary); padding: 6px 12px; border-radius: 20px; font-size: 13px; font-weight: 600; }
        
        .main-layout { display: grid; grid-template-columns: 2fr 1fr; gap: 30px; }
        
        /* Left Side: Content */
        .gallery { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px; }
        .gallery img { width: 100%; height: 150px; border-radius: 12px; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        
        .section-card { background: white; padding: 25px; border-radius: 16px; margin-bottom: 25px; box-shadow: 0 2px 15px rgba(0,0,0,0.03); }
        h3 { border-left: 4px solid var(--primary); padding-left: 15px; margin-top: 0; }
        
        .inc-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .inc-item { display: flex; align-items: center; gap: 10px; font-size: 14px; }
        .inc-item i { color: var(--primary); }

        .day-box { border-bottom: 1px solid #f1f5f9; padding: 15px 0; }
        .day-box:last-child { border: none; }
        .day-title { color: var(--primary); font-weight: 800; font-size: 12px; }

        /* Right Side: Sidebar */
        .sidebar-card { background: white; padding: 30px; border-radius: 20px; position: sticky; top: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: center; }
        .price-tag { font-size: 32px; font-weight: 800; color: var(--dark); margin: 10px 0; }
        .sidebar-meta { text-align: left; border-top: 1px solid #eee; margin-top: 20px; padding-top: 20px; }
        .sidebar-meta p { font-size: 14px; margin: 8px 0; color: var(--gray); }

        .book-btn { 
            display: block; width: 100%; padding: 16px; background: var(--primary); color: white; 
            text-decoration: none; border-radius: 12px; font-weight: 700; font-size: 16px; 
            margin-top: 25px; transition: 0.3s; box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }
        .book-btn:hover { background: #1d4ed8; transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="container">
    <div class="header-section">
        <span class="badge"><i class="fa fa-star"></i> Verified Experience</span>
        <h1 style="font-size: 36px; margin: 10px 0;"><?php echo htmlspecialchars($pkg['destination']); ?> Magical Adventure</h1>
    </div>

    <div class="main-layout">
        <div class="left-content">
            <div class="gallery">
                <?php foreach($images as $img): ?>
                    <img src="<?php echo trim($img); ?>" alt="Gallery Image">
                <?php endforeach; ?>
            </div>

            <div class="section-card">
                <h3>What's Included?</h3>
                <div class="inc-grid">
                    <?php if($inclusions): foreach($inclusions as $inc): ?>
                        <div class="inc-item">
                            <i class="fa <?php echo htmlspecialchars($inc['icon']); ?>"></i>
                            <span><?php echo htmlspecialchars($inc['title']); ?></span>
                        </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>

            <div class="section-card">
                <h3>Journey Itinerary</h3>
                <?php foreach($itinerary as $index => $day): ?>
                    <div class="day-box">
                        <div class="day-title">DAY <?php echo $index + 1; ?></div>
                        <p style="margin: 5px 0; line-height: 1.5;"><?php echo htmlspecialchars($day); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="sidebar">
            <div class="sidebar-card">
                <p style="margin:0; color:var(--gray); font-weight:600;">Final Starting Price</p>
                <div class="price-tag">₹<?php echo number_format($pkg['price']); ?></div>
                
                <div class="sidebar-meta">
                    <p><i class="fa fa-fw fa-cloud-sun"></i> <b>Weather:</b> <?php echo htmlspecialchars($pkg['weather']); ?></p>
                    <p><i class="fa fa-fw fa-clock"></i> <b>Duration:</b> <?php echo htmlspecialchars($pkg['duration']); ?></p>
                    <p><i class="fa fa-fw fa-shield-alt"></i> 100% Secure Booking</p>
                </div>

                <a href="booking.php?package=<?php echo urlencode($pkg['destination']); ?>" class="book-btn">
                    Book This Trip Now <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>