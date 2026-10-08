<?php
session_start();
include 'db_connect.php';

// 1. Check login
if(!isset($_SESSION['user_id'])) {
    header("Location: signup.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$package_id = 1; // Default
$cityName = "Shimla"; // Default
$dbPrice = 12999; // Default
$selected_theme = isset($_GET['theme']) ? $_GET['theme'] : 'standard';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Agar packages.php se ID aayi ho
    $package_id = mysqli_real_escape_string($conn, $_GET['id']);
    $get_package = mysqli_query($conn, "SELECT * FROM packages WHERE id = '$package_id'");
} 
elseif(isset($_GET['package']) && !empty($_GET['package'])) {
    // Agar details page se Name aaya ho (e.g. ?package=Manali)
    $name = mysqli_real_escape_string($conn, $_GET['package']);
    $get_package = mysqli_query($conn, "SELECT * FROM packages WHERE title LIKE '%$name%'");
}

if(isset($get_package) && mysqli_num_rows($get_package) > 0) {
    $package_data = mysqli_fetch_assoc($get_package);
    $package_id = $package_data['id'];
    $cityName = $package_data['title'];
    $dbPrice = $package_data['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Booking | TravelWay</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-light: #64748b;
            --border: #e2e8f0;
            --success: #22c55e;
            --warning: #f59e0b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            line-height: 1.6;
            overflow-x: hidden;
        }

        header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            padding: 15px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-area { display: flex; align-items: center; gap: 20px; }
        .back-btn { text-decoration: none; color: #64748b; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; transition: 0.3s; }
        .back-btn:hover { color: var(--primary); transform: translateX(-5px); }

        .main-wrapper {
            max-width: 1250px;
            margin: 40px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1.8fr 1.2fr;
            gap: 30px;
        }

        .weather-banner {
            background: linear-gradient(135deg, #1e40af, #2563eb);
            border-radius: 20px;
            padding: 35px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.15);
        }

        .weather-info h1 { font-size: 3.5rem; font-weight: 800; margin: 10px 0; }
        .start-date-tag {
            margin-top: 15px;
            background: rgba(255,255,255,0.2);
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-block;
            border: 1px solid rgba(255,255,255,0.3);
        }

        .card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            margin-bottom: 20px;
        }

        .section-title { font-size: 1.25rem; font-weight: 800; margin-bottom: 25px; display: flex; align-items: center; gap: 10px; color: #1e293b; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full-width { grid-column: span 2; }
        label { display: block; font-size: 0.85rem; font-weight: 700; color: var(--text-light); margin-bottom: 8px; }
        
        input, select {
            width: 100%; padding: 14px 18px; border: 1px solid var(--border); border-radius: 12px; font-size: 0.95rem; background: #fcfdfe; outline: none; transition: 0.2s;
        }
        input:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); }

        .summary-row { display: flex; justify-content: space-between; margin-bottom: 12px; font-weight: 500; color: #475569; }
        .grand-total { font-size: 1.8rem; font-weight: 800; color: var(--primary); display: flex; justify-content: space-between; margin-top: 20px; border-top: 2px dashed var(--border); padding-top: 20px; }

        .payment-methods { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 15px; }
        .pay-option {
            border: 2px solid var(--border); border-radius: 12px; padding: 15px; cursor: pointer; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 10px; background: #fff;
        }
        .pay-option.active { border-color: var(--primary); background: #eff6ff; }
        .pay-option i { font-size: 1.2rem; color: #64748b; }
        .pay-option.active i, .pay-option.active span { color: var(--primary); }
        .pay-option span { font-weight: 700; font-size: 0.85rem; color: var(--text-light); }

        .btn-pay {
            width: 100%; background: var(--primary); color: white; border: none; padding: 18px; border-radius: 15px; font-size: 1.1rem; font-weight: 800; margin-top: 25px; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
        }
        .btn-pay:hover { background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3); }

        .booking-steps { display: flex; justify-content: center; align-items: center; gap: 30px; margin: 30px 0; }
        .step { display: flex; align-items: center; gap: 8px; font-size: 0.9rem; font-weight: 700; color: #94a3b8; }
        .step.completed { color: var(--success); } 
        .step.active { color: var(--primary); border-bottom: 2px solid var(--primary); padding-bottom: 4px; }
        
        /* Step complete style */
        .step.fully-done { 
            color: #22c55e !important; 
            border-bottom: 2px solid #22c55e !important; 
        }
        .step.fully-done .step-num { 
            background: #22c55e !important; 
            color: white !important; 
        }
        .step-num { width: 24px; height: 24px; background: #e2e8f0; color: #64748b; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 0.75rem; }
        .step.active .step-num { background: var(--primary); color: white; }

        .trust-badge { display: flex; align-items: center; gap: 10px; margin-top: 20px; padding: 15px; background: #f0fdf4; border-radius: 12px; border: 1px solid #dcfce7; }
        .trust-badge i { color: var(--success); }
        .trust-badge span { font-size: 0.75rem; font-weight: 600; color: #166534; }

        .pay-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.9); z-index: 2000; justify-content: center; align-items: center; backdrop-filter: blur(8px); }
        .pay-modal { background: white; padding: 35px; border-radius: 24px; width: 90%; max-width: 400px; text-align: center; }
        .loader-icon { font-size: 50px; color: var(--primary); margin-bottom: 20px; }

        @media (max-width: 900px) { .main-wrapper { grid-template-columns: 1fr; } }
        @media (max-width: 600px) { .form-grid { grid-template-columns: 1fr; } .full-width { grid-column: span 1; } }

        .main-wrapper {
    max-width: 1250px;
    margin: 40px auto;
    padding: 0 20px;
    display: grid;
    grid-template-columns: 1.8fr 1.2fr;
    gap: 30px;
}

/* Tablet */
@media (max-width: 992px) {
    .main-wrapper {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}
@media (max-width: 768px) {
    .weather-banner {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
        padding: 20px;
    }

    .weather-info h1 {
        font-size: 2.2rem;
    }

    #weather-icon {
        font-size: 2.5rem !important;
        align-self: flex-end;
    }
}
@media (max-width: 600px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .full-width {
        grid-column: span 1;
    }

    input, select {
        padding: 12px;
        font-size: 0.9rem;
    }
}
@media (max-width: 768px) {
    .payment-methods {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 480px) {
    .payment-methods {
        grid-template-columns: 1fr;
    }

    .pay-option {
        justify-content: flex-start;
        padding: 12px;
    }
}
@media (max-width: 992px) {
    .right-section .card {
        position: static !important;
    }
}
@media (max-width: 600px) {
    .btn-pay {
        padding: 15px;
        font-size: 1rem;
    }
}
@media (max-width: 600px) {
    header {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        padding: 12px 5%;
    }
}
html {
    scroll-behavior: smooth;
}
    </style>
</head>
<body>

    <header>
        <div class="logo-area">
            <a href="javascript:history.back()" class="back-btn"><i class="fa fa-chevron-left"></i> Back </a>
        </div>
        <div style="font-size: 0.8rem; font-weight: 800; color: var(--primary);">
            <i class="fa fa-shield-halved"></i> SECURE PAYMENT GATEWAY
        </div>
    </header>

    <div class="booking-steps">
        <div class="step completed"><i class="fa fa-check-circle"></i> <span>Selection</span></div>
        <div class="step active" id="step2-main"><span class="step-num">2</span> <span id="step2-text">Guest Details & Payment</span></div>
        <div class="step" id="step3-confirm"><span class="step-num">3</span> <span>Confirmation</span></div>
    </div> 

    <div id="payment-modal" class="pay-overlay">
        <div class="pay-modal">
            <div class="loader-icon"><i class="fas fa-spinner fa-spin"></i></div>
            <h2 id="modal-status">Processing Payment...</h2>
            <p id="modal-msg" style="color:var(--text-light); margin-top:10px;">Securely connecting to your bank. Please do not refresh.</p>
        </div>
    </div>

    <form action="booking_process.php" method="post" id="bookingForm" onsubmit="handlePayment(event)">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="package_id" value="<?php echo $package_id; ?>">
        <input type="hidden" name="status" value="Confirmed">
        <input type="hidden" name="theme" value="<?php echo isset($_GET['theme']) ? $_GET['theme'] : 'standard'; ?>">
        <div class="main-wrapper">
            <div class="left-section">
                <div class="weather-banner">
                    <div class="weather-info">
                        <p style="font-weight: 700; opacity: 0.8; letter-spacing: 1px;">CURRENT CONDITION AT <?php echo strtoupper($cityName); ?></p>
                        <h1 id="live-temp">--°C</h1>
                        <p id="live-desc" style="font-weight: 600; text-transform: uppercase;">Syncing with Satellite...</p> 
                        <div class="start-date-tag">
                            <i class="fa fa-calendar-check"></i> DEPARTURE: <span id="tagDate">NOT SELECTED</span>
                        </div>
                    </div>
                    <i id="weather-icon" class="fa-solid fa-cloud-sun-rain fa-4x" style="opacity: 0.6;"></i>
                </div>

                <div class="card">
                    <h2 class="section-title"><i class="fa-solid fa-id-card" style="color: var(--primary);"></i> Traveler Details</h2>
                    <div class="form-grid">
                        <div class="full-width">
                            <label>Full Name (Official ID)</label>
                            <input type="text" name="name" id="name" placeholder="John Doe" oninput="checkFormCompletion()" required>
                        </div>
                        <!-- <div>
                            <label>Email ID</label>
                            <input type="email" name="email" id="email" placeholder="john@example.com" oninput="checkFormCompletion()" required>
                        </div> -->
                        <div>
                            <label>Phone Number</label>
                            <input type="tel" name="phone" id="phone" placeholder="+91 98765 43210" oninput="checkFormCompletion()" required>
                        </div>
                        <div>
                            <label id="arrival-label">Arrival Date</label>
                            <input type="date" name="arrival" id="arrival" onchange="syncDates(this.value); checkFormCompletion();" required>
                            <small id="date-hint" style="display: block; margin-top: 5px; font-weight: 600;"></small>
                        </div>
                        <div>
                            <label>Return Date (Auto-calc)</label>
                            <input type="date" name="leaving" id="return" readonly style="background: #f1f5f9; color: #64748b;">
                        </div>
                        <div class="full-width">
                            <label>Total Travelers</label>
                            <select name="guest" id="guests" onchange="updatePrice()">
                                <?php for($i=1; $i<=20; $i++) { 
                                    $sel = ($i == 1) ? "selected" : "";
                                    echo "<option value='$i' $sel>$i Person".($i>1?'s':'')."</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right-section">
                <div class="card" style="position: sticky; top: 100px;">
                    <h2 class="section-title">Fare Summary</h2>
                    <div class="summary-row">
                        <span>Base Fare (<span id="guestCount">1</span> Guest)</span>
                        <span id="base">₹0</span>
                    </div>
                    <div class="summary-row">
                        <span>GST (5%)</span>
                        <span id="gst">₹0</span>
                    </div>
                    <div class="summary-row" style="color: var(--success); font-weight: 700;">
                        <span>Member Discount</span>
                        <span>-₹500</span>
                    </div>
                    
                    <div class="grand-total">
                        <span>Payable</span>
                        <span id="total">₹0</span>
                    </div>

                    <div style="margin-top: 30px;">
                        <label style="text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px;">Choose Payment Method</label>
                        <div class="payment-methods">
                            <div class="pay-option active" onclick="selectPay(this, 'UPI')">
                                <i class="fa-brands fa-google-pay"></i>
                                <span>UPI</span>
                            </div>
                            <div class="pay-option" onclick="selectPay(this, 'Card')">
                                <i class="fa-solid fa-credit-card"></i>
                                <span>Card</span>
                            </div>
                            <div class="pay-option" onclick="selectPay(this, 'Net Banking')">
                                <i class="fa-solid fa-building-columns"></i>
                                <span>Bank</span>
                            </div>
                            <div class="pay-option" onclick="selectPay(this, 'Wallet')">
                                <i class="fa-solid fa-wallet"></i>
                                <span>Wallet</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" name="send" class="btn-pay" id="payBtn">Proceed to Pay ₹0</button>

                    <div class="trust-badge">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Verified Merchant • Secure SSL 256-bit Encryption</span>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        window.pricePerPerson = <?php echo $dbPrice; ?>;
        let selectedPaymentMethod = "UPI";

        window.onload = function() {
            const arrivalInput = document.getElementById('arrival');
            const dateHint = document.getElementById('date-hint');
            const arrivalLabel = document.getElementById('arrival-label');

            const today = new Date().toISOString().split('T')[0];
            arrivalInput.setAttribute('min', today);

            const params = new URLSearchParams(window.location.search);
            if(params.get('price')) window.pricePerPerson = parseInt(params.get('price'));
            
            const urlDate = params.get('date');

            if(urlDate && urlDate !== 'custom') {
                arrivalInput.value = urlDate;
                arrivalInput.readOnly = true; 
                arrivalInput.style.backgroundColor = "#f1f5f9"; 
                arrivalInput.style.cursor = "not-allowed";
                arrivalLabel.innerHTML = 'Arrival Date <i class="fa fa-lock" style="font-size:0.7rem; color:var(--success)"></i>';
                dateHint.innerText = "Fixed Date Selected for this Batch";
                dateHint.style.color = "var(--success)";
                syncDates(urlDate);
            } else {
                arrivalLabel.innerHTML = 'Arrival Date <i class="fa fa-calendar-alt" style="font-size:0.7rem; color:var(--warning)"></i>';
                dateHint.innerText = "Please choose your arrival date";
                dateHint.style.color = "var(--warning)";
            }

            updatePrice();
            getLiveWeather();
            checkFormCompletion(); // Initial check
        };

        // NEW FUNCTION: Turns Step 2 Green when form is filled
        function checkFormCompletion() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const arrival = document.getElementById('arrival').value;
            const step2 = document.getElementById('step2-main');

            if(name !== "" && email !== "" && phone !== "" && arrival !== "") {
                step2.classList.remove('active');
                step2.classList.add('fully-done');
                step2.innerHTML = '<i class="fa fa-check-circle"></i> <span>Guest Details & Payment</span>';
            } else {
                step2.classList.remove('fully-done');
                step2.classList.add('active');
                step2.innerHTML = '<span class="step-num">2</span> <span>Guest Details & Payment</span>';
            }
        }

        function updatePrice() {
            const count = document.getElementById('guests').value;
            const base = window.pricePerPerson * count;
            const gst = base * 0.05;
            const total = (base + gst) - 500;

            document.getElementById('guestCount').innerText = count;
            document.getElementById('base').innerText = "₹" + base.toLocaleString('en-IN');
            document.getElementById('gst').innerText = "₹" + gst.toLocaleString('en-IN', {minimumFractionDigits: 2});
            
            const totalFormatted = "₹" + total.toLocaleString('en-IN', {minimumFractionDigits: 0});
            document.getElementById('total').innerText = totalFormatted;
            document.getElementById('payBtn').innerText = "Proceed to Pay " + totalFormatted;
        }

        function syncDates(val) {
            if(!val) return;
            let d = new Date(val);
            document.getElementById('tagDate').innerText = d.toLocaleDateString('en-GB', {day:'2-digit', month:'short', year:'numeric'}).toUpperCase();
            
            let ret = new Date(val);
            ret.setDate(ret.getDate() + 4);
            document.getElementById('return').value = ret.toISOString().split('T')[0];
        }

        function selectPay(el, method) {
            selectedPaymentMethod = method;
            document.querySelectorAll('.pay-option').forEach(p => p.classList.remove('active'));
            el.classList.add('active');
        }

        function handlePayment(e) {
            e.preventDefault(); 
            
            const modal = document.getElementById('payment-modal');
            const statusTxt = document.getElementById('modal-status');
            const msgTxt = document.getElementById('modal-msg');
            const loader = document.querySelector('.loader-icon');

            modal.style.display = 'flex';

            setTimeout(() => {
                statusTxt.innerText = "Verifying with " + selectedPaymentMethod + "...";
                
                setTimeout(() => {
                    loader.innerHTML = '<i class="fa fa-check-circle" style="color:var(--success); font-size:60px;"></i>';
                    statusTxt.innerText = "Payment Successful!";
                    
                    const s3 = document.getElementById('step3-confirm');
                    s3.classList.add('active');
                    s3.style.color = "var(--primary)";
                    statusTxt.style.color = "var(--success)";
                    msgTxt.innerText = "Redirecting to Home Page...";

                    setTimeout(() => {
                        document.getElementById('bookingForm').submit();
                    }, 2000);

                }, 2500);
            }, 1500);
        }

        async function getLiveWeather() {
            let cityName = "<?php echo $cityName; ?>";
            let queryCity = cityName.split(' ')[0].split('-')[0].trim();
            const weatherApiKey = ""; 
            const apiURL = `https://api.openweathermap.org/data/2.5/weather?q=${encodeURIComponent(queryCity)},IN&units=metric&appid=${weatherApiKey}`;
            
            try {
                const response = await fetch(apiURL);
                const data = await response.json();
                if (data.cod === 200) {
                    document.getElementById("live-temp").innerText = Math.round(data.main.temp) + "°C";
                    document.getElementById("live-desc").innerText = data.weather[0].description.toUpperCase();
                } else {
                    document.getElementById("live-temp").innerText = "N/A";
                    document.getElementById("live-desc").innerText = "DATA NOT AVAILABLE";
                }
            } catch (error) {
                console.log("Network Error");
            }
        }
    </script>
</body>
</html>