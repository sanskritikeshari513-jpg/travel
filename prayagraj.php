<?php
$main_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 16;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prayagraj Grand Heritage | 5-Day Spiritual Journey</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #f59e0b; --primary-dark: #d97706; --text: #0f172a; --bg: #f1f5f9; --accent: #ef4444; --success: #059669; }
        body { font-family: 'Inter', sans-serif; margin: 0; background: var(--bg); color: var(--text); line-height: 1.6; }
        
        /* Navigation */
        nav { background: white; padding: 15px 8%; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .back-btn { text-decoration: none; color: #64748b; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 8px; transition: 0.2s; }
        .back-btn:hover { color: var(--primary); }

        .container { display: grid; grid-template-columns: 1.8fr 1.1fr; gap: 40px; padding: 40px 8%; max-width: 1400px; margin: 0 auto; }
        
        /* Step UI */
        .step-badge { background: #fffbeb; color: var(--primary); padding: 6px 16px; border-radius: 20px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; border: 1px solid #fef3c7; display: inline-block; margin-bottom: 10px; }
        .section-title { font-size: 1.8rem; font-weight: 800; margin-bottom: 25px; display: flex; align-items: center; gap: 15px; }

        /* Theme Selection Cards */
        .theme-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px; margin-bottom: 30px; }
        .theme-card { background: white; border: 2px solid #e2e8f0; padding: 20px 15px; border-radius: 16px; cursor: pointer; text-align: center; transition: 0.3s; position: relative; }
        .theme-card i { font-size: 1.5rem; margin-bottom: 10px; color: #94a3b8; transition: 0.3s; }
        .theme-card span { display: block; font-weight: 700; font-size: 0.85rem; color: #64748b; }
        .theme-card.active { border-color: var(--primary); background: #fffbeb; transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.2); }
        .theme-card.active i { color: var(--primary); }
        .theme-card.active span { color: var(--primary); }

        /* Gallery */
        .image-gallery { display: grid; grid-template-columns: 2fr 1fr; grid-template-rows: repeat(2, 150px); gap: 12px; margin-bottom: 35px; }
        .image-gallery img { width: 100%; height: 100%; object-fit: cover; border-radius: 16px; }
        .img-main { grid-row: span 2; }

        /* Inclusion Cards */
        .inclusion-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .inc-item { background: white; padding: 16px; border-radius: 14px; display: flex; align-items: center; gap: 15px; border: 1px solid #e2e8f0; }
        .inc-item i { background: #f8fafc; color: var(--primary); padding: 12px; border-radius: 10px; font-size: 1.1rem; }
        .inc-item strong { font-size: 0.9rem; display: block; }
        .inc-item span { font-size: 0.75rem; color: #64748b; }

        /* Transport Highlight */
        .transport-card { background: linear-gradient(135deg, #fffbeb 0%, #fff7ed 100%); border: 2px dashed var(--primary); padding: 20px; border-radius: 16px; margin: 25px 0; display: flex; align-items: center; gap: 20px; }
        .trans-icon-circle { width: 50px; height: 50px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }

        /* Date Selection */
        .date-card { background: white; padding: 25px; border-radius: 20px; border: 1px solid #e2e8f0; }
        .date-option { display: flex; align-items: center; padding: 15px; border: 2px solid #f1f5f9; border-radius: 12px; margin-bottom: 12px; cursor: pointer; transition: 0.2s; }
        .date-option.active { border-color: var(--primary); background: #fffbeb; }
        .date-option input { accent-color: var(--primary); width: 18px; height: 18px; margin-right: 15px; }

        /* Itinerary Timeline */
        .timeline { border-left: 2px solid #e2e8f0; margin-left: 10px; padding-left: 30px; position: relative; }
        .day-block { position: relative; margin-bottom: 30px; }
        .day-block::before { content: ''; position: absolute; left: -37px; top: 0; width: 12px; height: 12px; background: white; border: 2px solid var(--primary); border-radius: 50%; }
        .day-tag { font-size: 0.7rem; font-weight: 800; color: var(--primary); text-transform: uppercase; }

        /* Sidebar */
        .sidebar { background: white; padding: 35px; border-radius: 24px; border: 1px solid #e2e8f0; position: sticky; top: 100px; height: fit-content; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.05); }
        .price-tag { font-size: 3rem; font-weight: 800; color: var(--text); letter-spacing: -1px; }
        .btn-book { background: var(--primary); color: white; width: 100%; border: none; padding: 22px; border-radius: 18px; font-weight: 700; cursor: pointer; font-size: 1.1rem; margin-top: 25px; transition: 0.3s; display: flex; justify-content: center; align-items: center; gap: 10px; }
        .btn-book:hover { background: var(--primary-dark); transform: translateY(-3px); box-shadow: 0 15px 30px rgba(245, 158, 11, 0.3); }

        .shake { animation: shake 0.4s ease-in-out; border-color: var(--accent) !important; }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-8px); } 50% { transform: translateX(8px); } 75% { transform: translateX(-8px); } }

       
        @media (max-width: 1024px) { .container { grid-template-columns: 1fr; } .sidebar { position: static; } }
    
    /* ================= RESPONSIVE DESIGN ================= */

/* Tablet */
@media (max-width: 1024px) {
    .container {
        grid-template-columns: 1fr;
        padding: 20px 5%;
        gap: 25px;
    }

    .sidebar {
        position: static;
        order: 2;
        margin-top: 20px;
    }

    .main-content {
        order: 1;
    }
}

/* Mobile */
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
        padding: 15px;
    }

    /* Theme cards */
    .theme-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    /* Gallery */
    .image-gallery {
        grid-template-columns: 1fr;
        grid-template-rows: auto;
    }

    .img-main {
        grid-row: auto;
        height: 200px;
    }

    .image-gallery img {
        height: 120px;
    }

    /* Inclusion */
    .inclusion-grid {
        grid-template-columns: 1fr;
    }

    /* Transport card */
    .transport-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    /* Date picker */
    #custom-date-picker > div {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    /* Sidebar */
    .sidebar {
        padding: 20px;
        border-radius: 18px;
    }

    .price-tag {
        font-size: 2.2rem;
    }

    .btn-book {
        padding: 16px;
        font-size: 1rem;
    }
}

/* Small Mobile */
@media (max-width: 480px) {

    .theme-grid {
        grid-template-columns: 1fr;
    }

    .section-title {
        font-size: 1.2rem;
    }

    .price-tag {
        font-size: 2rem;
    }

    .inc-item {
        flex-direction: row;
        gap: 10px;
    }

    .inc-item i {
        padding: 10px;
        font-size: 1rem;
    }

    .btn-book {
        font-size: 0.95rem;
    }
}
.image-gallery img {
    transition: transform 0.3s;
}

.image-gallery img:hover {
    transform: scale(1.03);
}
.theme-card {
    min-height: 100px;
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
        <h1 class="section-title">Grand Prayagraj Heritage Tour</h1>
        <h3 class="step-title">Choose Travel Theme <span style="color:var(--accent); font-size:0.7rem;">(REQUIRED)</span></h3>

        <div class="theme-grid" id="theme-selector">
            <div class="theme-card active" onclick="updatePkg('standard', this)">
                <i class="fa fa-dharmachakra"></i>
                <span>Standard</span>
            </div>
            <div class="theme-card" onclick="updatePkg('family', this)">
                <i class="fa fa-users"></i>
                <span>Family Special</span>
            </div>
            <div class="theme-card" onclick="updatePkg('heritage', this)">
                <i class="fa fa-fort-awesome"></i>
                <span>Heritage Trip</span>
            </div>
            <div class="theme-card" onclick="updatePkg('luxury', this)">
                <i class="fa fa-crown"></i>
                <span>Royal Luxury</span>
            </div>
        </div>

        <div class="image-gallery" id="gallery">
            </div>

        <div class="inclusion-grid" id="inclusions">
            </div>

        <div class="transport-card">
            <div class="trans-icon-circle" id="trans-icon"><i class="fa fa-bus"></i></div>
            <div style="flex-grow:1">
                <h4 style="margin:0; font-size:1rem;" id="trans-title">Transport: Group Tourist AC Coach</h4>
                <p style="margin:5px 0 0; font-size:0.8rem; color:#64748b;" id="trans-desc">Professional driver with group pickup from station/airport.</p>
            </div>
            <div style="background: white; padding: 5px 12px; border-radius: 10px; font-weight: 800; font-size: 0.7rem; color: var(--primary);">ACTIVE</div>
        </div>

        <span class="step-badge" style="margin-top:20px;">Step 02: Selection of Dates</span>
        <h2 class="section-title">When are you traveling?</h2>

        <div class="date-card" id="date-section">
            <label class="date-option" onclick="toggleDateMode('fixed', this)">
                <input type="radio" name="tripDate" value="2026-05-10">
                <div style="flex-grow:1">
                    <strong>10th May 2026</strong>
                    <span style="display:block; font-size:0.75rem; color:#64748b;">Kumbh Special Batch (Guided Group)</span>
                </div>
                <span style="font-size:0.7rem; font-weight:800; color:var(--success);">POPULAR</span>
            </label>

            <label class="date-option active" onclick="toggleDateMode('custom', this)">
                <input type="radio" name="tripDate" value="custom" checked>
                <div style="flex-grow:1">
                    <strong>Customize My Own Date</strong>
                    <span style="display:block; font-size:0.75rem; color:#64748b;">Private Sedan + Flexible timings</span>
                </div>
                <span style="font-size:0.7rem; font-weight:800; color:#64748b;">FLEXI</span>
            </label>

            <div id="custom-date-picker" style="margin-top:20px; padding:20px; background:#f8fafc; border-radius:12px;">
                <div style="display:flex; align-items:center; gap:20px;">
                    <div>
                        <small style="display:block; margin-bottom:5px; font-weight:700;">Arrival Date</small>
                        <input type="date" id="start-date" min="<?php echo date('Y-m-d'); ?>" style="padding:12px; border:1px solid #cbd5e1; border-radius:8px;" onchange="syncReturnDate()">
                    </div>
                    <div style="font-size:1.5rem; color:#cbd5e1; padding-top:20px;">→</div>
                    <div>
                        <small style="display:block; margin-bottom:5px; font-weight:700;">Return (Auto)</small>
                        <div id="return-date-box" style="padding:12px; font-weight:700; color:var(--success);">Select Start Date</div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="section-title" style="margin-top:50px;">Detailed 5-Day Itinerary</h2>
        <div class="timeline" id="itinerary">
            </div>
    </div>

    <div class="sidebar">
        <div style="text-align:center; margin-bottom:20px;">
            <span style="background:#f0fdf4; color:#166534; padding:5px 15px; border-radius:20px; font-size:0.75rem; font-weight:700;">4.9/5 User Rating</span>
        </div>
        <p style="margin:0; font-size:0.9rem; color:#64748b;">All-inclusive price for 4N/5D</p>
        <div class="price-tag" id="display-price">₹8,999</div>
        
        <div style="background:#f8fafc; padding:20px; border-radius:16px; margin-top:20px;">
            <ul style="list-style:none; padding:0; margin:0; font-size:0.85rem;">
                <li style="display:flex; justify-content:space-between; margin-bottom:10px;">
                    <span>Service Level:</span><strong id="side-theme">Standard</strong>
                </li>
                <li style="display:flex; justify-content:space-between; margin-bottom:10px;">
                    <span>Transport:</span><strong id="side-trans">Private Sedan</strong>
                </li>
                <li style="display:flex; justify-content:space-between;">
                    <span>Trip Length:</span><strong>5 Days / 4 Nights</strong>
                </li>
            </ul>
        </div>

        <button class="btn-book" onclick="validateAndProceed()">Confirm Selection <i class="fa fa-arrow-right"></i></button>
        <p style="text-align:center; font-size:0.7rem; color:#94a3b8; margin-top:20px;"><i class="fa fa-undo"></i> 100% Refundable till 72 hours before trip</p>
    </div>
</div>

<script>

    
    // let currentPkgType = 'standard';
    // let selectedDate = 'custom';

    const data = {
        standard: {
            title: "Standard Spiritual", price: 8999,
            imgs: ["https://images.unsplash.com/photo-1590050835495-21789700388e?w=800", "https://images.unsplash.com/photo-1621319330441-10c018991789?w=400", "https://images.unsplash.com/photo-1589330273594-fade1ee91647?w=400"],
            inc: [{i:'fa-hotel', t:'3-Star Stay', d:'Clean AC Rooms near Sangam'}, {i:'fa-utensils', t:'Veg Meals', d:'Breakfast & Dinner included'}, {i:'fa-ship', t:'Shared Boat', d:'Group Sangam Visit'}, {i:'fa-mosque', t:'Guided Walk', d:'Local temples exploration'}],
            itin: ["Welcome & Evening Sangam Aarti", "Holy Bath & Kumbh Area History", "Shakti Peeth Darshan & Museum", "Visit to Bhardwaj Ashram", "Local Market & Departure"]
        },
        family: {
            title: "Family Celebration", price: 11499,
            imgs: ["https://images.unsplash.com/photo-1564507592333-c60657eaa0ae?w=800", "https://images.unsplash.com/photo-1570160897040-30430ef22112?w=400", "https://images.unsplash.com/photo-1524492412937-b28074a5d7da?w=400"],
            inc: [{i:'fa-users', t:'Family Suite', d:'Large interconnected rooms'}, {i:'fa-car', t:'Private SUV', d:'Door-to-door pickup'}, {i:'fa-child', t:'Fun Pack', d:'Museum & Park entries'}, {i:'fa-camera', t:'Photo Guide', d:'Capture family moments'}],
            itin: ["Family Arrival & Resort Lunch", "Private Boat Cruise & Pooja", "Anand Bhavan & Planetarium", "Khusro Bagh & Local Shopping", "Last Aarti & Sweet Pack Distribution"]
        },
        heritage: {
            title: "Heritage & Culture", price: 10500,
            imgs: ["https://images.unsplash.com/photo-1610016302534-6f67f1c968d8?w=800", "https://images.unsplash.com/photo-1598977123418-45d045ca6b77?w=400", "https://images.unsplash.com/photo-1621319330441-10c018991789?w=400"],
            inc: [{i:'fa-university', t:'Curated Entry', d:'No lines at monuments'}, {i:'fa-walking', t:'History Guide', d:'Certified Cultural Experts'}, {i:'fa-coffee', t:'Legacy Snacks', d:'Netram Kachori Experience'}, {i:'fa-book', t:'Souvenir Pack', d:'Local artifacts gift'}],
            itin: ["Colonial Era Walk (Alfred Park)", "High Court & University Tour", "Fort & Akshayavat Exploration", "Museums & Art Galleries", "Heritage Souvenir Shopping"]
        },
        luxury: {
            title: "Royal Luxury Stay", price: 19999,
            imgs: ["https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800", "https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400", "https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=400"],
            inc: [{i:'fa-crown', t:'5-Star Resort', d:'Riverfront Premium Stay'}, {i:'fa-car-side', t:'BMW/Audi', d:'Luxury Chauffeur Service'}, {i:'fa-gem', t:'VIP Darshan', d:'Escorted Temple Pooja'}, {i:'fa-wine-glass', t:'Fine Dining', d:'All meals at top restaurants'}],
            itin: ["VIP Pickup & Royal Welcome", "Private Sunset Boat Dinner", "Luxury Sightseeing & VIP Darshan", "Resort Relaxation & Spa Session", "Gourmet Farewell Brunch"]
        }
    };

    let currentMode = 'custom';
    let currentTheme = 'standard';

    function updatePkg(theme, btn) {
        currentTheme = theme;
        const p = data[theme];
        
        document.querySelectorAll('.theme-card').forEach(c => c.classList.remove('active'));
        btn.classList.add('active');

        // Gallery
        document.getElementById('gallery').innerHTML = `
            <img src="${p.imgs[0]}" class="img-main">
            <img src="${p.imgs[1]}">
            <img src="${p.imgs[2]}">`;

        // Inclusions
        document.getElementById('inclusions').innerHTML = p.inc.map(x => `
            <div class="inc-item">
                <i class="fa ${x.i}"></i>
                <div><strong>${x.t}</strong><span>${x.d}</span></div>
            </div>`).join('');

        // Itinerary
        document.getElementById('itinerary').innerHTML = p.itin.map((x, i) => `
            <div class="day-block">
                <span class="day-tag">Day 0${i+1}</span>
                <h4 style="margin:5px 0 0;">${x}</h4>
            </div>`).join('');

        document.getElementById('side-theme').innerText = p.title;
        renderPrice();
    }

    function toggleDateMode(mode, el) {
        currentMode = mode;
        document.querySelectorAll('.date-option').forEach(o => o.classList.remove('active'));
        el.classList.add('active');
        el.querySelector('input').checked = true;

        document.getElementById('custom-date-picker').style.display = (mode === 'custom') ? 'block' : 'none';
        
        // Transport UI update
        const isCustom = mode === 'custom';
        document.getElementById('trans-icon').innerHTML = isCustom ? '<i class="fa fa-car"></i>' : '<i class="fa fa-bus"></i>';
        document.getElementById('trans-title').innerText = isCustom ? 'Transport: Private Luxury Sedan' : 'Transport: Group Tourist AC Coach';
        document.getElementById('trans-desc').innerText = isCustom ? 'Dedicated AC car for your group with 24/7 availability.' : 'Group departure with scheduled timing for all sites.';
        document.getElementById('side-trans').innerText = isCustom ? 'Private Sedan' : 'Group Coach';

        renderPrice();
    }

    function syncReturnDate() {
        const startInput = document.getElementById('start-date');
        const box = document.getElementById('return-date-box');
        if(startInput.value) {
            const d = new Date(startInput.value);
            d.setDate(d.getDate() + 4); // 5 days total
            box.innerText = d.toLocaleDateString('en-IN', {day:'numeric', month:'short', year:'numeric'});
            document.getElementById('date-section').classList.remove('shake');
        }
    }

    function renderPrice() {
        const base = data[currentTheme].price;
        const extra = (currentMode === 'custom') ? 3500 : 0; // Extra for 5 days private car
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

        const chosenDate = (currentMode === 'fixed') ? '2026-05-10' : dateInput;
        window.location.href = `booking.php?id=<?php echo $main_id; ?>&date=${chosenDate}&price=${finalPrice}&theme=${currentTheme}&days=5`;
    }

    window.onload = () => updatePkg('standard', document.querySelector('.theme-card'));
</script>
</body>
</html>