<?php
// 1. Timezone set karein (Zaroori step)
    date_default_timezone_set("Asia/Kolkata");
    // Logic: Har din ki current date generate hogi (e.g., March 15, 2026)
    $site_name = "Travelway";
    $current_date = date("F d, Y"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | <?php echo $site_name; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #f8fafc;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .gradient-text {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .accordion-content {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            max-height: 0;
            overflow: hidden;
            opacity: 0;
        }

        .accordion-content.active {
            max-height: 1000px;
            opacity: 1;
            padding-top: 1rem;
        }

        @media print {
            .no-print { display: none; }
            body { background: white; }
            .glass-effect { border: none; shadow: none; }
        }
    </style>
</head>
<body class="antialiased">

    <!-- <nav class="no-print py-4 px-10 flex justify-between items-center glass-effect sticky top-0 z-50">
        <div class="text-2xl font-extrabold tracking-tighter text-blue-700 italic">
            TRAVELWAY<span class="text-slate-400">.</span>
        </div> -->
        <nav class="no-print py-4 px-4 md:px-10 flex flex-col md:flex-row justify-between items-center gap-3 glass-effect sticky top-0 z-50">
    <div class="text-xl md:text-2xl font-extrabold tracking-tighter text-blue-700 italic">
        TRAVELWAY<span class="text-slate-400">.</span>
    </div>
        <a href="travel.php" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">BACK TO HOME</a>
    </nav>

   
    <!-- <header class="pt-20 pb-32 px-6 text-center bg-slate-900 text-white relative overflow-hidden"> -->
  <header class="pt-16 md:pt-20 pb-20 md:pb-32 px-4 md:px-6 text-center bg-slate-900 text-white relative overflow-hidden"> 
    <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full fill-current">
                <polygon points="0,100 100,0 100,100"/>
            </svg>
        </div>
        <div class="relative z-10">
            <!-- <h1 class="text-5xl md:text-7xl font-extrabold mb-6 tracking-tight">Privacy <span class="text-blue-400">Governance</span></h1> -->
             <h1 class="text-4xl md:text-7xl font-extrabold mb-6 tracking-tight">
Privacy <span class="text-blue-400">Governance</span>
</h1>
            <!-- <p class="text-slate-400 text-lg md:text-xl max-w-3xl mx-auto font-light leading-relaxed">
                Comprehensive data protection framework and legal transparency for our global travelers.
            </p> -->
            <p class="text-slate-400 text-base md:text-xl max-w-3xl mx-auto font-light leading-relaxed">
Comprehensive data protection framework and legal transparency for our global travelers.
</p>
        </div>
    </header>

    <!-- <main class="max-w-5xl mx-auto px-6 -mt-20 pb-24 relative z-20"> -->
        <main class="max-w-5xl mx-auto px-4 md:px-6 -mt-16 md:-mt-20 pb-20 md:pb-24 relative z-20">
        <div class="glass-effect rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.1)] overflow-hidden bg-white">
            
            <div class="bg-blue-600 text-white px-10 py-5 flex flex-wrap justify-between items-center">
                <div class="flex items-center space-x-2">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold uppercase tracking-widest">Official Compliance Document</span>
                </div>
                <div class="text-sm font-medium">
                    <i class="fas fa-sync-alt mr-2 opacity-70"></i> 
                    Last Dynamic Update: <span class="underline decoration-blue-300 decoration-2 underline-offset-4"><?php echo $current_date; ?></span>
                </div>
            </div>

            <!-- <div class="p-8 md:p-16"> -->
                <div class="p-6 md:p-16">
                
                <h2 class="text-3xl font-extrabold text-slate-800 mb-8 border-l-4 border-blue-600 pl-6">Commitment to Data Privacy</h2>
                <p class="text-slate-600 text-lg leading-relaxed mb-12">
                    This Privacy Policy governs the manner in which **Travelway** collects, uses, maintains, and discloses information collected from users. Our protocols are designed in alignment with global data protection standards to ensure the highest level of security for your personal and financial identifiers.
                </p>

                <div class="space-y-6">

                    <!-- <div class="group border border-slate-100 rounded-3xl p-6 md:p-8 hover:border-blue-200 hover:bg-blue-50/30 transition-all duration-300"> -->
                        <div class="group border border-slate-100 rounded-3xl p-5 md:p-8 
hover:border-blue-200 hover:bg-blue-50/30 transition-all duration-300">
                        <button onclick="toggleSection('sec1')" class="w-full flex justify-between items-center text-left">
                            <span class="flex items-center space-x-4">
                                <span class="text-3xl font-bold text-slate-200 group-hover:text-blue-200 transition">01</span>
                                <h3 class="text-xl font-bold text-slate-800">Information Architecture</h3>
                            </span>
                            <i id="icon-sec1" class="fas fa-plus text-slate-400 group-hover:text-blue-500 transition"></i>
                        </button>
                        <div id="sec1" class="accordion-content">
                            <p class="text-slate-600 leading-relaxed pl-12">
                                We gather non-sensitive personal identifiers such as full name, electronic mail, and telephonic data. In compliance with travel regulations, we may also process government-issued IDs for international flight or hotel reservations. All data ingestion is performed via secure, encrypted forms.
                            </p>
                        </div>
                    </div>

<!-- 
                    <div class="group border border-slate-100 rounded-3xl p-6 md:p-8 hover:border-blue-200 hover:bg-blue-50/30 transition-all duration-300"> -->
                        <div class="group border border-slate-100 rounded-3xl p-5 md:p-8 
hover:border-blue-200 hover:bg-blue-50/30 transition-all duration-300">
                        <button onclick="toggleSection('sec2')" class="w-full flex justify-between items-center text-left">
                            <span class="flex items-center space-x-4">
                                <span class="text-3xl font-bold text-slate-200 group-hover:text-blue-200 transition">02</span>
                                <h3 class="text-xl font-bold text-slate-800">Payment Integrity Protocols</h3>
                            </span>
                            <i id="icon-sec2" class="fas fa-plus text-slate-400 group-hover:text-blue-500 transition"></i>
                        </button>
                        <div id="sec2" class="accordion-content">
                            <p class="text-slate-600 leading-relaxed pl-12">
                                For all monetary transactions, Travelway implements **AES 256-bit encryption**. We utilize PCI-DSS (Payment Card Industry Data Security Standard) compliant gateways. No sensitive credit card metadata is stored on our local cloud infrastructure, ensuring immunity against financial breaches.
                            </p>
                        </div>
                    </div>

                    <!-- <div class="group border border-slate-100 rounded-3xl p-6 md:p-8 hover:border-blue-200 hover:bg-blue-50/30 transition-all duration-300"> -->
                        <div class="group border border-slate-100 rounded-3xl p-5 md:p-8 
hover:border-blue-200 hover:bg-blue-50/30 transition-all duration-300">
                        <button onclick="toggleSection('sec3')" class="w-full flex justify-between items-center text-left">
                            <span class="flex items-center space-x-4">
                                <span class="text-3xl font-bold text-slate-200 group-hover:text-blue-200 transition">03</span>
                                <h3 class="text-xl font-bold text-slate-800">Third-Party Synergy</h3>
                            </span>
                            <i id="icon-sec3" class="fas fa-plus text-slate-400 group-hover:text-blue-500 transition"></i>
                        </button>
                        <div id="sec3" class="accordion-content">
                            <p class="text-slate-600 leading-relaxed pl-12">
                                To facilitate your travel itinerary, specific datasets are shared with our verified logistics and hospitality partners. These entities are restricted from utilizing your information for independent marketing and are bound by stringent Non-Disclosure Agreements (NDAs).
                            </p>
                        </div>
                    </div>

                    <!-- <div class="group border border-slate-100 rounded-3xl p-6 md:p-8 hover:border-blue-200 hover:bg-blue-50/30 transition-all duration-300"> -->
                        <div class="group border border-slate-100 rounded-3xl p-5 md:p-8 
hover:border-blue-200 hover:bg-blue-50/30 transition-all duration-300">
                        <button onclick="toggleSection('sec4')" class="w-full flex justify-between items-center text-left">
                            <span class="flex items-center space-x-4">
                                <span class="text-3xl font-bold text-slate-200 group-hover:text-blue-200 transition">04</span>
                                <h3 class="text-xl font-bold text-slate-800">Cookie & Cache Governance</h3>
                            </span>
                            <i id="icon-sec4" class="fas fa-plus text-slate-400 group-hover:text-blue-500 transition"></i>
                        </button>
                        <div id="sec4" class="accordion-content">
                            <p class="text-slate-600 leading-relaxed pl-12">
                                We utilize HTTP cookies to personalize search results and preserve session integrity. Users retain the legal right to disable cookies via browser configurations; however, certain dynamic features of the Travelway ecosystem may become inaccessible.
                            </p>
                        </div>
                    </div>

                    <!-- <div class="group border border-slate-100 rounded-3xl p-6 md:p-8 hover:border-blue-200 hover:bg-blue-50/30 transition-all duration-300"> -->
                        <div class="group border border-slate-100 rounded-3xl p-5 md:p-8 
hover:border-blue-200 hover:bg-blue-50/30 transition-all duration-300">
                        <button onclick="toggleSection('sec5')" class="w-full flex justify-between items-center text-left">
                            <span class="flex items-center space-x-4">
                                <span class="text-3xl font-bold text-slate-200 group-hover:text-blue-200 transition">05</span>
                                <h3 class="text-xl font-bold text-slate-800">Data Retention & Purging</h3>
                            </span>
                            <i id="icon-sec5" class="fas fa-plus text-slate-400 group-hover:text-blue-500 transition"></i>
                        </button>
                        <div id="sec5" class="accordion-content">
                            <p class="text-slate-600 leading-relaxed pl-12">
                                We retain user data only for the duration required to fulfill the requested service. Post-service completion or upon a formal account deletion request, all personal data is purged from our production database within 30 business days, subject to regulatory audit requirements.
                            </p>
                        </div>
                    </div>

                                     <div class="group border border-slate-100 rounded-3xl p-5 md:p-8 hover:border-blue-200 hover:bg-blue-50/30 transition-all duration-300">
    <button onclick="toggleSection('sec6')" class="w-full flex justify-between items-center text-left">
        <span class="flex items-center space-x-4">
            <span class="text-3xl font-bold text-slate-200 group-hover:text-blue-200 transition">06</span>
            <h3 class="text-xl font-bold text-slate-800">Financial Reversals & Refunds</h3>
        </span>
        <i id="icon-sec6" class="fas fa-plus text-slate-400 group-hover:text-blue-500 transition"></i>
    </button>
    <div id="sec6" class="accordion-content">
        <p class="text-slate-600 leading-relaxed pl-12">
            Users are entitled to refunds based on the cancellation window of the service provider. Approved refunds are credited back to the original source of payment within <strong>7-10 business days</strong>. Travelway reserves the right to deduct processing fees as per the booking terms.
        </p>
    </div>
</div>
                </div>

                <!-- <div class="mt-20 flex flex-col md:flex-row items-center justify-between border-t pt-10 border-slate-100">
                    <p class="text-slate-400 text-sm italic mb-6 md:mb-0 text-center md:text-left">
                        By using Travelway, you consent to our data processing frameworks outlined above.
                    </p>
                    <div class="flex space-x-4 no-print">
                        <button onclick="window.print()" class="bg-blue-50 text-blue-700 px-6 py-3 rounded-full font-bold hover:bg-blue-100 transition flex items-center">
                            <i class="fas fa-file-pdf mr-2"></i> EXPORT AS PDF
                        </button>
                        <a href="contact us.php" class="bg-blue-600 text-white px-8 py-3 rounded-full font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition">
                            SUPPORT CENTER
                        </a>
                    </div>
                </div> -->
                <div class="mt-20 flex flex-col md:flex-row items-center justify-between border-t pt-10 border-slate-100 gap-5">

<p class="text-slate-400 text-sm italic text-center md:text-left">
By using Travelway, you consent to our data processing frameworks outlined above.
</p>

<div class="flex flex-col sm:flex-row gap-4 no-print">

<button onclick="window.print()" 
class="bg-blue-50 text-blue-700 px-6 py-3 rounded-full font-bold hover:bg-blue-100 transition flex items-center justify-center">
<i class="fas fa-file-pdf mr-2"></i> EXPORT AS PDF
</button>

<a href="contact-us.php"
class="bg-blue-600 text-white px-8 py-3 rounded-full font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition text-center">
SUPPORT CENTER
</a>

</div>
</div>
            </div>
        </div>
        
        <footer class="mt-10 text-center text-slate-400 text-sm">
            &copy; 2026 Travelway Travel Solutions Pvt. Ltd. All Rights Reserved.
        </footer>
    </main>

    <script>
        function toggleSection(id) {
            const content = document.getElementById(id);
            const icon = document.getElementById('icon-' + id);
            
            // Toggle Content
            content.classList.toggle('active');
            
            // Toggle Icon with Animation
            if(content.classList.contains('active')) {
                icon.className = "fas fa-minus text-blue-500 transition-all duration-300";
            } else {
                icon.className = "fas fa-plus text-slate-400 transition-all duration-300";
            }
        }
    </script>
</body>
</html>