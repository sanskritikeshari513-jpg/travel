<?php
    // Timezone setting for accurate date tracking
    date_default_timezone_set("Asia/Kolkata");
    $site_name = "Travelway";
    $current_date = date("F d, Y"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies Policy | <?php echo $site_name; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .glass-nav { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(0,0,0,0.05); }
        .hero-gradient { background: radial-gradient(circle at top right, #3b82f6, #1e40af); }
        .cookie-card { transition: transform 0.3s ease, border-color 0.3s ease; }
        .cookie-card:hover { transform: translateY(-5px); border-color: #3b82f6; }
    </style>
</head>
<body class="antialiased text-slate-800">

    <nav class="glass-nav py-4 px-6 md:px-12 flex justify-between items-center sticky top-0 z-50">
        <div class="text-xl font-black italic text-blue-700 tracking-tighter">
            TRAVELWAY<span class="text-slate-400">.</span>
        </div>
        <a href="travel.php" class="text-xs font-bold text-slate-500 hover:text-blue-600 uppercase tracking-widest transition">Close Policy</a>
    </nav>

    <header class="hero-gradient pt-24 pb-44 text-center text-white px-6">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6">Cookie <span class="text-blue-200">Governance</span></h1>
            <p class="text-blue-100 text-lg font-light leading-relaxed max-w-2xl mx-auto">
                Understanding how we use small data fragments to enhance your global travel booking experience.
            </p>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-6 -mt-28 pb-20">
        <div class="bg-white rounded-[3rem] shadow-xl border border-slate-100 overflow-hidden">
            
            <div class="bg-slate-50 px-8 py-4 border-b border-slate-100 flex justify-between items-center">
                <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Compliance Doc v2.0</span>
                <span class="text-sm font-semibold text-slate-600">Active as of: <?php echo $current_date; ?></span>
            </div>

            <div class="p-8 md:p-16">
                <h2 class="text-3xl font-bold mb-8 text-slate-900">How we utilize Cookies</h2>
                <p class="text-slate-600 leading-relaxed mb-12 text-lg">
                    Cookies are micro-files stored on your device that help **Travelway** remember your preferences, keep you logged in, and analyze web traffic. Below is the breakdown of the cookie types we employ.
                </p>

                <div class="grid md:grid-cols-2 gap-6 mb-16">
                    <div class="cookie-card border border-slate-100 rounded-3xl p-8 bg-slate-50/50">
                        <div class="w-12 h-12 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-200">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Strictly Necessary</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Required for core functionality such as user authentication, secure payment sessions, and load balancing. These cannot be disabled.
                        </p>
                    </div>

                    <div class="cookie-card border border-slate-100 rounded-3xl p-8 bg-slate-50/50">
                        <div class="w-12 h-12 bg-emerald-500 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-emerald-200">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Analytical Tracking</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Helps us understand how travelers interact with our search filters and destination pages. All data is anonymized.
                        </p>
                    </div>

                    <div class="cookie-card border border-slate-100 rounded-3xl p-8 bg-slate-50/50">
                        <div class="w-12 h-12 bg-amber-500 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-amber-200">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Preference Memory</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Remembers your recent searches, currency choices, and language settings for a smoother return visit.
                        </p>
                    </div>

                    <div class="cookie-card border border-slate-100 rounded-3xl p-8 bg-slate-50/50">
                        <div class="w-12 h-12 bg-rose-500 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-rose-200">
                            <i class="fas fa-ad"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Marketing & Retargeting</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Used to deliver relevant travel deals and itinerary suggestions based on your browsing history.
                        </p>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-3xl p-8 md:p-12 border border-blue-100">
                    <h2 class="text-2xl font-bold text-blue-900 mb-4">Your Data, Your Control</h2>
                    <p class="text-blue-800/70 leading-relaxed mb-6">
                        Most web browsers allow you to manage cookie settings through their preference panels. You can delete existing cookies or set your browser to reject them automatically. 
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="https://support.google.com/chrome/answer/95647" target="_blank" class="text-xs font-bold text-blue-700 bg-white px-4 py-2 rounded-lg border border-blue-200 hover:bg-blue-100 transition">Chrome Settings</a>
                        <a href="https://support.apple.com/en-in/guide/safari/sfri11471/mac" target="_blank" class="text-xs font-bold text-blue-700 bg-white px-4 py-2 rounded-lg border border-blue-200 hover:bg-blue-100 transition">Safari Settings</a>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-slate-900 text-center">
                <p class="text-slate-400 text-sm mb-6">Questions about our cookie usage? Reach out to our technical team.</p>
                <div class="flex justify-center space-x-4">
                    <a href="help-center.php" class="px-8 py-3 bg-blue-600 text-white rounded-full font-bold text-sm hover:bg-blue-700 transition shadow-lg shadow-blue-900/20">Help Center</a>
                    <button onclick="window.print()" class="px-8 py-3 bg-slate-800 text-slate-300 rounded-full font-bold text-sm hover:bg-slate-700 transition">Print PDF</button>
                </div>
            </div>
        </div>
        
        <p class="mt-10 text-center text-slate-400 text-xs tracking-widest uppercase">
            &copy; 2026 Travelway Travel Solutions Pvt. Ltd.
        </p>
    </main>

</body>
</html>