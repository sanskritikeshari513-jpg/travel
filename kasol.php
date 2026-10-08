<?php
// URL se main destination ID fetch karna (Jaise: kasol.php?id=2)
// Agar ID missing hai toh default 4 (Kasol ki ID) rakhi hai
$main_id = isset($_GET['id']) ? $_GET['id'] :3;
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasol: Parvati Valley Escape | TravelWay</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #059669; --text: #1e293b; --bg: #f8fafc; --accent: #f59e0b; }
        body { font-family: 'Inter', sans-serif; margin: 0; background: var(--bg); color: var(--text); }
        
        nav { background: white; padding: 18px 8%; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 1000; }
        .logo { font-weight: 800; font-size: 1.4rem; text-decoration: none; color: var(--text); }
        .nav-links { display: flex; gap: 25px; border-left: 1px solid #e2e8f0; padding-left: 25px; }
        .nav-links a { text-decoration: none; color: #64748b; font-size: 0.9rem; font-weight: 500; }

        .pkg-tabs { display: flex; gap: 10px; margin-bottom: 25px; overflow-x: auto; padding-bottom: 5px; }
        .tab-btn { padding: 12px 20px; border-radius: 10px; border: 1px solid #e2e8f0; background: white; cursor: pointer; font-weight: 600; font-size: 0.85rem; white-space: nowrap; transition: 0.3s; color: #64748b; }
        .tab-btn.active { background: var(--primary); color: white; border-color: var(--primary); box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2); }

        .container { display: grid; grid-template-columns: 1.8fr 1.1fr; gap: 40px; padding: 40px 8%; }
        .image-gallery { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; margin-bottom: 30px; }
        .image-gallery img { width: 100%; height: 180px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); }

        .inclusion-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-top: 20px; }
        .inc-item { background: white; padding: 15px; border-radius: 10px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 12px; transition: 0.3s; }
        .inc-item:hover { border-color: var(--primary); transform: translateY(-3px); }
        .inc-item i { color: var(--primary); font-size: 1.2rem; background: #ecfdf5; padding: 10px; border-radius: 8px; width: 20px; text-align: center; }
        .inc-text strong { display: block; font-size: 0.85rem; }
        .inc-text span { font-size: 0.75rem; color: #64748b; }

        .best-time-box { background: #fffbeb; border: 1px solid #fde68a; padding: 20px; border-radius: 12px; margin: 30px 0; display: flex; gap: 15px; align-items: flex-start; }
        .best-time-box i { color: #d97706; font-size: 1.4rem; margin-top: 3px; }
        .season-grid { display: flex; gap: 20px; margin-top: 10px; }
        .season-tag { font-size: 0.8rem; font-weight: 600; padding: 4px 12px; border-radius: 20px; background: white; border: 1px solid #fde68a; }

        .selection-box { background: #f0fdf4; padding: 25px; border-radius: 12px; border: 1px solid #dcfce7; margin: 30px 0; }
        .date-option { background: white; padding: 15px; border-radius: 10px; display: flex; align-items: center; cursor: pointer; margin-bottom: 12px; border: 2px solid transparent; transition: 0.2s; }
        .date-option.active { border-color: var(--primary); background: #ecfdf5; }
        .date-option input { margin-right: 15px; accent-color: var(--primary); }

        .sidebar { background: white; padding: 35px; border-radius: 16px; border: 1px solid #e2e8f0; position: sticky; top: 110px; height: fit-content; }
        .price { font-size: 2.8rem; font-weight: 800; color: var(--primary); margin: 10px 0; }
        .btn-book { background: var(--primary); color: white; width: 100%; border: none; padding: 18px; border-radius: 12px; font-weight: 700; cursor: pointer; font-size: 1.1rem; margin-top: 25px; display: flex; justify-content: center; align-items: center; gap: 10px; }
        
        .itinerary-section { margin-top: 40px; }
        .section-title { font-size: 1.3rem; font-weight: 700; margin-bottom: 25px; display: flex; align-items: center; gap: 10px; }
        .itinerary-container { position: relative; padding-left: 20px; }
        .itinerary-container::before { content: ''; position: absolute; left: 0; top: 10px; bottom: 10px; width: 2px; background: #e2e8f0; }
        .day-card { position: relative; margin-bottom: 30px; padding-left: 30px; }
        .day-card::before { content: ''; position: absolute; left: -5px; top: 5px; width: 12px; height: 12px; background: white; border: 2px solid var(--primary); border-radius: 50%; z-index: 2; }
        .day-label { font-size: 0.75rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .day-content h4 { margin: 0 0 10px 0; font-size: 1.1rem; color: var(--text); }
        .day-content p { font-size: 0.9rem; color: #64748b; line-height: 1.5; margin-bottom: 10px; }
        .stay-tag { display: inline-block; font-size: 0.75rem; background: #f1f5f9; padding: 4px 10px; border-radius: 5px; font-weight: 600; color: #475569; }

        .back-btn { text-decoration: none; color: #64748b; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; transition: 0.3s; }
        .back-btn:hover { color: var(--primary); transform: translateX(-5px); }

        @media (max-width: 1024px) { .container { grid-template-columns: 1fr; gap: 30px; } .sidebar { position: static; top: auto; } }
        @media (max-width: 768px) { nav { padding: 14px 5%; flex-wrap: wrap; gap: 10px; } .nav-links { display: none; } }
        @media (max-width: 600px) { .image-gallery { grid-template-columns: 1fr; } .inclusion-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<nav>
    <div style="display:flex; align-items:center; gap:25px;">
        <a href="javascript:history.back()" class="back-btn"><i class="fa fa-chevron-left"></i> Back</a>
        <div class="nav-links">
            <a href="travel.php"><i class="fa fa-home"></i> Home</a>
        </div>
    </div>
    <div style="font-size: 0.75rem; font-weight: 700; color: #059669;"><i class="fa fa-check-circle"></i> Certified Retreat</div>
</nav>

<div class="container">
    <div>
        <span id="pkg-label" style="color:var(--primary); font-weight:700; font-size:0.8rem; text-transform:uppercase; letter-spacing:1px;">Parvati Valley Vibe</span>
        <h1 id="pkg-title" style="font-size:2.5rem; margin:10px 0 25px; font-weight:800;">Kasol & Manikaran Retreat</h1>

        <div class="pkg-tabs">
            <button class="tab-btn active" onclick="updatePackage('standard')">Standard</button>
            <button class="tab-btn" onclick="updatePackage('family')">Family Special</button>
            <button class="tab-btn" onclick="updatePackage('honeymoon')">Honeymoon / Couple</button>
            <button class="tab-btn" onclick="updatePackage('adventure')">Adventurous Trip</button>
        </div>

        <div class="image-gallery" id="main-gallery"></div>

        <h3 style="margin-bottom:20px;"><i class="fa fa-star" style="color:var(--accent)"></i> What's Included?</h3>
        <div class="inclusion-grid" id="inclusion-box"></div>

        <div id="transport-info-box" class="inc-item transport-highlight">
            <i id="trans-icon" class="fa fa-bus"></i>
            <div class="inc-text">
                <strong id="transport-title">Transport: Semi-Sleeper Volvo</strong>
                <span id="transport-desc">Group departure from Delhi/Majnu ka Tila.</span>
            </div>
        </div>

        <div class="best-time-box">
            <i class="fa fa-leaf"></i>
            <div>
                <h4 style="margin:0 0 5px 0; font-size:1rem; color:#92400e;">Best Time to Visit Kasol</h4>
                <div class="season-grid">
                    <div class="season-tag">🌳 Mar-Jun (Lush)</div>
                    <div class="season-tag">❄️ Nov-Feb (Snowy)</div>
                    <div class="season-tag">🍂 Oct (Autumn)</div>
                </div>
            </div>
        </div>

        <div class="selection-box">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h3 style="margin:0; font-size:1.1rem;"><i class="fa fa-calendar-alt"></i> Select Your Batch</h3>
                <a href="Our Batches.php" style="font-size: 0.8rem; font-weight: 600; color: var(--primary); text-decoration: none;">
                    View All Batch Dates <i class="fa fa-arrow-right" style="font-size: 0.7rem;"></i>
                </a>
            </div>
            
            <div class="radio-group">
                <label class="date-option">
                    <input type="radio" name="tripDate" value="2026-03-20" onchange="syncSelection(this)">
                    <div style="flex-grow:1;"><strong>20th March 2026</strong> <span style="color:var(--primary); font-size:0.75rem;">(Spring Holiday)</span></div>
                    <span style="font-size:0.7rem; font-weight:700; color:#059669;">FIXED</span>
                </label>
                <label class="date-option active">
                    <input type="radio" name="tripDate" value="custom" checked onchange="syncSelection(this)">
                    <div style="flex-grow:1;"><strong>Customize My Trip</strong> <span style="color:#64748b; font-size:0.75rem;">(Select any date)</span></div>
                    <span style="font-size:0.7rem; font-weight:700; color:#64748b;">FLEXI</span>
                </label>
            </div>
        </div>

        <div class="itinerary-section">
            <h3 class="section-title"><i class="fa fa-map-marked-alt"></i> 5 Days Parvati Journey</h3>
            <div class="itinerary-container" id="itinerary-box"></div>
        </div>
    </div>

    <div class="sidebar">
        <p style="margin:0; font-size:0.95rem; color:#64748b;">Final Price</p>
        <div class="price" id="final-price">₹7,499</div>
        <div style="background:#f0fdf4; color:#166534; padding:10px; border-radius:8px; font-size:0.8rem; font-weight:600; margin-bottom:20px;">
            <i class="fa fa-bolt"></i> Fast Selling! Only 5 slots left.
        </div>
        <ul style="padding:0; list-style:none; font-size:0.85rem; color:#4b5563;">
            <li style="margin-bottom:12px;"><i class="fa fa-snowflake" style="color:#3b82f6"></i> Theme: <span id="pkg-theme">Standard</span></li>
            <li style="margin-bottom:12px;"><i class="fa fa-clock" style="color:var(--accent)"></i> Duration: 4N / 5D</li>
            <li style="margin-bottom:12px;"><i class="fa fa-undo" style="color:#ef4444"></i> Full Refund (7 Days Prior)</li>
            <li><i class="fa fa-shield-alt" style="color:var(--primary)"></i> Secure Payment Gateway</li>
        </ul>
        <button class="btn-book" onclick="proceed()">Book Now <i class="fa fa-arrow-right"></i></button>
    </div>
</div>

<script>
    // PHP se real Package ID yahan fetch hogi
    const currentMainId = "<?php echo $main_id; ?>";

    let currentPkgType = 'standard';
    let selectedDate = 'custom';

    const packages = {
        standard: {
            themeName: "Standard",
            label: "Backpacker's Choice",
            price: 7499,
            images: ["https://images.unsplash.com/photo-1596306637311-6655a6d5774a?w=800", "https://images.unsplash.com/photo-1617191519105-d07b98b10de6?w=800", "https://images.unsplash.com/photo-1626083168239-1667b93a027c?w=800", "https://images.unsplash.com/photo-1582234032599-23259954d799?w=800"],
            inclusions: [{icon: 'fa-bus', title: 'Volvo', desc: 'Semi-Sleeper AC'}, {icon: 'fa-campground', title: 'Riverside', desc: 'Hotel/Camp Stay'}, {icon: 'fa-utensils', title: 'Food', desc: 'Bfast & Dinner'}, {icon: 'fa-hiking', title: 'Tosh', desc: 'Village Visit'}],
            itinerary: ["Arrival & River Relaxation", "Manikaran Sahib Hot Springs", "Tosh Village Short Trek", "Chalal Village Nature Walk", "Market Shopping & Departure"]
        },
        family: {
            themeName: "Family Special",
            label: "Comfort Family Trip",
            price: 9999,
            images: ["https://images.unsplash.com/photo-1570125909232-eb263c188f7e?w=800", "https://images.unsplash.com/photo-1544133782-b6442be5d53d?w=800", "https://images.unsplash.com/photo-1506461883276-594a12b11cf3?w=800", "https://images.unsplash.com/photo-1533130061792-64b345e4a833?w=800"],
            inclusions: [{icon: 'fa-hotel', title: 'Luxury Resort', desc: 'Family Stay'}, {icon: 'fa-car', title: 'Private SUV', desc: 'Local SUV Car'}, {icon: 'fa-utensils', title: 'All Meals', desc: '3-Course Meals'}, {icon: 'fa-praying-hands', title: 'VIP Entry', desc: 'Manikaran Temple'}],
            itinerary: ["Kasol Arrival & High Tea", "Manikaran Hot Springs", "Drive to Tosh Scenic View", "Nature Park Family Walk", "Luxury Volvo Departure"]
        },
        honeymoon: {
            themeName: "Honeymoon",
            label: "Romantic Parvati Escape",
            price: 12500,
            images: ["https://images.unsplash.com/photo-1533222481259-ce20eda1e20b?w=800", "https://images.unsplash.com/photo-1590483734731-5079860b730f?w=800", "https://images.unsplash.com/photo-1516550893923-42d28e5677af?w=800", "https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=800"],
            inclusions: [{icon: 'fa-heart', title: 'Romantic Decor', desc: 'Room Setting'}, {icon: 'fa-wine-glass', title: 'Dinner', desc: 'Private Candlelight'}, {icon: 'fa-camera', title: 'Shoot', desc: 'Photography Session'}, {icon: 'fa-gift', title: 'Hamper', desc: 'Tea & Honey Kit'}],
            itinerary: ["Private Cottage Check-in", "Romantic Hot Springs Visit", "Kalga/Pulga Village Drive", "Riverside Bonfire Dinner", "Shopping & Bye"]
        },
        adventure: {
            themeName: "Adventurous",
            label: "The Great Kheerganga Trek",
            price: 10999,
            images: ["https://images.unsplash.com/photo-1527004013197-933c4bb611b3?w=800", "https://images.unsplash.com/photo-1551632811-561732d1e306?w=800", "https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800", "https://images.unsplash.com/photo-1502781252888-9143ba7f074e?w=800"],
            inclusions: [{icon: 'fa-mountain', title: 'Kheerganga', desc: 'Guided Summit Trek'}, {icon: 'fa-campground', title: 'Camping', desc: 'Night Tents'}, {icon: 'fa-burn', title: 'Springs', desc: 'Natural Hot Bath'}, {icon: 'fa-hiking', title: 'Malana', desc: 'Ancient Village Visit'}],
            itinerary: ["Trek to Chalal Village", "Barshaini to Kheerganga Trek", "Camping & Hot Spring Bath", "Malana Village Exploration", "Cafe Hopping & Departure"]
        }
    };

    function updatePackage(type) {
        currentPkgType = type;
        const pkg = packages[type];
        
        document.getElementById('pkg-theme').innerText = pkg.themeName;
        document.getElementById('pkg-label').innerText = pkg.label;
        
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.toggle('active', btn.innerText.toLowerCase().includes(type.substring(0,3)));
        });
        
        document.getElementById('main-gallery').innerHTML = pkg.images.map(img => `<img src="${img}">`).join('');
        document.getElementById('inclusion-box').innerHTML = pkg.inclusions.map(inc => `<div class="inc-item"><i class="fa ${inc.icon}"></i><div class="inc-text"><strong>${inc.title}</strong><span>${inc.desc}</span></div></div>`).join('');
        document.getElementById('itinerary-box').innerHTML = pkg.itinerary.map((text, i) => `<div class="day-card"><div class="day-label">Day ${i+1}</div><div class="day-content"><h4>${text}</h4><p>Complete Parvati Valley experience.</p></div></div>`).join('');
        
        updatePrice();
    }

    function syncSelection(input) {
        selectedDate = input.value;
        document.querySelectorAll('.date-option').forEach(opt => opt.classList.remove('active'));
        input.parentElement.classList.add('active');

        const isCustom = (selectedDate === 'custom');
        document.getElementById('transport-title').innerText = isCustom ? "Transport: Private Cab" : "Transport: Semi-Sleeper Volvo";
        document.getElementById('trans-icon').className = isCustom ? "fa fa-car" : "fa fa-bus";
        document.getElementById('transport-desc').innerText = isCustom ? "Private SUV/Sedan from Delhi." : "Group departure via Semi-Sleeper Volvo.";
        updatePrice();
    }

    function updatePrice() {
        let base = packages[currentPkgType].price;
        let extra = (selectedDate === 'custom') ? 3500 : 0;
        document.getElementById('final-price').innerText = "₹" + (base + extra).toLocaleString();
    }

    function proceed() {
        const priceStr = document.getElementById('final-price').innerText.replace('₹', '').replace(',', '');
        // FIX: Yahan template literal use ho raha hai bina kisi error ke
        window.location.href = `booking.php?id=${currentMainId}&date=${selectedDate}&price=${priceStr}&theme=${currentPkgType}`;
    }

    window.onload = () => updatePackage('standard');
</script>
</body>
</html>