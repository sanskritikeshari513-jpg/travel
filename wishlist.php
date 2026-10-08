<?php
session_start();
include 'db_connect.php';

// Agar user login nahi hai toh login page par bhej dein
if(!isset($_SESSION['user_id'])) { 
    header("Location: signup.php"); 
    exit(); 
}

$user_id = $_SESSION['user_id'];

// SQL JOIN logic to fetch full package details
$query = "SELECT p.* FROM packages p 
          JOIN wishlist w ON p.id = w.package_id 
          WHERE w.user_id = '$user_id'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist | TravelWay</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #3b82f6;
            --dark-bg: #020617;
            --card-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        body {
            background-color: var(--dark-bg);
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 50px 8%;
        }

        .header-section {
            margin-bottom: 40px;
            border-left: 5px solid var(--primary);
            padding-left: 20px;
        }

        h1 { font-size: 2.5rem; margin: 0; }
        h1 span { color: var(--primary); }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        /* Modern Card Styling */
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .card:hover {
            transform: translateY(-10px);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        .card-img-container {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .card:hover .card-img {
            transform: scale(1.1);
        }

        .info { padding: 25px; }

        .title {
            font-size: 1.4rem;
            margin: 0 0 10px 0;
            font-weight: 700;
        }

        .price-tag {
            display: flex;
            align-items: baseline;
            gap: 5px;
            margin-bottom: 20px;
        }

        .price {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
        }

        .per-person { font-size: 0.8rem; opacity: 0.6; }

        .btn-group {
            display: flex;
            gap: 10px;
        }

        .book-btn {
            flex: 2;
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            text-align: center;
        }

        .book-btn:hover { background: #2563eb; transform: scale(1.02); }

        /* No Items Design */
        .empty-state {
            text-align: center;
            padding: 100px 0;
            grid-column: 1 / -1;
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--primary);
            margin-bottom: 20px;
            opacity: 0.5;
        }
          .back-btn { text-decoration: none; color: #64748b; padding: 15px; display: inline-block; }
    </style>
</head>
<body>

 <a href="javascript:history.back()" class="back-btn">
        <i class="fa fa-chevron-left"></i> Back
    </a>
    <div class="header-section">
        <h1>My <span>Wishlist</span></h1>
        <p style="opacity: 0.6;">Your handpicked future adventures.</p>
    </div>

    <div class="grid">
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="card">
                    <div class="card-img-container">
                        <img src="<?php echo $row['image_url']; ?>" class="card-img" alt="Destination">
                    </div>
                    
                    <div class="info">
                        <h3 class="title"><?php echo $row['title']; ?></h3>
                        
                        <div class="price-tag">
                            <span class="price">₹<?php echo number_format($row['price']); ?></span>
                            <span class="per-person">/ person</span>
                        </div>

                        <div class="btn-group">
                            <a href="booking.php?package=<?php echo urlencode($row['title']); ?>" class="book-btn">
                                <i class="fa fa-paper-plane"></i> Book Adventure
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fa-regular fa-heart"></i>
                <h2>It's quiet in here...</h2>
                <p>Start hearting your favorite destinations to see them here!</p>
                <br>
                <a href="packages.php" class="book-btn" style="padding: 10px 30px;">Explore Packages</a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>