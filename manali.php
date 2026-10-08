<?php
// URL se main destination ID fetch karna (Default 2 Manali ke liye)
$main_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manali Magical Adventure | 5-Day Premium Experience</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #0ea5e9; --primary-dark: #0284c7; --text: #0f172a; --bg: #f1f5f9; --accent: #f59e0b; --success: #059669; }
        body { font-family: 'Inter', sans-serif; margin: 0; background: var(--bg); color: var(--text); line-height: 1.6; }
        
        /* Navigation */
        nav { background: white; padding: 15px 8%; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .back-btn { text-decoration: none; color: #64748b; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 8px; transition: 0.2s; }
        .back-btn:hover { color: var(--primary); }

        .container { display: grid; grid-template-columns: 1.8fr 1.1fr; gap: 40px; padding: 40px 8%; max-width: 1400px; margin: 0 auto; }
        
        /* Step UI */
        .step-badge { background: #f0f9ff; color: var(--primary); padding: 6px 16px; border-radius: 20px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; border: 1px solid #e0f2fe; display: inline-block; margin-bottom: 10px; }
        .section-title { font-size: 1.8rem; font-weight: 800; margin-bottom: 25px; display: flex; align-items: center; gap: 15px; }

        /* Theme Selection Cards */
        .theme-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px; margin-bottom: 30px; }
        .theme-card { background: white; border: 2px solid #e2e8f0; padding: 20px 15px; border-radius: 16px; cursor: pointer; text-align: center; transition: 0.3s; position: relative; }
        .theme-card i { font-size: 1.5rem; margin-bottom: 10px; color: #94a3b8; transition: 0.3s; }
        .theme-card span { display: block; font-weight: 700; font-size: 0.85rem; color: #64748b; }
        .theme-card.active { border-color: var(--primary); background: #f0f9ff; transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.2); }
        .theme-card.active i { color: var(--primary); }
        .theme-card.active span { color: var(--primary); }

        /* Gallery */
        .image-gallery { display: grid; grid-template-columns: 2fr 1fr; grid-template-rows: repeat(2, 150px); gap: 12px; margin-bottom: 25px; }
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
        .date-option.active { border-color: var(--primary); background: #f0f9ff; }
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
        .btn-book:hover { background: var(--primary-dark); transform: translateY(-3px); box-shadow: 0 15px 30px rgba(14, 165, 233, 0.3); }

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
    </style>
</head>
<body>

<nav>
    <a href="javascript:history.back()" class="back-btn"><i class="fa fa-chevron-left"></i> Return to Explorer</a>
    <div style="font-weight: 700; color: var(--success);"><i class="fa fa-shield-check"></i> 100% Verified Manali Trip</div>
</nav>

<div class="container">
    <div class="main-content">
        <span class="step-badge">Step 01: Personalize Experience</span>
        <h1 class="section-title">Manali Magical Adventure</h1>
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
                <i class="fa fa-parachute-box"></i>
                <span>Adventure</span>
            </div>
        </div>

        <div class="image-gallery" id="gallery"></div>

        <div class="best-time-section">
            <div class="bt-header">
                <i class="fa fa-clock-rotate-left" style="color:var(--accent);"></i>
                Seasonal Intelligence - Manali
            </div>
            <div class="bt-grid">
                <div class="bt-card" id="season-winter">
                    <span class="rec-label">RECOMMENDED</span>
                    <i class="fa fa-snowflake" style="color:#0ea5e9;"></i>
                    <strong>DEC - FEB</strong>
                    <span>Perfect for Snow & Skiing</span>
                </div>
                <div class="bt-card" id="season-summer">
                    <span class="rec-label">RECOMMENDED</span>
                    <i class="fa fa-spa" style="color:#10b981;"></i>
                    <strong>MAR - JUN</strong>
                    <span>Pleasant Weather & Flowers</span>
                </div>
                <div class="bt-card" id="season-autumn">
                    <span class="rec-label">RECOMMENDED</span>
                    <i class="fa fa-leaf" style="color:#f59e0b;"></i>
                    <strong>OCT - NOV</strong>
                    <span>Magical Autumn Views</span>
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
                <input type="radio" name="tripDate" value="2026-03-25">
                <div style="flex-grow:1">
                    <strong>25th March 2026</strong>
                    <span style="display:block; font-size:0.75rem; color:#64748b;">Spring Holiday Group Batch</span>
                </div>
                <span style="font-size:0.7rem; font-weight:800; color:var(--success);">FIXED</span>
            </label>

            <label class="date-option active" onclick="toggleDateMode('custom', this)">
                <input type="radio" name="tripDate" value="custom" checked>
                <div style="flex-grow:1">
                    <strong>Customize My Own Date</strong>
                    <span style="display:block; font-size:0.75rem; color:#64748b;">Private SUV + Flexible itinerary</span>
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
            <span style="background:#f0f9ff; color:var(--primary); padding:5px 15px; border-radius:20px; font-size:0.75rem; font-weight:700;">Magical Manali Deal</span>
        </div>
        <p style="margin:0; font-size:0.9rem; color:#64748b;">Starting price for 4N/5D</p>
        <div class="price-tag" id="display-price">₹12,999</div>
        
        <div style="background:#f8fafc; padding:20px; border-radius:16px; margin-top:20px;">
            <ul style="list-style:none; padding:0; margin:0; font-size:0.85rem;">
                <li style="display:flex; justify-content:space-between; margin-bottom:10px;">
                    <span>Theme:</span><strong id="side-theme">Standard</strong>
                </li>
                <li style="display:flex; justify-content:space-between; margin-bottom:10px;">
                    <span>Transport:</span><strong id="side-trans">Private SUV</strong>
                </li>
                <li style="display:flex; justify-content:space-between;">
                    <span>Duration:</span><strong>5 Days / 4 Nights</strong>
                </li>
            </ul>
        </div>

        <button class="btn-book" onclick="validateAndProceed()">Confirm & Book Now <i class="fa fa-arrow-right"></i></button>
        <p style="text-align:center; font-size:0.7rem; color:#94a3b8; margin-top:20px;"><i class="fa fa-undo"></i> Full refund if cancelled 7 days prior</p>
    </div>
</div>

<script>
    const data = {
        standard: {
            title: "Standard Manali", price: 12999,
            best: ['season-winter'], // Highlighting Logic
            imgs: ["https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?w=800", "https://images.unsplash.com/photo-1597074866923-dc0589150358?w=400", "https://images.unsplash.com/photo-1599661046289-e31897846e41?w=400"],
            inc: [{i:'fa-bus', t:'Luxury Volvo', d:'Delhi-Manali-Delhi'}, {i:'fa-hotel', t:'5-Star Hotel', d:'Prime Location'}, {i:'fa-utensils', t:'Half Board', d:'Breakfast & Dinner'}, {i:'fa-camera', t:'Sightseeing', d:'Solang & Local Sites'}],
            itin: ["Manali Arrival & Hadimba Temple", "Solang Valley Snow Point", "Rohtang Pass (Subject to permit)", "Kullu Valley & Kasol Walk", "Old Manali & Departure"]
        },
        family: {
            title: "Family Special", price: 14999,
            best: ['season-summer'],
            imgs: ["https://images.unsplash.com/photo-1502781252888-9143ba7f074e?w=800", "https://media1.thrillophilia.com/filestore/jezkw1hz3yrpmiqlbobdguc5f54m_shutterstock_1938178192.jpg?w=400&dpr=2", "https://images.unsplash.com/photo-1536431311719-398b6704d4cc?w=400"],
            inc: [{i:'fa-users', t:'Family Suite', d:'Large Premium Rooms'}, {i:'fa-car', t:'Private SUV', d:'Personal Sightseeing'}, {i:'fa-utensils', t:'Full Meals', d:'Breakfast, Lunch, Dinner'}, {i:'fa-child', t:'Kids Zone', d:'Special Activity Access'}],
            itin: ["Family Arrival & Mall Road", "Solang Fun with Kids", "Safe Rohtang Drive", "Kullu Rafting Experience", "Souvenir Shopping & Bye"]
        },
        honeymoon: {
            title: "Honeymoon Pack", price: 17500,
            best: ['season-winter', 'season-autumn'],
            imgs: ["https://guidetour.in/wp-content/uploads/2022/02/Romantic-trip-in-Manali-For-Honeymoon.jpg", "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2c/b0/be/97/romantic-hotels.jpg?w=1200&h=-1&s=1", "https://images.unsplash.com/photo-1516550893923-42d28e5677af?w=400"],
            inc: [{i:'fa-heart', t:'Flower Decor', d:'Romantic Room Setup'}, {i:'fa-wine-glass', t:'Candlelight', d:'Private Dinner Night'}, {i:'fa-glass-cheers', t:'Couple Milk', d:'Nightly Badam Milk'}, {i:'fa-gem', t:'Surprise', d:'Exclusive Manali Gift'}],
            itin: ["VIP Check-in & Decor", "Solang Valley Romantic Walk", "Rohtang Couple Shoot", "Private Candlelight Dinner", "Mall Road Shopping"]
        },
        adventure: {
            title: "Adventure Pack", price: 15999,
            best: ['season-summer', 'season-autumn'],
            imgs: ["https://images.unsplash.com/photo-1533130061792-64b345e4a833?w=800", "https://infiniteadventureclub.com/wp-content/uploads/2024/01/raftingbg.jpg", "https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=400"],
            inc: [{i:'fa-parachute-box', t:'Paragliding', d:'High Flying Action'}, {i:'fa-water', t:'Beas Rafting', d:'9KM Grade 4 Rapids'}, {i:'fa-campground', t:'Riverside Camp', d:'Luxury Tented Stay'}, {i:'fa-mountain', t:'Trekking', d:'Jogini Falls Hike'}],
            itin: ["Jogini Waterfall Trek", "Paragliding & Solang ATVs", "Snow Point & Rohtang", "Riverside Camping & Bonfire", "Final Mall Road Session"]
        }
    };

    let currentMode = 'custom';
    let currentTheme = 'standard';

    function updatePkg(theme, btn) {
        currentTheme = theme;
        const p = data[theme];
        
        document.querySelectorAll('.theme-card').forEach(c => c.classList.remove('active'));
        btn.classList.add('active');

        // Update Seasonal Highlighting
        document.querySelectorAll('.bt-card').forEach(c => c.classList.remove('recommended'));
        p.best.forEach(id => document.getElementById(id).classList.add('recommended'));

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
                <p style="margin:5px 0; font-size:0.8rem; color:#64748b;">Guided sightseeing included in your package.</p>
            </div>`).join('');

        document.getElementById('side-theme').innerText = p.title;
        
        handleDateChange(); // Refresh smart tip if date already selected
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
        document.getElementById('trans-title').innerText = isCustom ? 'Transport: Private Luxury SUV' : 'Transport: Volvo AC Bus';
        document.getElementById('trans-desc').innerText = isCustom ? 'Exclusive car for your group with door pickup.' : 'Group departure from Delhi via Volvo.';
        document.getElementById('side-trans').innerText = isCustom ? 'Private SUV' : 'Volvo Bus';

        renderPrice();
    }

    function handleDateChange() {
        const startInput = document.getElementById('start-date');
        const box = document.getElementById('return-date-box');
        const tip = document.getElementById('smart-tip');
        
        if(startInput.value) {
            const d = new Date(startInput.value);
            const month = d.getMonth(); // 0-11
            
            // Sync Return Date
            const rd = new Date(d);
            rd.setDate(rd.getDate() + 4); 
            box.innerText = rd.toLocaleDateString('en-IN', {day:'numeric', month:'short', year:'numeric'});
            document.getElementById('date-section').classList.remove('shake');

            // SMART TIP LOGIC
            tip.style.display = 'flex';
            let tipText = "";
            let tipIcon = "fa-lightbulb";

            if(month >= 2 && month <= 5) { // Mar - Jun
                tipText = "Excellent choice! Perfect weather.";
                tipIcon = "fa-sun";
            } else if(month >= 11 || month <= 1) { // Dec - Feb
                tipText = "Winter Magic! Ideal for snow activities and skiing experiences.";
                tipIcon = "fa-snowflake";
            } else if(month >= 9 && month <= 10) { // Oct - Nov
                tipText = "Autumn Vibe: Crisp air and magical golden views of the mountains.";
                tipIcon = "fa-leaf";
            } else {
                tipText = "Monsoon Special: Romantic mist and waterfalls, though some high passes may be restricted.";
                tipIcon = "fa-cloud-showers-heavy";
            }
            
            tip.innerHTML = `<i class="fa ${tipIcon}"></i> <span>${tipText}</span>`;
        }
    }

    function renderPrice() {
        const base = data[currentTheme].price;
        const extra = (currentMode === 'custom') ? 4000 : 0; 
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

        const chosenDate = (currentMode === 'fixed') ? '2026-03-25' : dateInput;
        window.location.href = `booking.php?id=<?php echo $main_id; ?>&date=${chosenDate}&price=${finalPrice}&theme=${currentTheme}&days=5`;
    }

    // Initialize with standard theme on load
    window.onload = () => updatePkg('standard', document.querySelector('.theme-card'));
</script>
</body>
</html>