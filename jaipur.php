<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jaipur: The Pink City | TravelWay</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #db2777; --text: #1e293b; --bg: #fffafb; --accent: #f59e0b; }
        body { font-family: 'Inter', sans-serif; margin: 0; background: var(--bg); color: var(--text); }
        
        nav { background: white; padding: 18px 8%; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 1000; }
        .logo { font-weight: 800; font-size: 1.4rem; text-decoration: none; color: var(--text); }
        .nav-links { display: flex; gap: 25px; border-left: 1px solid #e2e8f0; padding-left: 25px; }
        .nav-links a { text-decoration: none; color: #64748b; font-size: 0.9rem; font-weight: 500; }

        .pkg-tabs { display: flex; gap: 10px; margin-bottom: 25px; overflow-x: auto; padding-bottom: 5px; }
        .tab-btn { padding: 12px 20px; border-radius: 10px; border: 1px solid #e2e8f0; background: white; cursor: pointer; font-weight: 600; font-size: 0.85rem; white-space: nowrap; transition: 0.3s; color: #64748b; }
        .tab-btn.active { background: var(--primary); color: white; border-color: var(--primary); box-shadow: 0 4px 12px rgba(219, 39, 119, 0.2); }

        .container { display: grid; grid-template-columns: 1.8fr 1.1fr; gap: 40px; padding: 40px 8%; }
        .image-gallery { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; margin-bottom: 30px; }
        .image-gallery img { width: 100%; height: 180px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); }

        .inclusion-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-top: 20px; }
        .inc-item { background: white; padding: 15px; border-radius: 10px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 12px; transition: 0.3s; }
        .inc-item:hover { border-color: var(--primary); transform: translateY(-3px); }
        .inc-item i { color: var(--primary); font-size: 1.2rem; background: #fdf2f8; padding: 10px; border-radius: 8px; width: 20px; text-align: center; }
        .inc-text strong { display: block; font-size: 0.85rem; }
        .inc-text span { font-size: 0.75rem; color: #64748b; }

        .best-time-box { background: #fffbeb; border: 1px solid #fde68a; padding: 20px; border-radius: 12px; margin: 30px 0; display: flex; gap: 15px; align-items: flex-start; }
        .best-time-box i { color: #d97706; font-size: 1.4rem; margin-top: 3px; }
        .season-grid { display: flex; gap: 20px; margin-top: 10px; }
        .season-tag { font-size: 0.8rem; font-weight: 600; padding: 4px 12px; border-radius: 20px; background: white; border: 1px solid #fde68a; }

        .selection-box { background: #fff1f2; padding: 25px; border-radius: 12px; border: 1px solid #fecdd3; margin: 30px 0; }
        .date-option { background: white; padding: 15px; border-radius: 10px; display: flex; align-items: center; cursor: pointer; margin-bottom: 12px; border: 2px solid transparent; transition: 0.2s; }
        .date-option.active { border-color: var(--primary); background: #fff1f2; }
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

        .back-btn { text-decoration: none; color: #64748b; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; transition: 0.3s; }
        .back-btn:hover { color: var(--primary); transform: translateX(-5px); }
        .transport-highlight { grid-column: span 2; background: #fdf2f8 !important; border: 2px dashed var(--primary) !important; margin-top: 15px; }

        @media (max-width: 1024px) { .container { grid-template-columns: 1fr; gap: 30px; } .sidebar { position: static; top: auto; } }
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
    <div style="font-size: 0.75rem; font-weight: 700; color: #db2777;"><i class="fa fa-crown"></i> Royal Heritage Package</div>
</nav>

<div class="container">
    <div>
        <span id="pkg-label" style="color:var(--primary); font-weight:700; font-size:0.8rem; text-transform:uppercase; letter-spacing:1px;">Heritage Rajasthan</span>
        <h1 id="pkg-title" style="font-size:2.5rem; margin:10px 0 25px; font-weight:800;">Jaipur: The Pink City</h1>

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
                <strong id="transport-title">Transport: AC Sleeper Coach</strong>
                <span id="transport-desc">Overnight journey from Delhi via Premium Coach.</span>
            </div>
        </div>

        <div class="best-time-box">
            <i class="fa fa-calendar-check"></i>
            <div>
                <h4 style="margin:0 0 5px 0; font-size:1rem; color:#92400e;">Best Time to Visit Jaipur</h4>
                <div class="season-grid">
                    <div class="season-tag">🏰 Nov-Feb (Peak Season)</div>
                    <div class="season-tag">🌦️ Jul-Sep (Monsoon)</div>
                    <div class="season-tag">☀️ Mar (Holi Festival)</div>
                </div>
            </div>
        </div>

        <div class="selection-box">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h3 style="margin: 0 0 15px; font-size: 1.1rem;"><i class="fa fa-calendar-alt"></i> Select Your Batch</h3>
            <a href="Our Batches.php" style="font-size: 0.8rem; font-weight: 600; color: var(--primary); text-decoration: none;">
                    View All Batch Dates <i class="fa fa-arrow-right" style="font-size: 0.7rem;"></i>
                </a>
                        </div>
            <div class="radio-group">
                <label class="date-option">
                    <input type="radio" name="tripDate" value="2026-03-25" onchange="syncSelection(this)">
                    <div style="flex-grow:1;"><strong>25th March 2026</strong> <span style="color:var(--primary); font-size:0.75rem;">(Royal Heritage Tour)</span></div>
                    <span style="font-size:0.7rem; font-weight:700; color:var(--primary);">FIXED</span>
                </label>
                <label class="date-option active">
                    <input type="radio" name="tripDate" value="custom" checked onchange="syncSelection(this)">
                    <div style="flex-grow:1;"><strong>Customize My Trip</strong> <span style="color:#64748b; font-size:0.75rem;">(Any date of your choice)</span></div>
                    <span style="font-size:0.7rem; font-weight:700; color:#64748b;">FLEXI</span>
                </label>
            </div>
        </div>

        <div class="itinerary-section">
            <h3 class="section-title"><i class="fa fa-map-marked-alt"></i> 3 Days Royal Itinerary</h3>
            <div class="itinerary-container" id="itinerary-box"></div>
        </div>
    </div>

    <div class="sidebar">
        <p style="margin:0; font-size:0.95rem; color:#64748b;">Final Price</p>
        <div class="price" id="final-price">₹5,999</div>
        <div style="background:#fdf2f8; color:#9d174d; padding:10px; border-radius:8px; font-size:0.8rem; font-weight:600; margin-bottom:20px;">
            <i class="fa fa-bolt"></i> Filling Fast! Group of 20 only.
        </div>
        <ul style="padding:0; list-style:none; font-size:0.85rem; color:#4b5563;">
            <li style="margin-bottom:12px;"><i class="fa fa-palette" style="color:var(--primary)"></i> Theme: <span id="pkg-theme">Standard</span></li>
            <li style="margin-bottom:12px;"><i class="fa fa-clock" style="color:var(--accent)"></i> Duration: 2N / 3D</li>
            <li style="margin-bottom:12px;"><i class="fa fa-undo" style="color:#ef4444"></i> Full Refund (5 Days Prior)</li>
            <li><i class="fa fa-shield-alt" style="color:#16a34a"></i> Secure Payment Gateway</li>
        </ul>
        <button class="btn-book" onclick="proceed()">Book Now <i class="fa fa-arrow-right"></i></button>
    </div>
</div>

<script>
    let currentPkgType = 'standard';
    let selectedDate = 'custom';
    const packageIds = { standard: 10, family: 11, honeymoon: 12, adventure: 13 };

    const packages = {
        standard: {
            themeName: "Heritage Standard",
            label: "Explorer's Choice",
            price: 5999,
            images: ["https://images.unsplash.com/photo-1599661046289-e31897846e41?w=800", "https://images.unsplash.com/photo-1524230572899-a752b3835840?w=800", "https://images.unsplash.com/photo-1603262110263-fb0112e7cc33?w=800", "https://images.unsplash.com/photo-1477587458883-47145ed94245?w=800"],
            inclusions: [{icon:'fa-hotel', title:'Budget Stay', desc:'AC Rooms in City'}, {icon:'fa-utensils', title:'Breakfast', desc:'Authentic Rajasthani'}, {icon:'fa-landmark', title:'City Tour', desc:'Hawa Mahal & Jantar Mantar'}, {icon:'fa-shopping-bag', title:'Market', desc:'Bapu Bazaar Walk'}],
            itinerary: ["Arrival & Pink City Night Walk", "Amer Fort & Jal Mahal Exploration", "Hawa Mahal & City Palace Visit"]
        },
        family: {
            themeName: "Family Heritage",
            label: "Traditional Family Pack",
            price: 8500,
            images: ["https://images.unsplash.com/photo-1599661046289-e31897846e41?w=800", "https://images.unsplash.com/photo-1590424067954-463695240590?w=800", "https://images.unsplash.com/photo-1628151474268-07d2f954ec83?w=800", "https://images.unsplash.com/photo-1532375811400-d36e92e172ed?w=800"],
            inclusions: [{icon:'fa-home', title:'Heritage Haveli', desc:'Royal Family Suite'}, {icon:'fa-car', title:'Private SUV', desc:'Local Sightseeing'}, {icon:'fa-utensils', title:'Chokhi Dhani', desc:'Dinner & Cultural Show'}, {icon:'fa-elephant', title:'Fort Ride', desc:'Amer Fort Entrance'}],
            itinerary: ["Royal Check-in & City Museum", "Full Day Fort Tour with Elephant Ride", "Chokhi Dhani Cultural Experience"]
        },
        honeymoon: {
            themeName: "Royal Romance",
            label: "Maharaja Couple Pack",
            price: 11999,
            images: ["https://images.unsplash.com/photo-1602339588293-5b86ad4905fc?w=800", "https://images.unsplash.com/photo-1544133782-b6442be5d53d?w=800", "https://images.unsplash.com/photo-1590483734731-5079860b730f?w=800", "https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=800"],
            inclusions: [{icon:'fa-crown', title:'Luxury Palace', desc:'Suite with View'}, {icon:'fa-wine-glass', title:'Roof Dinner', desc:'Private Palace View'}, {icon:'fa-camera', title:'Photoshoot', desc:'Heritage Pre-wedding Style'}, {icon:'fa-gem', title:'Gift', desc:'Traditional Jewelry Kit'}],
            itinerary: ["Romantic Haveli Welcome", "Sunset at Nahargarh Fort", "Palace Sightseeing & Candlelight Dinner"]
        },
        adventure: {
            themeName: "Desert & Forts",
            label: "Jaipur Adventure Pack",
            price: 7999,
            images: ["https://images.unsplash.com/photo-1591147551068-d05047f078e8?w=800", "https://images.unsplash.com/photo-1502781252888-9143ba7f074e?w=800", "https://images.unsplash.com/photo-1533130061792-64b345e4a833?w=800", "https://images.unsplash.com/photo-1551632811-561732d1e306?w=800"],
            inclusions: [{icon:'fa-parachute-box', title:'Paragliding', desc:'Subject to Weather'}, {icon:'fa-bicycle', title:'Cycling Tour', desc:'Early Morning Forts'}, {icon:'fa-hiking', title:'Nahargarh Hike', desc:'Offbeat Trail'}, {icon:'fa-fire', title:'Camping', desc:'Sand Dunes Stay'}],
            itinerary: ["Early Morning Cycling to Amer", "Nahargarh Offbeat Hiking", "Desert Camping & Folk Music"]
        }
    };

    function updatePackage(type) {
        currentPkgType = type;
        const pkg = packages[type];
        
        document.getElementById('pkg-label').innerText = pkg.label;
        document.getElementById('pkg-theme').innerText = pkg.themeName;
        
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.toggle('active', btn.innerText.toLowerCase().includes(type.substring(0,3)));
        });

        document.getElementById('main-gallery').innerHTML = pkg.images.map(img => `<img src="${img}">`).join('');
        document.getElementById('inclusion-box').innerHTML = pkg.inclusions.map(inc => `<div class="inc-item"><i class="fa ${inc.icon}"></i><div class="inc-text"><strong>${inc.title}</strong><span>${inc.desc}</span></div></div>`).join('');
        document.getElementById('itinerary-box').innerHTML = pkg.itinerary.map((text, i) => `<div class="day-card"><div class="day-label">Day ${i+1}</div><div class="day-content"><h4>${text}</h4><p>Guided tour through historical landmarks.</p></div></div>`).join('');

        updatePrice();
    }

    function syncSelection(input) {
        selectedDate = input.value;
        document.querySelectorAll('.date-option').forEach(opt => opt.classList.remove('active'));
        input.parentElement.classList.add('active');

        const isCustom = (selectedDate === 'custom');
        document.getElementById('transport-title').innerText = isCustom ? "Transport: Private Sedan" : "Transport: AC Sleeper Coach";
        document.getElementById('trans-icon').className = isCustom ? "fa fa-car" : "fa fa-bus";
        document.getElementById('transport-desc').innerText = isCustom ? "Door-to-door private pickup." : "Overnight journey via Premium Coach.";
        
        updatePrice();
    }

    function updatePrice() {
        let base = packages[currentPkgType].price;
        let extra = (selectedDate === 'custom') ? 1500 : 0;
        document.getElementById('final-price').innerText = "₹" + (base + extra).toLocaleString();
    }

    function proceed() {
        const priceStr = document.getElementById('final-price').innerText.replace('₹', '').replace(',', '');
        const id = packageIds[currentPkgType];
        window.location.href = `booking.php?id=${id}&date=${selectedDate}&price=${priceStr}`;
    }

    window.onload = () => updatePackage('standard');
</script>
</body>
</html>