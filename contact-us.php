<?php
    date_default_timezone_set("Asia/Kolkata");
    $site_name = "Travelway";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | <?php echo $site_name; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f1f5f9; }
        .contact-gradient { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); }
    </style>
</head>
<body class="antialiased text-slate-800">

    <nav class="p-6 bg-white border-b flex justify-between items-center sticky top-0 z-50">
        <div class="text-xl font-black text-blue-700 italic">TRAVELWAY<span class="text-slate-400">.</span></div>
        <a href="travel.php" class="text-xs font-bold text-slate-500 hover:text-blue-600 uppercase tracking-widest">Back</a>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-16">
        <div class="grid md:grid-cols-3 gap-8">
            
            <div class="md:col-span-1 space-y-6">
                <div class="contact-gradient p-8 rounded-[2rem] text-white shadow-xl">
                    <h1 class="text-3xl font-extrabold mb-4">Get in Touch</h1>
                    <p class="text-blue-100 mb-8 font-light">Aapki travel queries ke liye hum hamesha available hain.</p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="bg-white/20 p-3 rounded-xl"><i class="fas fa-phone-alt"></i></div>
                            <div><p class="text-xs text-blue-200 uppercase font-bold">Call Us</p><p class="font-semibold">+91 98765 43210</p></div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="bg-white/20 p-3 rounded-xl"><i class="fas fa-envelope"></i></div>
                            <div><p class="text-xs text-blue-200 uppercase font-bold">Email</p><p class="font-semibold">support@travelway.com</p></div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="bg-white/20 p-3 rounded-xl"><i class="fas fa-map-marker-alt"></i></div>
                            <div><p class="text-xs text-blue-200 uppercase font-bold">Office</p><p class="font-semibold text-sm">Tech Hub, Sector 62, Noida, UP</p></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 bg-white rounded-[2rem] p-8 md:p-12 shadow-sm border border-slate-100">
                <form action="submit_contact.php" method="POST" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-600 ml-1">Full Name</label>
                            <input type="text" name="name" required placeholder="John Doe" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-600 ml-1">Email Address</label>
                            <input type="email" name="email" required placeholder="john@example.com" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-600 ml-1">Subject</label>
                        <select name="subject" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none">
                            <option>Booking Inquiry</option>
                            <option>Refund Status</option>
                            <option>Package Customization</option>
                            <option>Technical Issue</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-600 ml-1">How can we help?</label>
                        <textarea name="message" rows="4" required placeholder="Aapka message yahan likhein..." class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-bold text-lg hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all active:scale-[0.98]">
                        Send Message <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>

        </div>
    </main>

    <footer class="py-10 text-center text-slate-400 text-xs uppercase tracking-widest">
        &copy; 2026 Travelway - Contact Support
    </footer>

</body>
</html>