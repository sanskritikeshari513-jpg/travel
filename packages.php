
<?php
session_start();
include 'db_connect.php'; 

// User ki ID session se nikalne ke liye
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; 

$query = "SELECT * FROM packages";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelWay - Explore Your Next Destination</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --success: #25d366;
            --dark: #1e293b;
            --light: #f1f5f9;
            --discount: #ff4d4d;
            --yellow: #ffd43b;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0; padding: 0; background-color: var(--light); color: var(--dark);
        }

        .wishlist-btn {
            position: absolute; top: 15px; right: 15px; z-index: 10;
            background: rgba(255, 255, 255, 0.3); backdrop-filter: blur(5px);
            width: 35px; height: 35px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.3s; color: white;
        }

        .wishlist-btn.active { background: white; color: #ff4d4d; }

        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('https://images.unsplash.com/photo-1506461883276-594a12b11cf3?auto=format&fit=crop&w=1200&q=80') center/cover;
            height: 350px; display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; text-align: center;
        }

        .search-area {
            max-width: 900px; margin: -40px auto 40px; background: white; padding: 25px; border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); display: flex; justify-content: center; align-items: center; gap: 15px;
        }
        .search-area select { padding: 12px 25px; border: 2px solid #e2e8f0; border-radius: 8px; width: 300px; }

        .package-container {
            max-width: 1200px; margin: 0 auto 50px; display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; padding: 0 20px;
        }

        .card {
            background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: 0.3s ease; position: relative; border: 1px solid #e2e8f0;
        }
        .card:hover { transform: translateY(-10px); }

        .discount-tag {
            position: absolute; top: 15px; left: 15px; background: var(--discount);
            color: white; padding: 5px 12px; font-weight: bold; border-radius: 4px; font-size: 0.8rem; z-index: 5;
        }

        .duration-badge {
            position: absolute; top: 175px; right: 15px; background: var(--yellow);
            width: 55px; height: 55px; border-radius: 50%; display: flex; flex-direction: column;
            align-items: center; justify-content: center; font-weight: bold; font-size: 0.65rem;
            border: 3px solid white; z-index: 5;
        }

        .card-img { width: 100%; height: 230px; object-fit: cover; }
        .card-title-bar { background: #222; color: white; padding: 12px; margin: 0; font-size: 1.1rem; text-align: center; }
        .content-inner { padding: 15px 20px 20px; text-align: center; }
        .route-path { color: var(--primary); font-size: 0.85rem; font-weight: 600; margin-bottom: 10px; display: block; }

        .icons-row {
            display: flex; justify-content: center; gap: 15px; margin: 15px 0;
            padding: 10px 0; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; color: #64748b;
        }

        .amount { font-size: 1.3rem; font-weight: 800; display: block; margin-bottom: 15px; }
        .card-footer { display: flex; gap: 10px; padding: 15px; }

        .view-btn {
            flex: 1; padding: 12px 10px; border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration: none; 
            background: transparent; color: #2563eb; border: 2px solid #2563eb;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 12px 25px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
            cursor: pointer;
            text-align: center;
            flex: 1;
        }

        .btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
            color: #fff;
        }

        .back-btn { text-decoration: none; color: #64748b; padding: 15px; display: inline-block; }
    </style>
</head>
<body>

    <a href="javascript:history.back()" class="back-btn">
        <i class="fa fa-chevron-left"></i> Back
    </a>

    <div class="hero">
        <h1>Pick Your Next Adventure</h1>
        <p>Explore the best states and hidden gems of India</p>
    </div>

    <div class="search-area">
        <label style="font-weight: bold;">Select State:</label>
        <select id="stateSelect" onchange="filterGallery()">
            <option value="all">All States of India</option>
            <option value="himanchal pradesh">Himanchal Pradesh</option>
            <option value="rajasthan">Rajasthan</option>
            <option value="uttarakhand">Uttarakhand</option>
            <option value="uttar pradesh">Uttar Pradesh</option>
            <option value="goa">Goa</option>
        </select>
    </div>

    <div class="package-container" id="packageGrid">
        
        <?php 
        while($row = mysqli_fetch_assoc($result)) { 
            $current_p_id = $row['id'];
            $active_class = "";
            
            if ($user_id > 0) {
                $check_wish = mysqli_query($conn, "SELECT id FROM wishlist WHERE user_id = '$user_id' AND package_id = '$current_p_id'");
                if (mysqli_num_rows($check_wish) > 0) {
                    $active_class = "active";
                }
            }

            // --- SMART REDIRECT LOGIC ---
            if(isset($_SESSION['user_id'])) {
                // Agar login hai, toh seedha booking page
                $final_booking_url = "booking.php?id=" . $row['id'] . "&price=" . $row['price'];
            } else {
                // Agar login nahi hai, toh signup page with redirect parameters
                $final_booking_url = "signup.php?redirect=booking.php&pkg_id=" . $row['id'] . "&price=" . $row['price'];
            }
        ?>
        <div class="card" data-state="<?php echo $row['state']; ?>">
            <div class="wishlist-btn <?php echo $active_class; ?>" onclick="toggleWishlist(this, <?php echo $row['id']; ?>)">
                <i class="fa-solid fa-heart"></i>
            </div>

            <div class="discount-tag"><?php echo $row['discount']; ?>% OFF</div>
            <div class="duration-badge"><?php echo sprintf("%02d", $row['duration']); ?><br>DAYS</div>
            
            <img src="<?php echo $row['image_url']; ?>" class="card-img" alt="<?php echo $row['title']; ?>">
            
            <div class="card-body">
                <h3 class="card-title-bar"><?php echo $row['title']; ?></h3>
                <div class="content-inner">
                    <span class="route-path"><i class="fa fa-map-marker-alt"></i> <?php echo $row['route']; ?></span>
                    <div class="amount">₹<?php echo number_format($row['price']); ?> <span>/ Person</span></div>
                    
                    <div class="icons-row">
                        <i class="fa fa-hotel" title="Hotel"></i>
                        <i class="fa fa-utensils" title="Meals"></i>
                        <i class="fa fa-binoculars" title="Sightseeing"></i>
                        <i class="fa fa-car" title="Transport"></i>
                    </div>

                    <div class="card-footer">
                        <button class="view-btn" onclick="window.location.href='<?php echo $row['details_link'] ?? 'details.php'; ?>'">View Details</button>
                        <a href="<?php echo $final_booking_url; ?>" class="btn">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <script>
        function filterGallery() {
            const selectedValue = document.getElementById('stateSelect').value.toLowerCase();
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                const cardState = card.getAttribute('data-state').toLowerCase();
                card.style.display = (selectedValue === 'all' || cardState === selectedValue) ? 'block' : 'none';
            });
        }

        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const stateParam = urlParams.get('state');
            if (stateParam) {
                document.getElementById('stateSelect').value = stateParam;
                filterGallery();
            }
        };

        function toggleWishlist(element, packageId) {
            element.classList.toggle('active');
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "save_wishlist.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("package_id=" + packageId);
        }
    </script>
</body>
</html>