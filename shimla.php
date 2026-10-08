<?php
// URL se main package ID fetch karna (Default 1 Shimla ke liye)
$main_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shimla: Queen of Hills | 5-Day Holiday Experience</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #2563eb; --primary-dark: #1d4ed8; --text: #0f172a; --bg: #f1f5f9; --accent: #f59e0b; --success: #059669; }
        body { font-family: 'Inter', sans-serif; margin: 0; background: var(--bg); color: var(--text); line-height: 1.6; }
        
        /* Navigation */
        nav { background: white; padding: 15px 8%; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .back-btn { text-decoration: none; color: #64748b; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 8px; transition: 0.2s; }
        .back-btn:hover { color: var(--primary); }

        .container { display: grid; grid-template-columns: 1.8fr 1.1fr; gap: 40px; padding: 40px 8%; max-width: 1400px; margin: 0 auto; }
        
        /* Step UI */
        .step-badge { background: #eff6ff; color: var(--primary); padding: 6px 16px; border-radius: 20px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; border: 1px solid #dbeafe; display: inline-block; margin-bottom: 10px; }
        .section-title { font-size: 1.8rem; font-weight: 800; margin-bottom: 25px; display: flex; align-items: center; gap: 15px; }

        /* Theme Selection Cards */
        .theme-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px; margin-bottom: 30px; }
        .theme-card { background: white; border: 2px solid #e2e8f0; padding: 20px 15px; border-radius: 16px; cursor: pointer; text-align: center; transition: 0.3s; position: relative; }
        .theme-card i { font-size: 1.5rem; margin-bottom: 10px; color: #94a3b8; transition: 0.3s; }
        .theme-card span { display: block; font-weight: 700; font-size: 0.85rem; color: #64748b; }
        .theme-card.active { border-color: var(--primary); background: #eff6ff; transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2); }
        .theme-card.active i { color: var(--primary); }
        .theme-card.active span { color: var(--primary); }

        /* Gallery */
        .image-gallery { display: grid; grid-template-columns: 2fr 1fr; grid-template-rows: repeat(2, 150px); gap: 12px; margin-bottom: 35px; }
        .image-gallery img { width: 100%; height: 100%; object-fit: cover; border-radius: 16px; transition: 0.3s; }
        .img-main { grid-row: span 2; }

        /* DYNAMIC SEASONAL SECTION */
        .best-time-section { background: white; border-radius: 20px; padding: 20px; margin-bottom: 30px; border: 1px solid #e2e8f0; }
        .bt-header { display: flex; align-items: center; gap: 10px; margin-bottom: 15px; font-weight: 700; font-size: 0.95rem; color: var(--text); }
        .bt-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
        .bt-card { background: #f8fafc; border: 1px solid #f1f5f9; padding: 12px; border-radius: 12px; text-align: center; transition: 0.4s; opacity: 0.6; }
        .bt-card.recommended { opacity: 1; border-color: var(--accent); background: #fffbeb; transform: scale(1.02); box-shadow: 0 4px 12px rgba(245, 158, 11, 0.1); }
        .bt-card i { font-size: 1.1rem; margin-bottom: 5px; display: block; }
        .bt-card strong { font-size: 0.8rem; display: block; }
        .bt-card span { font-size: 0.65rem; color: #64748b; }
        .rec-label { font-size: 0.55rem; font-weight: 900; color: var(--accent); letter-spacing: 1px; display: none; margin-bottom: 4px; }
        .bt-card.recommended .rec-label { display: block; }

        /* Inclusion Cards */
        .inclusion-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .inc-item { background: white; padding: 16px; border-radius: 14px; display: flex; align-items: center; gap: 15px; border: 1px solid #e2e8f0; }
        .inc-item i { background: #f8fafc; color: var(--primary); padding: 12px; border-radius: 10px; font-size: 1.1rem; width: 20px; text-align: center; }
        .inc-item strong { font-size: 0.9rem; display: block; }
        .inc-item span { font-size: 0.75rem; color: #64748b; }

        /* Transport Highlight */
        .transport-card { background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 2px dashed #16a34a; padding: 20px; border-radius: 16px; margin: 25px 0; display: flex; align-items: center; gap: 20px; }
        .trans-icon-circle { width: 50px; height: 50px; background: #16a34a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }

        /* Date Selection */
        .date-card { background: white; padding: 25px; border-radius: 20px; border: 1px solid #e2e8f0; }
        .date-option { display: flex; align-items: center; padding: 15px; border: 2px solid #f1f5f9; border-radius: 12px; margin-bottom: 12px; cursor: pointer; transition: 0.2s; }
        .date-option.active { border-color: var(--primary); background: #eff6ff; }
        .date-option input { accent-color: var(--primary); width: 18px; height: 18px; margin-right: 15px; }

        /* Smart Tip Style */
        #smart-tip { margin-top: 15px; padding: 12px 18px; border-radius: 12px; font-size: 0.85rem; display: none; align-items: center; gap: 12px; background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }

        /* Itinerary Timeline */
        .timeline { border-left: 2px solid #e2e8f0; margin-left: 10px; padding-left: 30px; position: relative; }
        .day-block { position: relative; margin-bottom: 30px; }
        .day-block::before { content: ''; position: absolute; left: -37px; top: 0; width: 12px; height: 12px; background: white; border: 2px solid var(--primary); border-radius: 50%; }
        .day-tag { font-size: 0.7rem; font-weight: 800; color: var(--primary); text-transform: uppercase; }

        /* Sidebar */
        .sidebar { background: white; padding: 35px; border-radius: 24px; border: 1px solid #e2e8f0; position: sticky; top: 100px; height: fit-content; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.05); }
        .price-tag { font-size: 3rem; font-weight: 800; color: var(--text); letter-spacing: -1px; }
        .btn-book { background: var(--primary); color: white; width: 100%; border: none; padding: 22px; border-radius: 18px; font-weight: 700; cursor: pointer; font-size: 1.1rem; margin-top: 25px; transition: 0.3s; display: flex; justify-content: center; align-items: center; gap: 10px; }
        .btn-book:hover { background: var(--primary-dark); transform: translateY(-3px); box-shadow: 0 15px 30px rgba(37, 99, 235, 0.3); }

        .shake { animation: shake 0.4s ease-in-out; border-color: #ef4444 !important; }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-8px); } 50% { transform: translateX(8px); } 75% { transform: translateX(-8px); } }

        @media (max-width: 1024px) { .container { grid-template-columns: 1fr; } .sidebar { position: static; } }
        @media (max-width: 768px) {
            nav { padding: 12px 5%; flex-direction: column; align-items: flex-start; gap: 8px; }
            .theme-grid { grid-template-columns: repeat(2, 1fr); }
            .bt-grid { grid-template-columns: 1fr; }
            .image-gallery { grid-template-columns: 1fr; grid-template-rows: auto; }
            .img-main { height: 200px; }
            .inclusion-grid { grid-template-columns: 1fr; }
        }

        .container {
    display: grid;
    grid-template-columns: 1.8fr 1.1fr;
    gap: 40px;
    padding: 40px 8%;
    max-width: 1400px;
    margin: 0 auto;
}

@media (max-width: 1024px) {
    .container {
        grid-template-columns: 1fr;
        padding: 20px 5%;
    }
}

@media (max-width: 768px) {

    nav {
        padding: 12px 5%;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .section-title {
        font-size: 1.4rem;
    }

    .container {
        padding: 20px 4%;
        gap: 20px;
    }

    .theme-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .bt-grid {
        grid-template-columns: 1fr;
    }

    .image-gallery {
        grid-template-columns: 1fr;
        grid-template-rows: auto;
    }

    .img-main {
        height: 200px;
    }

    .inclusion-grid {
        grid-template-columns: 1fr;
    }

    .sidebar {
        padding: 20px;
    }

    .price-tag {
        font-size: 2rem;
    }

    .btn-book {
        padding: 16px;
        font-size: 1rem;
    }

    /* DATE PICKER STACK FIX */
    #custom-date-picker div {
        flex-direction: column !important;
        align-items: flex-start !important;
    }
}

#custom-date-picker > div {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.image-gallery img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 16px;
}

/* Mobile fix */
@media (max-width: 768px) {
    .image-gallery img {
        height: 180px;
    }
}

.btn-book {
    min-height: 50px;
}
    </style>
</head>
<body>

<nav>
    <a href="javascript:history.back()" class="back-btn"><i class="fa fa-chevron-left"></i> Return to Explorer</a>
    <div style="font-weight: 700; color: var(--success);"><i class="fa fa-lock"></i> Secure 256-bit SSL</div>
</nav>

<div class="container">
    <div class="main-content">
        <span class="step-badge">Step 01: Personalize Experience</span>
        <h1 class="section-title">Shimla: Queen of Hills</h1>
        <h3 class="step-title">Choose Travel Theme <span style="color:#ef4444; font-size:0.7rem;">(REQUIRED)</span></h3>

        <div class="theme-grid" id="theme-selector">
            <div class="theme-card active" onclick="updatePkg('standard', this)">
                <i class="fa fa-snowflake"></i>
                <span>Standard</span>
            </div>
            <div class="theme-card" onclick="updatePkg('family', this)">
                <i class="fa fa-users"></i>
                <span>Family Special</span>
            </div>
            <div class="theme-card" onclick="updatePkg('honeymoon', this)">
                <i class="fa fa-heart"></i>
                <span>Honeymoon</span>
            </div>
            <div class="theme-card" onclick="updatePkg('adventure', this)">
                <i class="fa fa-mountain"></i>
                <span>Adventure</span>
            </div>
        </div>

        <div class="image-gallery" id="gallery"></div>

        <div class="best-time-section">
            <div class="bt-header">
                <i class="fa fa-clock-rotate-left" style="color:var(--accent);"></i>
                Seasonal Intelligence - Shimla
            </div>
            <div class="bt-grid">
                <div class="bt-card" id="season-winter">
                    <span class="rec-label">RECOMMENDED</span>
                    <i class="fa fa-snowflake" style="color:#2563eb;"></i>
                    <strong>DEC - FEB</strong>
                    <span>Best for Snowfall & Mall Road Walk</span>
                </div>
                <div class="bt-card" id="season-summer">
                    <span class="rec-label">RECOMMENDED</span>
                    <i class="fa fa-sun" style="color:#f59e0b;"></i>
                    <strong>MAR - JUN</strong>
                    <span>Peak Season: Pleasant & Green</span>
                </div>
                <div class="bt-card" id="season-autumn">
                    <span class="rec-label">RECOMMENDED</span>
                    <i class="fa fa-camera" style="color:#059669;"></i>
                    <strong>SEP - NOV</strong>
                    <span>Clear Skies & Photography</span>
                </div>
            </div>
        </div>

        <div class="inclusion-grid" id="inclusions"></div>

        <div class="transport-card">
            <div class="trans-icon-circle" id="trans-icon"><i class="fa fa-bus"></i></div>
            <div style="flex-grow:1">
                <h4 style="margin:0; font-size:1rem;" id="trans-title">Transport: Volvo AC Bus</h4>
                <p style="margin:5px 0 0; font-size:0.8rem; color:#475569;" id="trans-desc">Luxury Volvo from Delhi with reclining seats.</p>
            </div>
            <div style="background: white; padding: 5px 12px; border-radius: 10px; font-weight: 800; font-size: 0.7rem; color: #16a34a;">INCLUDED</div>
        </div>

        <span class="step-badge" style="margin-top:20px;">Step 02: Selection of Dates</span>
        <h2 class="section-title">When are you traveling?</h2>

        <div class="date-card" id="date-section">
            <label class="date-option" onclick="toggleDateMode('fixed', this)">
                <input type="radio" name="tripDate" value="2026-03-15">
                <div style="flex-grow:1">
                    <strong>15th March 2026</strong>
                    <span style="display:block; font-size:0.75rem; color:#64748b;">Spring Special Batch (Guided Group)</span>
                </div>
                <span style="font-size:0.7rem; font-weight:800; color:var(--success);">FIXED</span>
            </label>

            <label class="date-option active" onclick="toggleDateMode('custom', this)">
                <input type="radio" name="tripDate" value="custom" checked>
                <div style="flex-grow:1">
                    <strong>Customize My Own Date</strong>
                    <span style="display:block; font-size:0.75rem; color:#64748b;">Private Cab + Flexible schedule</span>
                </div>
                <span style="font-size:0.7rem; font-weight:800; color:#64748b;">FLEXI</span>
            </label>

            <div id="custom-date-picker" style="margin-top:20px; padding:20px; background:#f8fafc; border-radius:12px;">
                <div style="display:flex; align-items:center; gap:20px;">
                    <div>
                        <small style="display:block; margin-bottom:5px; font-weight:700;">Start Date</small>
                        <input type="date" id="start-date" min="<?php echo date('Y-m-d'); ?>" style="padding:12px; border:1px solid #cbd5e1; border-radius:8px;" onchange="handleDateChange()">
                    </div>
                    <div style="font-size:1.5rem; color:#cbd5e1; padding-top:20px;">→</div>
                    <div>
                        <small style="display:block; margin-bottom:5px; font-weight:700;">Return (4N/5D)</small>
                        <div id="return-date-box" style="padding:12px; font-weight:700; color:var(--primary);">Select Start Date</div>
                    </div>
                </div>
                <div id="smart-tip"></div>
            </div>
        </div>

        <h2 class="section-title" style="margin-top:50px;">Detailed 5-Day Itinerary</h2>
        <div class="timeline" id="itinerary"></div>
    </div>

    <div class="sidebar">
        <div style="text-align:center; margin-bottom:20px;">
            <span style="background:#f0fdf4; color:#166534; padding:5px 15px; border-radius:20px; font-size:0.75rem; font-weight:700;">4.8/5 Top Rated</span>
        </div>
        <p style="margin:0; font-size:0.9rem; color:#64748b;">All-inclusive price for 4N/5D</p>
        <div class="price-tag" id="display-price">₹8,999</div>
        
        <div style="background:#f8fafc; padding:20px; border-radius:16px; margin-top:20px;">
            <ul style="list-style:none; padding:0; margin:0; font-size:0.85rem;">
                <li style="display:flex; justify-content:space-between; margin-bottom:10px;">
                    <span>Theme:</span><strong id="side-theme">Standard</strong>
                </li>
                <li style="display:flex; justify-content:space-between; margin-bottom:10px;">
                    <span>Transport:</span><strong id="side-trans">Private Cab</strong>
                </li>
                <li style="display:flex; justify-content:space-between;">
                    <span>Trip Length:</span><strong>5 Days / 4 Nights</strong>
                </li>
            </ul>
        </div>

        <button class="btn-book" onclick="validateAndProceed()">Confirm & Book Now <i class="fa fa-arrow-right"></i></button>
        <p style="text-align:center; font-size:0.7rem; color:#94a3b8; margin-top:20px;"><i class="fa fa-shield-alt"></i> Safe & Secure Payment</p>
    </div>
</div>

<script>
    const data = {
        standard: {
            title: "Shimla Standard", price: 8999,
            best: ['season-summer'],
            imgs: ["https://images.unsplash.com/photo-1597074866923-dc0589150358?w=800", "https://media.istockphoto.com/id/1492080164/photo/rampur-bushahr-town-himachal-pradesh-india.jpg?s=612x612&w=0&k=20&c=mUG_jCG7RYY3tpgVHAor_70IwnnFxdH1LoWNpPmY5CA=", "https://www.shutterstock.com/image-photo/beautiful-panoramic-cityscape-shimla-state-260nw-1439505056.jpg"],
            inc: [{i:'fa-bus', t:'Volvo AC', d:'Delhi-Shimla Return'}, {i:'fa-hotel', t:'3-Star Stay', d:'Near Mall Road'}, {i:'fa-utensils', t:'Half Board', d:'Bfast & Dinner'}, {i:'fa-mountain', t:'Tours', d:'Kufri Sightseeing'}],
            itin: ["Arrival & Ridge Walk", "Kufri Adventure Day", "Jakhoo Hill & Temples", "Naldehra Apple Orchards", "Local Shopping & Departure"]
        },
        family: {
            title: "Family Special", price: 11500,
            best: ['season-summer', 'season-winter'],
            imgs: ["https://images.unsplash.com/photo-1502781252888-9143ba7f074e?w=400", "https://cdn-ilbjdfn.nitrocdn.com/JDEetOddPmOJLQSmduuiPeKUeWUIkYNC/assets/images/optimized/rev-e5dd637/familyyatra.com/wp-content/uploads/2024/11/kids-1024x768.jpg", "https://manalitourplanner.com/wp-content/uploads/2025/03/3-Nights-4-Days-Shimla-Family-Tour-Package.png"],
            inc: [{i:'fa-users', t:'Family Suite', d:'Large interconnected rooms'}, {i:'fa-car', t:'Private SUV', d:'Personal Sightseeing'}, {i:'fa-train', t:'Toy Train', d:'Heritage Ride Included'}, {i:'fa-utensils', t:'Full Board', d:'All Meals Included'}],
            itin: ["Toy Train Arrival", "Kufri Fun World", "Museum & Bird Park", "Chail Day Trip", "Souvenir Shopping & Return"]
        },
        honeymoon: {
            title: "Honeymoon Special", price: 14500,
            best: ['season-winter', 'season-autumn'],
            imgs: ["https://swastikholiday.com/india-honeymoon-packages/images/shimla-tour-itinerary-1.jpg", "https://www.honeymooninnshimla.com/assets-honeymoon/images/room2.jpg", "https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=400"],
            inc: [{i:'fa-heart', t:'Romantic Decor', d:'Flower & Candlelight'}, {i:'fa-car', t:'Private Sedan', d:'Exclusive Car'}, {i:'fa-wine-glass', t:'Special Cake', d:'Honeymoon Special'}, {i:'fa-gem', t:'Surprise Gift', d:'For the Couple'}],
            itin: ["VIP Decor Check-in", "Romantic Green Valley", "Mashobra Pine Forest", "Candlelight Dinner Night", "Mall Road Evening"]
        },
        adventure: {
            title: "Adventure Pack", price: 12500,
            best: ['season-autumn', 'season-summer'],
            imgs: ["https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800", "https://www.swantour.com/blogs/wp-content/uploads/2019/04/Paragliding-in-Shimla.jpg", "https://images.unsplash.com/photo-1551632811-561732d1e306?w=400"],
            inc: [{i:'fa-mountain', t:'Trekking', d:'Guided Shali Tibba'}, {i:'fa-campground', t:'Camping', d:'Forest Camp Night'}, {i:'fa-fire', t:'Bonfire', d:'Music & Night Fire'}, {i:'fa-bicycle', t:'Mountain Biking', d:'Morning Session'}],
            itin: ["Jakhoo Hill Trek", "Mashobra Jungle Camp", "Shali Tibba Hiking", "Rock Climbing Session", "Departure"]
        }
    };

    let currentMode = 'custom';
    let currentTheme = 'standard';

    function updatePkg(theme, btn) {
        currentTheme = theme;
        const p = data[theme];
        
        document.querySelectorAll('.theme-card').forEach(c => c.classList.remove('active'));
        btn.classList.add('active');

        // Seasonal Highlighting
        document.querySelectorAll('.bt-card').forEach(c => c.classList.remove('recommended'));
        p.best.forEach(id => {
            const el = document.getElementById(id);
            if(el) el.classList.add('recommended');
        });

        // Gallery Update
        document.getElementById('gallery').innerHTML = `
            <img src="${p.imgs[0]}" class="img-main">
            <img src="${p.imgs[1]}">
            <img src="${p.imgs[2]}">`;

        // Inclusions Update
        document.getElementById('inclusions').innerHTML = p.inc.map(x => `
            <div class="inc-item">
                <i class="fa ${x.i}"></i>
                <div><strong>${x.t}</strong><span>${x.d}</span></div>
            </div>`).join('');

        // Itinerary Update
        document.getElementById('itinerary').innerHTML = p.itin.map((x, i) => `
            <div class="day-block">
                <span class="day-tag">Day 0${i+1}</span>
                <h4 style="margin:5px 0 0;">${x}</h4>
                <p style="margin:5px 0; font-size:0.8rem; color:#64748b;">Complete exploration with professional guide.</p>
            </div>`).join('');

        document.getElementById('side-theme').innerText = p.title;
        handleDateChange();
        renderPrice();
    }

    function toggleDateMode(mode, el) {
        currentMode = mode;
        document.querySelectorAll('.date-option').forEach(o => o.classList.remove('active'));
        el.classList.add('active');
        el.querySelector('input').checked = true;

        document.getElementById('custom-date-picker').style.display = (mode === 'custom') ? 'block' : 'none';
        
        const isCustom = mode === 'custom';
        document.getElementById('trans-icon').innerHTML = isCustom ? '<i class="fa fa-car"></i>' : '<i class="fa fa-bus"></i>';
        document.getElementById('trans-title').innerText = isCustom ? 'Transport: Private Luxury Cab' : 'Transport: Volvo AC Bus';
        document.getElementById('trans-desc').innerText = isCustom ? 'Dedicated car for your group with flexible timings.' : 'Fixed group departure from Delhi via Volvo.';
        document.getElementById('side-trans').innerText = isCustom ? 'Private Cab' : 'Volvo Bus';

        renderPrice();
    }

    function handleDateChange() {
        const startInput = document.getElementById('start-date');
        const box = document.getElementById('return-date-box');
        const tip = document.getElementById('smart-tip');
        
        if(startInput.value) {
            const d = new Date(startInput.value);
            const month = d.getMonth();
            
            // Return Date Sync
            const rd = new Date(d);
            rd.setDate(rd.getDate() + 4); 
            box.innerText = rd.toLocaleDateString('en-IN', {day:'numeric', month:'short', year:'numeric'});
            document.getElementById('date-section').classList.remove('shake');

            // SMART TIP LOGIC
            tip.style.display = 'flex';
            let tipText = "";
            let tipIcon = "fa-lightbulb";

            if(month >= 2 && month <= 5) { // Mar-Jun
                tipText = "Great Timing! The weather is perfect for the Heritage Toy Train ride.";
                tipIcon = "fa-train";
            } else if(month >= 11 || month <= 1) { // Dec-Feb
                tipText = "Snowfall Alert! Dress in heavy layers to enjoy the Mall Road in snow.";
                tipIcon = "fa-snowflake";
            } else if(month >= 8 && month <= 10) { // Sep-Nov
                tipText = "Post-monsoon Beauty: Ideal for clear mountain views and photography.";
                tipIcon = "fa-camera";
            } else {
                tipText = "Monsoon Experience: The hills are lush green, perfect for a cozy stay.";
                tipIcon = "fa-cloud-rain";
            }
            tip.innerHTML = `<i class="fa ${tipIcon}"></i> <span>${tipText}</span>`;
        }
    }

    function renderPrice() {
        const base = data[currentTheme].price;
        const extra = (currentMode === 'custom') ? 2000 : 0; 
        document.getElementById('display-price').innerText = "₹" + (base + extra).toLocaleString();
    }

    function validateAndProceed() {
        const dateInput = document.getElementById('start-date').value;
        const finalPrice = document.getElementById('display-price').innerText.replace(/[₹,]/g, '');

        if(currentMode === 'custom' && !dateInput) {
            const section = document.getElementById('date-section');
            section.classList.add('shake');
            section.scrollIntoView({behavior:'smooth', block:'center'});
            setTimeout(() => section.classList.remove('shake'), 400);
            return;
        }

        const chosenDate = (currentMode === 'fixed') ? '2026-03-15' : dateInput;
        window.location.href = `booking.php?id=<?php echo $main_id; ?>&date=${chosenDate}&price=${finalPrice}&theme=${currentTheme}&days=5`;
    }

    window.onload = () => updatePkg('standard', document.querySelector('.theme-card'));
</script>
</body>
</html>