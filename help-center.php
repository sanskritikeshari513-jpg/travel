<?php
// 1. Timezone set karein (Zaroori step)
    date_default_timezone_set("Asia/Kolkata");
    // Logic: Dynamic Date and Site Identity
    $site_name = "Travelway";
    $current_date = date("F d, Y"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Hub | <?php echo $site_name; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f1f5f9; scroll-behavior: smooth; }
        
        .premium-gradient { background: linear-gradient(135deg, #0f172a 0%, #1e40af 100%); }
        .glass-card { background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.3); }

        .faq-card-item { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer; }
        .faq-card-item:hover { transform: translateY(-5px); border-color: #3b82f6; box-shadow: 0 20px 40px -15px rgba(59, 130, 246, 0.2); }

        .answer-panel { max-height: 0; overflow: hidden; transition: all 0.5s ease; opacity: 0; }
        .answer-panel.active { max-height: 1000px; opacity: 1; padding-top: 1.5rem; border-top: 1px solid #f1f5f9; margin-top: 1.5rem; }

        .rotate-icon { transition: transform 0.4s ease; }
        .step-pill { background: #eff6ff; color: #2563eb; padding: 2px 10px; border-radius: 8px; font-size: 10px; font-weight: 800; text-transform: uppercase; margin-bottom: 8px; display: inline-block; }
    </style>
</head>
<body class="antialiased">

    <header class="premium-gradient pt-24 pb-48 px-6 text-center text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-blue-400 opacity-10 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <span class="bg-blue-500/20 text-blue-300 px-5 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase mb-6 inline-block border border-blue-500/30">Official Support Portal</span>
            <h1 class="text-5xl md:text-7xl font-extrabold mb-8 tracking-tighter">Support <span class="text-blue-400">Concierge</span></h1>
            
            <div class="max-w-3xl mx-auto relative group">
                <i class="fas fa-search absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                <input type="text" id="masterSearch" onkeyup="searchHelp()" placeholder="Search FAQs or Guides (e.g., 'refund', 'cancellation')..." 
                       class="w-full py-6 pl-16 pr-8 rounded-[2rem] text-slate-900 shadow-2xl focus:ring-8 focus:ring-blue-500/10 outline-none text-lg border-none">
            </div>
            <p class="mt-8 text-slate-400 text-sm italic">Status: <span class="text-green-400 font-bold">● Secure & Online</span> • Verified: <?php echo $current_date; ?></p>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-6 -mt-32 pb-32">
        <div class="glass-card rounded-[3.5rem] shadow-2xl p-8 md:p-16">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-16 space-y-6 md:space-y-0">
                <h2 id="mainHeading" class="text-3xl font-extrabold text-slate-900 border-l-8 border-blue-600 pl-6 uppercase tracking-tight">Core Assistance</h2>
                <div class="flex bg-slate-100 p-1.5 rounded-2xl shadow-inner">
                    <button id="btnFaq" onclick="switchTab('faq')" class="bg-white text-blue-600 px-10 py-3 rounded-xl text-sm font-bold shadow-sm transition-all duration-300">FAQS</button>
                    <button id="btnGuide" onclick="switchTab('guide')" class="text-slate-500 px-10 py-3 rounded-xl text-sm font-bold hover:text-slate-700 transition-all duration-300">GUIDES</button>
                </div>
            </div>

            <div id="faqContainer" class="grid grid-cols-1 gap-6">
                <div class="faq-card-item border border-slate-100 rounded-[2rem] p-8 bg-white" onclick="toggleBox('faq1', 'icon1')">
                    <div class="w-full flex justify-between items-center">
                        <div class="flex items-center space-x-6">
                            <div class="w-14 h-14 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center font-black text-xl">01</div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-800">Cancellations & Refunds</h3>
                                <p class="text-slate-400 text-xs uppercase tracking-widest mt-1">Refund Tiers • Reversal Timeline</p>
                            </div>
                        </div>
                        <i id="icon1" class="fas fa-chevron-down text-slate-300 rotate-icon"></i>
                    </div>
                    <div id="faq1" class="answer-panel text-slate-600 leading-relaxed">
                        <p class="mb-4 text-rose-600 font-bold italic">"What is the refund policy for last-minute cancellations?"</p>
                        Our policy is divided into three tiers: 
                        <ul class="list-disc ml-5 mt-2 space-y-1">
                            <li><strong>> 72 Hours:</strong> 90% Refund of the base fare.</li>
                            <li><strong>24-72 Hours:</strong> 50% Refund.</li>
                            <li><strong>< 24 Hours:</strong> Non-refundable (excluding taxes).</li>
                        </ul>
                        Refunds are processed within 7-10 working days to the original payment method.
                    </div>
                </div>

                <div class="faq-card-item border border-slate-100 rounded-[2rem] p-8 bg-white" onclick="toggleBox('faq2', 'icon2')">
                    <div class="w-full flex justify-between items-center">
                        <div class="flex items-center space-x-6">
                            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center font-black text-xl">02</div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-800">Travel Documents & Visa</h3>
                                <p class="text-slate-400 text-xs uppercase tracking-widest mt-1">E-Tickets • ID Requirements</p>
                            </div>
                        </div>
                        <i id="icon2" class="fas fa-chevron-down text-slate-300 rotate-icon"></i>
                    </div>
                    <div id="faq2" class="answer-panel text-slate-600 leading-relaxed">
                        <p class="mb-4 text-blue-600 font-bold italic">"Do I need a physical copy of my e-ticket?"</p>
                        No, a digital copy on your phone is sufficient. However, for International Travel, ensure your <strong>Passport has at least 6 months validity</strong>. For domestic flights, any government-issued ID (Aadhar, Voter ID) is mandatory during check-in.
                    </div>
                </div>
            </div>

            <div id="guideContainer" class="hidden grid grid-cols-1 gap-6">
                <div class="faq-card-item border border-slate-100 rounded-[2rem] p-8 bg-white" onclick="toggleBox('guide1', 'gicon1')">
                    <div class="w-full flex justify-between items-center">
                        <div class="flex items-center space-x-6">
                            <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center font-black text-xl"><i class="fas fa-hand-holding-usd"></i></div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-800">How to Initiate a Refund</h3>
                                <p class="text-slate-400 text-xs uppercase tracking-widest mt-1">Step-by-Step Tutorial</p>
                            </div>
                        </div>
                        <i id="gicon1" class="fas fa-plus text-slate-300 rotate-icon"></i>
                    </div>
                    <div id="guide1" class="answer-panel text-slate-600 leading-relaxed">
                        <div class="space-y-4">
                            <div><span class="step-pill">Step 1</span><p>Login to your <strong>Travelway Dashboard</strong> and go to "My Bookings".</p></div>
                            <div><span class="step-pill">Step 2</span><p>Select the active trip you wish to cancel and click on <strong>"Manage Booking"</strong>.</p></div>
                            <div><span class="step-pill">Step 3</span><p>Click "Cancel Trip". Our system will calculate the refund amount automatically based on the time left for travel.</p></div>
                            <div><span class="step-pill">Step 4</span><p>Confirm the bank details and click "Request Refund". You will get a <strong>Transaction ID</strong> via SMS.</p></div>
                        </div>
                    </div>
                </div>

                <div class="faq-card-item border border-slate-100 rounded-[2rem] p-8 bg-white" onclick="toggleBox('guide2', 'gicon2')">
                    <div class="w-full flex justify-between items-center">
                        <div class="flex items-center space-x-6">
                            <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center font-black text-xl"><i class="fas fa-users"></i></div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-800">Planning a Group Vacation</h3>
                                <p class="text-slate-400 text-xs uppercase tracking-widest mt-1">Custom Itineraries</p>
                            </div>
                        </div>
                        <i id="gicon2" class="fas fa-plus text-slate-300 rotate-icon"></i>
                    </div>
                    <div id="guide2" class="answer-panel text-slate-600 leading-relaxed">
                        <div class="space-y-4">
                            <div><span class="step-pill">Tip 01</span><p>For groups larger than 10, use the <strong>"Corporate Travel"</strong> tab to unlock flat 15% discounts.</p></div>
                            <div><span class="step-pill">Tip 02</span><p>You can add multiple rooms and flight seats in a single checkout to keep the itinerary unified.</p></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="noMatch" class="hidden text-center py-20">
                <i class="fas fa-search-minus text-slate-200 text-5xl mb-4"></i>
                <h4 class="text-xl font-bold text-slate-800">No matching help found</h4>
                <p class="text-slate-400">Try 'Booking' or 'Refund'.</p>
            </div>

            <div class="mt-20 premium-gradient rounded-[3rem] p-12 text-white flex flex-col lg:flex-row items-center justify-between shadow-2xl">
                <div class="text-center lg:text-left">
                    <h3 class="text-3xl font-extrabold mb-2">Can't find what you're looking for?</h3>
                    <p class="text-blue-100/70 font-light">Email us or call our 24/7 hotline for immediate assistance.</p>
                </div>
                <div class="mt-8 lg:mt-0 flex gap-4">
                    <a href="mailto:support@travelway.com" class="bg-white text-blue-900 px-8 py-4 rounded-2xl font-bold hover:shadow-xl transition-all">Support Email</a>
                    <a href="tel:+91000" class="bg-blue-500 text-white px-8 py-4 rounded-2xl font-bold hover:bg-blue-600 transition-all">Emergency Desk</a>
                </div>
            </div>
        </div>
    </main>

    <script>
        function toggleBox(panelId, iconId) {
            const panel = document.getElementById(panelId);
            const icon = document.getElementById(iconId);
            panel.classList.toggle('active');
            if(panel.classList.contains('active')) {
                icon.style.transform = "rotate(180deg)";
                icon.style.color = "#2563eb";
            } else {
                icon.style.transform = "rotate(0deg)";
                icon.style.color = "#cbd5e1";
            }
        }

        function switchTab(target) {
            const faq = document.getElementById('faqContainer');
            const guide = document.getElementById('guideContainer');
            const btnFaq = document.getElementById('btnFaq');
            const btnGuide = document.getElementById('btnGuide');
            const heading = document.getElementById('mainHeading');

            if (target === 'faq') {
                faq.classList.remove('hidden');
                guide.classList.add('hidden');
                heading.innerText = "Core Assistance";
                btnFaq.className = "bg-white text-blue-600 px-10 py-3 rounded-xl text-sm font-bold shadow-sm transition-all";
                btnGuide.className = "text-slate-500 px-10 py-3 rounded-xl text-sm font-bold hover:text-slate-700 transition-all";
            } else {
                faq.classList.add('hidden');
                guide.classList.remove('hidden');
                heading.innerText = "Step-by-Step Guides";
                btnGuide.className = "bg-white text-blue-600 px-10 py-3 rounded-xl text-sm font-bold shadow-sm transition-all";
                btnFaq.className = "text-slate-500 px-10 py-3 rounded-xl text-sm font-bold hover:text-slate-700 transition-all";
            }
            document.getElementById('masterSearch').value = "";
            searchHelp();
        }

        function searchHelp() {
            const query = document.getElementById('masterSearch').value.toLowerCase();
            const cards = document.getElementsByClassName('faq-card-item');
            let found = 0;
            for (let i = 0; i < cards.length; i++) {
                if (cards[i].innerText.toLowerCase().includes(query)) {
                    cards[i].style.display = "block";
                    found++;
                } else {
                    cards[i].style.display = "none";
                }
            }
            document.getElementById('noMatch').style.display = (found === 0) ? "block" : "none";
        }
    </script>
</body>
</html>