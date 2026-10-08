<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Batches | TravelWay</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --primary: #3b82f6; --dark: #020617; --card: rgba(255,255,255,0.05); }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--dark); color: white; margin: 0; padding: 40px 8%; }
        
        .filters { display: flex; gap: 15px; margin-bottom: 30px; overflow-x: auto; padding-bottom: 10px; }
        .filter-btn { background: var(--card); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 10px 20px; border-radius: 30px; cursor: pointer; white-space: nowrap; }
        .filter-btn.active { background: var(--primary); border-color: var(--primary); }

        .batch-card { 
            background: var(--card); border: 1px solid rgba(255,255,255,0.1); 
            border-radius: 16px; padding: 20px; display: grid; 
            grid-template-columns: 1fr 2fr 1fr 1.2fr; align-items: center; 
            margin-bottom: 15px; backdrop-filter: blur(10px);
            transition: 0.3s;
        }
        .batch-card:hover { transform: translateY(-5px); border-color: var(--primary); }

        .date-box { text-align: center; border-right: 1px solid rgba(255,255,255,0.1); }
        .date-box h2 { margin: 0; color: var(--primary); }
        
        .trip-details { padding-left: 25px; }
        .tag { font-size: 10px; padding: 3px 8px; border-radius: 4px; background: #1e293b; color: #94a3b8; margin-right: 5px; }
        
        .btn-secure { 
            background: var(--primary); color: white; text-decoration: none; 
            padding: 12px; border-radius: 10px; text-align: center; font-weight: bold; font-size: 0.9rem;
        }

        /* Modal Style */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 2000; justify-content: center; align-items: center; }
        .modal-content { background: #1e293b; padding: 30px; border-radius: 20px; width: 400px; text-align: center; border: 1px solid var(--primary); }
    </style>
</head>
<body>

    <h1>📅 All Upcoming Batches</h1>
    <p style="color: #94a3b8; margin-bottom: 40px;">Choose a date that fits your schedule. All departures are confirmed.</p>

    <div class="filters">
        <button class="filter-btn active">All Destinations</button>
        <button class="filter-btn">Shimla</button>
        <button class="filter-btn">Jaipur</button>
        <button class="filter-btn">Manali</button>
    </div>

    <div class="batch-card">
        <div class="date-box">
            <span>MAR</span>
            <h2>15</h2>
        </div>
        <div class="trip-details">
            <span class="tag">FIXED DEPARTURE</span>
            <h3 style="margin: 5px 0;">Shimla: Spring Special</h3>
            <span style="color:#94a3b8; font-size: 0.8rem;"><i class="fa fa-users"></i> 12 Slots Left • Mixed Group</span>
        </div>
        <div class="price-box">
            <strong style="font-size: 1.2rem;">₹8,999</strong>
        </div>
        <a href="#" class="btn-secure" onclick="openModal('Shimla', '15 March')">Secure Spot</a>
    </div>

    <div class="batch-card">
        <div class="date-box">
            <span>MAR</span>
            <h2>25</h2>
        </div>
        <div class="trip-details">
            <span class="tag" style="background:#db2777; color:white;">ROYAL BATCH</span>
            <h3 style="margin: 5px 0;">Jaipur: Heritage Walk</h3>
            <span style="color:#94a3b8; font-size: 0.8rem;"><i class="fa fa-female"></i> 5 Slots Left • Girls Only Batch</span>
        </div>
        <div class="price-box">
            <strong style="font-size: 1.2rem;">₹5,999</strong>
        </div>
        <a href="#" class="btn-secure" onclick="openModal('Jaipur', '25 March')">Secure Spot</a>
    </div>

    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <i class="fa fa-check-circle" style="font-size: 3rem; color: #10b981;"></i>
            <h2 id="m-title">Confirm Selection</h2>
            <p id="m-desc" style="color: #94a3b8;"></p>
            <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin: 20px 0;">
            <button class="btn-secure" style="width: 100%; border: none; cursor: pointer;" onclick="location.href='booking.php'">Proceed to Details</button>
            <p style="font-size: 0.8rem; margin-top: 15px; color: #64748b; cursor: pointer;" onclick="closeModal()">Go Back</p>
        </div>
    </div>

    <script>
        function openModal(trip, date) {
            document.getElementById('bookingModal').style.display = 'flex';
            document.getElementById('m-title').innerText = trip;
            document.getElementById('m-desc').innerText = "You have selected the batch starting on " + date + ". Would you like to proceed with the booking?";
        }
        function closeModal() {
            document.getElementById('bookingModal').style.display = 'none';
        }
    </script>

</body>
</html>