<?php
    // Timezone setting taaki date hamesha current rhe (IST)
    date_default_timezone_set("Asia/Kolkata");
    $site_name = "Travelway";
    $current_date = date("F d, Y"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund Policy | <?php echo $site_name; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .premium-gradient { background: linear-gradient(135deg, #0f172a 0%, #1e40af 100%); }
        .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .policy-section { border-left: 4px solid #3b82f6; padding-left: 1.5rem; margin-bottom: 2.5rem; }
    </style>
</head>
<body class="antialiased">

    <nav class="py-5 px-10 flex justify-between items-center bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100">
        <div class="text-2xl font-extrabold tracking-tighter text-blue-700 italic uppercase">
            TRAVELWAY<span class="text-slate-400">.</span>
        </div>
        <a href="travel.php" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition uppercase tracking-widest">Back to Home</a>
    </nav>

    <header class="premium-gradient pt-20 pb-40 px-6 text-center text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500 opacity-10 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <span class="bg-blue-500/20 text-blue-300 px-4 py-1 rounded-full text-xs font-bold tracking-widest uppercase mb-4 inline-block border border-blue-500/30">Financial Transparency</span>
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4 tracking-tight">Refund & <span class="text-blue-400">Cancellations</span></h1>
            <p class="text-slate-400 max-w-2xl mx-auto font-light">Detailed framework regarding booking reversals, service credits, and financial reconciliation.</p>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 -mt-24 pb-24 relative z-20">
        <div class="glass-card rounded-[2.5rem] shadow-2xl p-10 md:p-16">
            
            <div class="flex items-center space-x-4 mb-12 pb-6 border-b border-slate-100">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-file-invoice-dollar text-xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Last Updated On</p>
                    <p class="text-sm font-extrabold text-slate-800"><?php echo $current_date; ?></p>
                </div>
            </div>

            <div class="space-y-10">
                
                <section class="policy-section">
                    <h2 class="text-2xl font-extrabold text-slate-800 mb-4">1. Cancellation Windows</h2>
                    <p class="text-slate-600 leading-relaxed mb-4">
                        Refund eligibility is determined by the time remaining between the cancellation request and the scheduled departure. Travelway follows a tiered deduction structure:
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                            <span class="text-blue-600 font-bold block mb-1">Standard</span>
                            <p class="text-xs text-slate-400 uppercase font-bold mb-2">72+ Hours</p>
                            <p class="text-xl font-black text-slate-800">90% Refund</p>
                        </div>
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                            <span class="text-amber-600 font-bold block mb-1">Partial</span>
                            <p class="text-xs text-slate-400 uppercase font-bold mb-2">24 - 72 Hours</p>
                            <p class="text-xl font-black text-slate-800">50% Refund</p>
                        </div>
                        <div class="bg-rose-50 p-5 rounded-2xl border border-rose-100">
                            <span class="text-rose-600 font-bold block mb-1">Critical</span>
                            <p class="text-xs text-slate-400 uppercase font-bold mb-2">< 24 Hours</p>
                            <p class="text-xl font-black text-slate-800">No Refund</p>
                        </div>
                    </div>
                </section>

                <section class="policy-section">
                    <h2 class="text-2xl font-extrabold text-slate-800 mb-4">2. Processing Timeline</h2>
                    <p class="text-slate-600 leading-relaxed">
                        Once a refund is initiated via the <strong>Support Concierge</strong> or your <strong>User Dashboard</strong>, our reconciliation engine validates the request with the respective hotel or airline partner. 
                        The approved amount will be credited to the original payment source within <span class="text-blue-600 font-bold">7 to 10 business days</span>.
                    </p>
                </section>

                <section class="policy-section">
                    <h2 class="text-2xl font-extrabold text-slate-800 mb-4">3. Non-Refundable Components</h2>
                    <p class="text-slate-600 leading-relaxed">
                        Certain charges are non-refundable regardless of the cancellation timing:
                    </p>
                    <ul class="list-none space-y-3 mt-4">
                        <li class="flex items-center text-slate-600"><i class="fas fa-times-circle text-rose-500 mr-3"></i> Convenience fees and service taxes.</li>
                        <li class="flex items-center text-slate-600"><i class="fas fa-times-circle text-rose-500 mr-3"></i> Promotional discounts or voucher values.</li>
                        <li class="flex items-center text-slate-600"><i class="fas fa-times-circle text-rose-500 mr-3"></i> Third-party insurance premiums.</li>
                    </ul>
                </section>

                <section class="policy-section">
                    <h2 class="text-2xl font-extrabold text-slate-800 mb-4">4. Force Majeure</h2>
                    <p class="text-slate-600 leading-relaxed italic">
                        In cases of natural disasters, government restrictions, or pandemics, refund policies may be overridden by airline-specific "Travel Credits" which can be used for future bookings within 12 months.
                    </p>
                </section>

            </div>

            <div class="mt-16 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
                <p class="text-slate-400 text-sm text-center md:text-left">Need assistance with a specific booking ID? Our finance team is here to help.</p>
                <div class="flex space-x-3">
                    <button onclick="window.print()" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-xl font-bold hover:bg-slate-200 transition">
                        <i class="fas fa-print mr-2"></i> Print
                    </button>
                    <a href="contact-us.php" class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition">
                        Raise Ticket
                    </a>
                </div>
            </div>

        </div>

        <footer class="mt-10 text-center text-slate-400 text-xs">
            &copy; 2026 Travelway Travel Solutions. All transactions are AES-256 Encrypted.
        </footer>
    </main>

</body>
</html>