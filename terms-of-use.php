<?php
// 1. Timezone set karein (Zaroori step)
    date_default_timezone_set("Asia/Kolkata");
    $site_name = "Travelway";
    // Logic: Har din ki current date show karega
    $current_date = date("F d, Y"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Use | <?php echo $site_name; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f0f4f8; }
        .glass-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .step-number {
            background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
        }
    </style>
</head>
<body class="antialiased text-slate-800">

    <div class="bg-indigo-950 py-20 px-6 text-center text-white">
        <h1 class="text-5xl font-extrabold tracking-tight mb-4">Terms of <span class="text-cyan-400">Service</span></h1>
        <p class="text-indigo-200 max-w-2xl mx-auto">Rules and regulations for a seamless travel experience with Travelway.</p>
    </div>

    <main class="max-w-5xl mx-auto px-6 -mt-16 pb-24">
        <div class="glass-container rounded-[2rem] shadow-2xl overflow-hidden bg-white">
            
            <div class="bg-slate-100 px-10 py-4 flex justify-between items-center text-sm border-b">
                <span class="font-bold text-indigo-900 uppercase tracking-widest">User Agreement</span>
                <span class="text-slate-500">Effective as of: <b class="text-indigo-600"><?php echo $current_date; ?></b></span>
            </div>

            <div class="p-8 md:p-16">
                
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
                    
                    <div class="md:col-span-4 space-y-4 hidden md:block">
                        <div class="sticky top-24">
                            <h4 class="font-bold text-slate-400 text-xs uppercase mb-6 tracking-widest">Quick Navigation</h4>
                            <nav class="flex flex-col space-y-3 border-l-2 border-slate-100 pl-6">
                                <a href="#rule1" class="hover:text-indigo-600 transition font-medium">Agreement Scope</a>
                                <a href="#rule2" class="hover:text-indigo-600 transition font-medium">Account Security</a>
                                <a href="#rule3" class="hover:text-indigo-600 transition font-medium">Payment & Billing</a>
                                <a href="#rule4" class="hover:text-indigo-600 transition font-medium">Refund Policy</a>
                                <a href="#rule5" class="hover:text-indigo-600 transition font-medium">Prohibited Conduct</a>
                            </nav>
                        </div>
                    </div>

                    <div class="md:col-span-8 space-y-12">
                        
                        <section id="rule1">
                            <div class="flex items-start space-x-4">
                                <span class="step-number text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold flex-shrink-0 shadow-lg">1</span>
                                <div>
                                    <h3 class="text-xl font-extrabold text-slate-900 mb-3">Acceptance of Agreement</h3>
                                    <p class="text-slate-600 leading-relaxed">By accessing the Travelway portal, you acknowledge that you have read, understood, and agreed to be legally bound by these terms. If you disagree with any part of these protocols, you must terminate your use of our services immediately.</p>
                                </div>
                            </div>
                        </section>

                        <section id="rule2">
                            <div class="flex items-start space-x-4">
                                <span class="step-number text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold flex-shrink-0 shadow-lg">2</span>
                                <div>
                                    <h3 class="text-xl font-extrabold text-slate-900 mb-3">User Accountability</h3>
                                    <p class="text-slate-600 leading-relaxed">Users are responsible for maintaining the confidentiality of their login credentials. Any activity performed via your account is your sole legal responsibility. You must provide authentic information for travel bookings to avoid legal complications during transit.</p>
                                </div>
                            </div>
                        </section>

                        <section id="rule3">
                            <div class="flex items-start space-x-4">
                                <span class="step-number text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold flex-shrink-0 shadow-lg">3</span>
                                <div>
                                    <h3 class="text-xl font-extrabold text-slate-900 mb-3">Service Bookings & Payments</h3>
                                    <p class="text-slate-600 leading-relaxed">All tour package rates are subject to dynamic pricing based on availability. Full payment is required to confirm a reservation. Travelway reserves the right to cancel bookings in case of payment failure or fraudulent transaction detection.</p>
                                </div>
                            </div>
                        </section>

                        <section id="rule4">
                            <div class="flex items-start space-x-4">
                                <span class="step-number text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold flex-shrink-0 shadow-lg">4</span>
                                <div>
                                    <h3 class="text-xl font-extrabold text-slate-900 mb-3">Cancellation & Refund Logic</h3>
                                    <p class="text-slate-600 leading-relaxed">Refund eligibility is governed by the specific terms of the travel vendor (Hotels/Airlines). Generally, cancellations made within 48 hours of booking are eligible for a partial refund, minus administrative processing fees. No-shows are strictly non-refundable.</p>
                                </div>
                            </div>
                        </section>

                        <section id="rule5">
                            <div class="flex items-start space-x-4">
                                <span class="step-number text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold flex-shrink-0 shadow-lg">5</span>
                                <div>
                                    <h3 class="text-xl font-extrabold text-slate-900 mb-3">Prohibited Usage</h3>
                                    <p class="text-slate-600 leading-relaxed">You are prohibited from: 
                                        <ul class="list-disc ml-5 mt-2 space-y-1 text-slate-500 italic">
                                            <li>Using automated scripts to scrape travel data.</li>
                                            <li>Attempting to bypass our secure payment gateways.</li>
                                            <li>Impersonating Travelway staff or other travelers.</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>

                <div class="mt-20 p-8 rounded-3xl bg-indigo-50 border border-indigo-100 flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-6 md:mb-0">
                        <h5 class="text-indigo-900 font-bold text-lg">HAVE QUESTIONS ABOUT THESE TERMS?</h5>
                        <p class="text-indigo-700 text-sm">Our legal team is here to clarify any doubts you may have.</p>
                    </div>
                    <a href="contact-us.php" class="bg-indigo-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-indigo-700 transition shadow-xl">
                        Contact Legal Dept
                    </a>
                </div>

            </div>
        </div>
        
        <p class="text-center mt-10 text-slate-400 text-sm italic">
            &copy; 2026 Travelway - Redefining Journeys through Transparency.
        </p>
    </main>

</body>
</html>