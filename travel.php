<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelWay | Ultimate States Edition</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <style>
       :root {
            --primary: #3b82f6;
            --primary-glow: rgba(59, 130, 246, 0.6);
            --glass: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-dim: #94a3b8;
            --star-active: #fbbf24;
            --star-dim: #334155;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #020617; color: white; overflow-x: hidden; scroll-behavior: smooth; }

        /* --- NAVBAR --- */
        nav {
            position: fixed; top: 0; left: 0; width: 100%; z-index: 2000;
            display: flex; justify-content: space-between; align-items: center;
            padding: 20px 8%; background: rgba(2, 6, 23, 0.7);
            backdrop-filter: blur(15px); border-bottom: 1px solid var(--glass-border);
        }
        .logo { font-size: 1.9rem; font-weight: 800; color: white; text-decoration: none; }
        .logo span { color: var(--primary); }
        .nav-links { display: flex; gap: 30px; align-items: center; }
        .nav-links a { color: white; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: 0.3s; }
        .nav-links a:hover { color: var(--primary); }

        /* --- RESPONSIVE CSS --- */

/* Hamburger Menu Style */
@media (max-width: 992px) {
    .menu-toggle { display: block !important; }
    
    .nav-links {
        position: fixed;
        top: 80px;
        left: -100%;
        width: 100%;
        height: calc(100vh - 80px);
        background: #020617;
        flex-direction: column;
        padding: 40px;
        transition: 0.4s;
        backdrop-filter: blur(20px);
        align-items: flex-start !important;
    }

    .nav-links.active { left: 0; }
    
    .dropdown-content { position: static; background: transparent; border: none; box-shadow: none; padding-left: 20px; }
    
    .nav-auth { display: none; } /* Laptop wala auth hide karein */
    .mobile-auth { display: block !important; }
}

/* Sections adjustment */
@media (max-width: 768px) {
    .hero-content h1 { font-size: 3rem; }
    
    .footer-grid {
        grid-template-columns: 1fr;
        gap: 30px;
        text-align: center;
    }

    .feedback-grid {
        grid-template-columns: 1fr;
    }

    .state-card {
        min-width: 280px;
        height: 380px;
    }
    
    .search-wrapper { width: 95%; }
}
        
        .user-menu-wrapper { position: relative; }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 15px);
            right: 0;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px);
            min-width: 220px;
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
            overflow: hidden;
            z-index: 3000;
        }
        .dropdown-menu.active { display: block; animation: slideIn 0.3s ease; }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: white;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: 0.2s;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .menu-item:hover { background: var(--primary); }
        .menu-item i { width: 18px; color: var(--primary); transition: 0.2s; }
        .menu-item:hover i { color: white; }

        .dropdown { position: relative; display: inline-block; }
        .dropbtn { cursor: pointer; display: flex; align-items: center; gap: 5px; }
        .dropdown-content {
            display: none; position: absolute; top: 100%; left: 0;
            background: #0f172a; min-width: 180px; border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); border: 1px solid var(--glass-border);
            overflow: hidden; z-index: 2001; padding: 10px 0;
        }
        .dropdown-content a {
            padding: 12px 20px; display: block; font-size: 0.85rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .dropdown-content a:hover { background: var(--primary); color: white; }
        .dropdown:hover .dropdown-content { display: block; }

        .nav-auth { display: flex; gap: 15px; }
        .btn-signup { background: var(--primary); padding: 8px 22px; border-radius: 50px; color: white; text-decoration: none; font-size: 0.9rem; font-weight: 700; transition: 0.3s; box-shadow: 0 5px 15px var(--primary-glow); }

        /* --- HERO --- */
        .hero { position: relative; height: 100vh; width: 100%; display: flex; align-items: center; justify-content: center; text-align: center; }
        .hero-bg { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(rgba(2, 6, 23, 0.3), rgba(2, 6, 23, 0.9)), url('https://images.unsplash.com/photo-1506461883276-594a12b11cf3?w=1920&q=80'); background-size: cover; background-position: center; z-index: -1; transition: 1.5s ease-in-out; }
        .hero-content { z-index: 10; width: 90%; max-width: 800px; }
        .hero-content h1 { font-size: clamp(3rem, 8vw, 6.5rem); font-weight: 800; line-height: 1.1; background: linear-gradient(to bottom, #fff, #64748b); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 20px; }

        /* --- SEARCH --- */
        .search-wrapper { position: relative; max-width: 550px; margin: 30px auto; z-index: 100; }
        .search-field { width: 100%; padding: 18px 30px; border-radius: 50px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); color: white; outline: none; backdrop-filter: blur(15px); font-size: 1.1rem; transition: 0.3s; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
        .search-field:focus { border-color: var(--primary); background: rgba(255,255,255,0.12); box-shadow: 0 0 20px var(--primary-glow); }
        .search-dropdown { position: absolute; top: calc(100% + 10px); left: 0; width: 100%; background: #0f172a; border-radius: 20px; border: 1px solid var(--glass-border); display: none; max-height: 320px; overflow-y: auto; text-align: left; box-shadow: 0 20px 50px rgba(0,0,0,0.6); z-index: 999; backdrop-filter: blur(20px); }
        .search-item { padding: 15px 25px; border-bottom: 1px solid rgba(255,255,255,0.05); cursor: pointer; transition: 0.2s; display: flex; align-items: center; gap: 12px; }
        .search-item:hover { background: var(--primary); padding-left: 30px; }

        /* --- SLIDER & FEEDBACK --- */
        .slider-section { padding: 80px 8%; position: relative; z-index: 1; }
        .slide-container { display: flex; gap: 25px; overflow-x: auto; scroll-behavior: smooth; padding: 30px 0; }
        .slide-container::-webkit-scrollbar { display: none; }
        .state-card { min-width: 320px; height: 450px; border-radius: 30px; position: relative; overflow: hidden; flex-shrink: 0; border: 1px solid var(--glass-border); transition: 0.5s; cursor: pointer; }
        .state-card img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
        .state-card:hover img { transform: scale(1.1); filter: brightness(0.7); }
        .state-overlay { position: absolute; inset: 0; display: flex; flex-direction: column; justify-content: flex-end; padding: 30px; background: linear-gradient(transparent, rgba(0,0,0,0.8)); }

        .feedback-grid { display: grid; grid-template-columns: 1fr 1.2fr; gap: 40px; padding: 60px 8%; }
        .glass-card { background: var(--glass); border: 1px solid var(--glass-border); border-radius: 30px; padding: 40px; backdrop-filter: blur(20px); }
        .field { width: 100%; background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 15px; border-radius: 12px; color: white; outline: none; margin-bottom: 15px; }
        .star-input { display: flex; gap: 10px; cursor: pointer; margin: 10px 0 20px; }
        .star-input i { font-size: 1.5rem; color: var(--star-dim); transition: 0.3s; }
        .star-input i.active { color: var(--star-active); transform: scale(1.2); }

        /* --- FIXED FOOTER STYLING --- */
        footer { 
            padding: 80px 8% 40px; 
            background: #01040a; 
            border-top: 1px solid var(--glass-border); 
        }
        .footer-grid { 
            display: grid; 
            grid-template-columns: 1.5fr 1fr 1fr 1fr; /* Space distributed evenly */
            gap: 50px; 
        }
        .footer-links h4 {
            font-size: 1.1rem;
            margin-bottom: 25px;
            color: white;
            font-weight: 700;
        }
        .footer-links a { 
            display: block; 
            color: var(--text-dim); 
            text-decoration: none; 
            margin-bottom: 15px; /* Increased space between links */
            font-size: 0.95rem;
            transition: 0.3s; 
        }
        .footer-links a:hover { color: var(--primary); transform: translateX(5px); }
        
        .social-icons { display: flex; gap: 20px; margin-top: 20px; }
        .social-icons i { font-size: 1.4rem; transition: 0.3s; }
        .social-icons a:hover i { color: var(--primary); }

        @media (max-width: 992px) {
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            nav { padding: 15px 5%; }
            .nav-auth { display: none; }
            .hero-content h1 { font-size: 2.8rem; }
            .feedback-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; text-align: center; }
            .social-icons { justify-content: center; }
        }
    </style>
</head>
<body>

    <nav>
        <!-- <img src="Travel_Way_no_bg.png" alt="TravelWay Logo" style="height:50px;"> -->
        <a href="travel.php" class="logo">Travel<span>Way</span></a>
        <div class="menu-toggle" id="mobile-menu" style="display: none; cursor: pointer; font-size: 1.5rem;">
        <i class="fas fa-bars"></i>
    </div>
        <div class="nav-links" id="nav-menu">
            <div class="dropdown">
                <a class="dropbtn">Destinations <i class="fa fa-chevron-down" style="font-size: 0.7rem;"></i></a>
                <div class="dropdown-content">
                    <a href="packages.php?state=himanchal pradesh">Himanchal Pradesh</a>
                    <a href="packages.php?state=goa">Goa</a>
                    <a href="packages.php?state=rajasthan">Rajasthan</a>
                    <a href="packages.php?state=uttarakhand">Uttarakhand</a>
                    <a href="packages.php?state=uttar pradesh">Uttar Pradesh</a>
                    <a href="packages.php">All Packages</a>
                </div>
            </div>
            <a href="#feedBox">Reviews</a>
            <a href="about us.php">About Us</a>
        </div>
        <div class="mobile-auth" style="display: none; margin-top: 20px;">
             <?php if(!isset($_SESSION['user_name'])): ?>
                <a href="signup.php" class="btn-signup">Sign Up</a>
             <?php endif; ?>
        </div>
    </div>
    <div class="nav-auth">
    <?php if(isset($_SESSION['user_name'])): ?>
        <div class="user-menu-wrapper">
            <div onclick="toggleUserMenu()" style="cursor: pointer; display: flex; align-items: center; gap: 12px; background: rgba(255,255,255,0.05); padding: 6px 15px; border-radius: 50px; border: 1px solid var(--glass-border);">
                <div style="width: 32px; height: 32px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; box-shadow: 0 0 15px var(--primary-glow);">
                    <?php echo strtoupper(substr($_SESSION['user_name'], 0, 1)); ?>
                </div>
                <span style="font-weight: 700; font-size: 0.9rem; color: white;">
                    Hi, <?php echo explode(' ', $_SESSION['user_name'])[0]; ?> 
                </span>
                <i class="fa fa-chevron-down" style="font-size: 0.7rem; opacity: 0.6;"></i>
            </div>

            <div id="userDropdown" class="dropdown-menu">
                <div style="padding: 15px 20px; background: rgba(255,255,255,0.02); font-size: 0.75rem; color: var(--text-dim); text-transform: uppercase; letter-spacing: 1px;">
                    Account Settings
                </div>
                <a href="wishlist.php" class="menu-item"><i class="fa fa-heart"></i> My Wishlist</a>
                <a href="my_bookings.php" class="menu-item"><i class="fa fa-suitcase-rolling"></i> My Bookings</a>
                <a href="profile.php" class="menu-item"><i class="fa fa-user-edit"></i> Edit Profile</a>
                <a href="logout.php" class="menu-item" style="color: #ff4d4d;"><i class="fa fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    <?php else: ?>
        <a href="signup.php" class="btn-signup">Sign Up</a>
    <?php endif; ?>
</div>
    </nav>

    <section class="hero">
        <div class="hero-bg" id="heroBg"></div>
        <div class="hero-content">
            <h1 id="heroTitle">DISCOVER<br>INDIA'S SOUL</h1>
            <div class="search-wrapper">
                <input type="text" id="stateInput" class="search-field" placeholder="Search destinations (e.g. Manali, Goa)..." onkeyup="filterPlaces()" autocomplete="off">
                <div id="searchDrop" class="search-dropdown"></div>
            </div>
            <p style="color: var(--text-dim); margin-top: 10px; font-size: 1.1rem;">Handpicked premium travel batches for 2026.</p>
        </div>
    </section>

    <section class="slider-section">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px;">
            <div>
                <p style="color: var(--primary); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 0.8rem; margin-bottom: 5px;">Pick your spot</p>
                <h2>Explore by State</h2>
            </div>
            <div style="display: flex; gap: 10px;">
                <button onclick="sideScroll(-350)" style="background:var(--glass); border:1px solid var(--glass-border); color:white; width:45px; height:45px; border-radius:50%; cursor:pointer;"><i class="fa fa-arrow-left"></i></button>
                <button onclick="sideScroll(350)" style="background:var(--glass); border:1px solid var(--glass-border); color:white; width:45px; height:45px; border-radius:50%; cursor:pointer;"><i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
        <div class="slide-container" id="mainSlider">
            <div class="state-card" onclick="goToState('himanchal pradesh')">
                <img src="https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?w=600">
                <div class="state-overlay"><h3>Himanchal Pradesh</h3></div>
            </div>
            <div class="state-card" onclick="goToState('goa')">
                <img src="https://images.travelandleisureasia.com/wp-content/uploads/sites/3/2024/04/15151106/palm-beach-1.jpeg?tr=w-1200,q-60">
                <div class="state-overlay"><h3>Goa</h3></div>
            </div>
            <div class="state-card" onclick="goToState('rajasthan')">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/011/084/232/small/full-picture-of-hawa-mahal-of-rajasthan-photo.jpg">
                <div class="state-overlay"><h3>Rajasthan</h3></div>
            </div>
            <div class="state-card" onclick="goToState('uttarakhand')">
                <img src="https://www.peakadventuretour.com/assets/imgs/uttarakhand-tourism-01.webp">
                <div class="state-overlay"><h3>Uttarakhand</h3></div>
            </div>
              <div class="state-card" onclick="goToState('uttar pradesh')">
                <img src="https://s7ap1.scene7.com/is/image/incredibleindia/1-taj-mahal-agra-uttar-pradesh-state-hero?qlt=82&ts=1726650592794">
                <div class="state-overlay"><h3>Uttar Pradesh</h3></div>
            </div>
        </div>
    </section>

<div style="text-align: center; margin-bottom: 40px; margin-top: 60px;">
    <h2 style="font-size: 2.5rem; font-weight: 800; color: white; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px;">
        What Our Travelers Say
    </h2>
    <div style="width: 70px; height: 4px; background: var(--primary); margin: 0 auto; border-radius: 2px;"></div>
    <p style="color: #8b949e; margin-top: 15px; font-size: 1.1rem;">Read real stories from our happy adventurers</p>
</div>

    <section class="feedback-grid">
        <div class="glass-card">
            <h3>Post Your Experience</h3>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-top:20px;">
                <input type="text" id="uName" class="field" placeholder="Full Name">
                <input type="text" id="uLoc" class="field" placeholder="Place (e.g. Manali)">
            </div>
            <div class="star-input" id="starInput">
                <i class="fa fa-star" data-value="1"></i>
                <i class="fa fa-star" data-value="2"></i>
                <i class="fa fa-star" data-value="3"></i>
                <i class="fa fa-star" data-value="4"></i>
                <i class="fa fa-star" data-value="5"></i>
            </div>
            <textarea id="uMsg" class="field" rows="4" placeholder="Share your memories..."></textarea>
            <button onclick="saveReview()" style="width:100%; padding:15px; background:var(--primary); color:white; border:none; border-radius:12px; font-weight:800; cursor:pointer;">Submit Review</button>
        </div>

        <div class="glass-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3>Trip Stories</h3>
                <select id="locFilter" onchange="renderReviews(this.value)" style="background:var(--glass); color:; border:1px solid var(--glass-border); padding:5px 10px; border-radius:8px; outline:none;">
                    <option value="All">All Locations</option>
                    <option value="Manali">Manali</option>
                    <option value="Goa">Goa</option>
                    <option value="Himanchal Pradesh">Himanchal Pradesh</option>
                </select>
            </div>
            <div id="feedBox" style="max-height:300px; overflow-y:auto; display:flex; flex-direction:column; gap:15px;"></div>
        </div>
    </section>

    <footer>
        <div class="footer-grid">
            <div>
                <h2 style="margin-bottom: 20px;">TravelWay.</h2>
                <p style="color: var(--text-dim); font-size: 0.9rem; line-height: 1.6;">Making your travel dreams a reality since 2026. Explore the unexplored with us.</p>
                <div class="social-icons">
                    <a href="#" style="color:white;"><i class="fab fa-instagram"></i></a>
                    <a href="#" style="color:white;"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" style="color:white;"><i class="fab fa-facebook"></i></a>
                </div>
            </div>
            <div class="footer-links">
                <h4>Quick Links</h4>
                <!-- <a href="Our Batches.php">Our Batches</a> -->
                <a href="About us.php">About Us</a>
                <a href="travel.php">Top Destinations</a>
            </div>
            <div class="footer-links">
                <h4>Legal</h4>
                <a href="privacy-policy.php">Privacy Policy</a>
                <a href="terms-of-use.php">Terms of Use</a>
                <a href="cookies-policy.php">Cookies Policy</a>
            </div>
            <div class="footer-links">
                <h4>Support</h4>
                <a href="help-center.php">Help Center</a>
                <a href="refund-policy.php">Refund Policy</a>
                <a href="contact-us.php">Contact Us</a>
            </div>
        </div>
        <div style="text-align: center; margin-top: 50px; border-top: 1px solid var(--glass-border); padding-top: 20px; font-size: 0.8rem; color: var(--text-dim);">
            © 2026 TravelWay Pvt. Ltd. All rights reserved.
        </div>
    </footer>

    <script>
        // BACKGROUND ROTATION
        const backgrounds = ['https://images.unsplash.com/photo-1506461883276-594a12b11cf3?w=1920', 'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?w=1920'];
        let bgIdx = 0;
        setInterval(() => {
            bgIdx = (bgIdx + 1) % backgrounds.length;
            document.getElementById('heroBg').style.backgroundImage = `linear-gradient(rgba(2, 6, 23, 0.3), rgba(2, 6, 23, 0.9)), url('${backgrounds[bgIdx]}')`;
        }, 5000);

       const stateData = {
            "himanchal pradesh": ["Shimla", "Manali", "Kasol", "Spiti Valley", "Dharamshala"],
            "goa": ["North Goa", "South Goa", "Panjim", "Calangute", "Anjuna"],
            "rajasthan": ["Jaipur", "Udaipur", "Jaisalmer", "Pushkar", "Jodhpur"],
            "uttarakhand": ["Rishikesh", "Nainital", "Mussoorie", "Auli", "Kedarnath"],
            "uttar pradesh": ["Agra", "Varanasi", "Lucknow", "Mathura", "Prayagraj"]
        };

        function filterPlaces() {
            const input = document.getElementById('stateInput').value.toLowerCase();
            const drop = document.getElementById('searchDrop');
            drop.innerHTML = "";
            if(input.length > 0) {
                let found = false;
                for(let state in stateData) {
                    const cities = stateData[state];
                    const matchesState = state.includes(input);
                    const matchingCities = cities.filter(city => city.toLowerCase().includes(input));
                    if(matchesState || matchingCities.length > 0) {
                        found = true;
                        const listToShow = matchesState ? cities : matchingCities;
                        listToShow.forEach(place => {
                            const div = document.createElement('div');
                            div.className = "search-item";
                            div.innerHTML = `<i class="fa fa-location-dot"></i> <span><strong>${place}</strong> <small style="opacity:0.6; margin-left:5px;">(${state.toUpperCase()})</small></span>`;
                            div.onclick = () => { window.location.href = `packages.php?state=${state}&location=${place}`; };
                            drop.appendChild(div);
                        });
                    }
                }
                drop.style.display = found ? "block" : "none";
            } else { drop.style.display = "none"; }
        }

        document.addEventListener('click', (e) => {
            if(!e.target.closest('.search-wrapper')) document.getElementById('searchDrop').style.display = "none";
        });

        function goToState(stateName) { window.location.href = `packages.php?state=${stateName}`; }
        const slider = document.getElementById('mainSlider');
        function sideScroll(amt) { slider.scrollLeft += amt; }

        let selectedRating = 0;
        const stars = document.querySelectorAll('#starInput i');
        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                resetStars();
                for(let i=0; i<this.dataset.value; i++) stars[i].classList.add('active');
            });
            star.addEventListener('click', function() { selectedRating = this.dataset.value; });
        });
        document.getElementById('starInput').addEventListener('mouseleave', () => {
            resetStars();
            for(let i=0; i<selectedRating; i++) stars[i].classList.add('active');
        });
        function resetStars() { stars.forEach(s => s.classList.remove('active')); }

        function saveReview() {
            const name = document.getElementById('uName').value;
            const loc = document.getElementById('uLoc').value;
            const msg = document.getElementById('uMsg').value;
            if(!name || !loc || !msg || selectedRating == 0) return alert("Please fill all fields!");
            const review = { name, loc, msg, rating: selectedRating };
            let all = JSON.parse(localStorage.getItem('final_reviews')) || [];
            all.unshift(review);
            localStorage.setItem('final_reviews', JSON.stringify(all));
            location.reload();
        }

        function renderReviews(filter = 'All') {
            const box = document.getElementById('feedBox');
            let data = JSON.parse(localStorage.getItem('final_reviews')) || [];
            if(filter !== 'All') data = data.filter(r => r.loc.toLowerCase().includes(filter.toLowerCase()));
            box.innerHTML = data.map(r => `
                <div style="background:rgba(255,255,255,0.03); padding:20px; border-radius:15px; border:1px solid var(--glass-border);">
                    <div style="display:flex; justify-content:space-between; margin-bottom:5px;">
                        <strong>${r.name} <small style="color:var(--primary)">@ ${r.loc}</small></strong>
                        <span style="color:var(--star-active)">${"★".repeat(r.rating)}</span>
                    </div>
                    <p style="font-size:0.85rem; color:var(--text-dim);">"${r.msg}"</p>
                </div>
            `).join('') || '<p style="text-align:center; color:var(--text-dim);">No reviews yet.</p>';
        }
        window.onload = () => renderReviews();

        // Mobile Menu Toggle
    const menuToggle = document.getElementById('mobile-menu');
    const navMenu = document.getElementById('nav-menu');

    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        // Icon change bars to X
        const icon = menuToggle.querySelector('i');
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-times');
    });
        function toggleUserMenu() { document.getElementById('userDropdown').classList.toggle('active'); }
        // window.addEventListener('click', function(e) {
        window.onclick = function(event) {
            if (!event.target.closest('.user-menu-wrapper')) {
                document.getElementById('userDropdown')?.classList.remove('active');
            }
        };
    </script>
</body>
</html>