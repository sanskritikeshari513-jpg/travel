<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Story | TravelWay Elite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0f172a;
            --bg-card: rgba(30, 41, 59, 0.7);
            --accent-gold: #fbbf24;
            --text-main: #f1f5f9;
            --text-dim: #94a3b8;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            scroll-behavior: smooth; 
            background: var(--bg-dark); 
            color: var(--text-dim);
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4 { 
            color: var(--text-main) !important; 
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .glass { 
            background: rgba(15, 23, 42, 0.9); 
            backdrop-filter: blur(16px); 
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1); 
        }

        .glass-card {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s ease;
        }

        .glass-card:hover {
            border-color: var(--accent-gold);
            transform: translateY(-5px);
        }

        /* S-Curve Logic */
        .s-curve {
            border: 2px solid rgba(255, 255, 255, 0.1);
            background: #1e293b;
            transition: all 0.6s ease;
            overflow: hidden;
        }
        
        .s-left, .s-right { border-radius: 40px; border: 1px solid rgba(255, 255, 255, 0.1); }

        @media (min-width: 768px) {
            .s-left { border-right: none; border-radius: 600px 30px 30px 600px; padding: 15px; }
            .s-right { border-left: none; border-radius: 30px 600px 600px 30px; padding: 15px; }
        }

        #progress-bar { 
            position: fixed; top: 0; left: 0; height: 4px; 
            background: linear-gradient(to right, var(--accent-gold), #f59e0b); 
            width: 0%; z-index: 10000; 
        }

        .reveal { opacity: 0; transform: translateY(30px); transition: 0.8s all ease; }
        .reveal.active { opacity: 1; transform: translateY(0); }

        .btn-gold {
            background: var(--accent-gold);
            color: #0f172a;
            transition: all 0.3s ease;
        }
        .btn-gold:hover { transform: scale(1.05); box-shadow: 0 0 20px rgba(251, 191, 36, 0.4); }

        #mobile-menu {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
        }
        #mobile-menu.active {
            transform: translateY(0);
            opacity: 1;
            pointer-events: all;
        }
    </style>
</head>
<body>

    <div id="progress-bar"></div>

    <nav class="fixed w-full z-[100] glass px-6 md:px-10 py-4 flex justify-between items-center">
        <a href="travel.php" class="text-white font-extrabold text-2xl tracking-tighter">
            Travel<span class="text-amber-400">Way</span>
        </a>

        <div class="hidden md:flex items-center gap-10 text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">
            <a href="about us.php" class="text-amber-400">Our Story</a>
            <a href="contact-us.php" class="hover:text-amber-400 transition">Contact</a>
            <a href="packages.php" class="btn-gold px-8 py-3 rounded-full text-[11px] font-bold uppercase tracking-widest shadow-lg">Plan A Trip</a>
        </div>

        <button id="menu-btn" class="md:hidden text-white text-2xl focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <div id="mobile-menu" class="fixed inset-0 z-[90] glass flex flex-col justify-center items-center gap-8 text-center md:hidden">
        <a href="about us.php" class="text-2xl font-bold text-amber-400">Our Story</a>
        <a href="contact-us.php" class="text-2xl font-bold text-white hover:text-amber-400">Contact</a>
        <a href="packages.php" class="btn-gold px-10 py-4 rounded-full text-sm font-bold uppercase tracking-widest">Plan A Trip</a>
    </div>

    <header class="min-h-screen flex flex-col justify-center items-center text-center px-6 relative overflow-hidden pt-20">
        <div class="absolute top-0 left-0 w-64 md:w-96 h-64 md:h-96 bg-amber-500/10 blur-[100px] rounded-full"></div>
        <div class="absolute bottom-0 right-0 w-64 md:w-96 h-64 md:h-96 bg-blue-500/10 blur-[100px] rounded-full"></div>

        <span class="text-amber-400 border border-amber-400/30 bg-amber-400/10 px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest mb-8 reveal">Beyond the Horizon</span>
        <h1 class="text-4xl md:text-7xl lg:text-8xl mb-8 reveal leading-tight">Explore The <br> <span class="text-transparent" style="-webkit-text-stroke: 1px #fbbf24;">Unseen World.</span></h1>
        <p class="max-w-xl text-base md:text-lg reveal font-light text-slate-400">Crafting unique journeys for 15,000+ wanderers who seek the extraordinary in every corner of the globe.</p>
        
        <div class="mt-12 reveal">
            <a href="#story" class="w-12 h-12 md:w-14 md:h-14 rounded-full border border-slate-700 flex items-center justify-center text-amber-400 hover:bg-amber-400 hover:text-slate-900 transition-all duration-500">
                <i class="fas fa-arrow-down animate-bounce"></i>
            </a>
        </div>
    </header>

    <section class="pb-20 md:pb-32 max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 relative z-10">
        <div class="p-8 md:p-10 glass-card rounded-[30px] md:rounded-[40px] reveal group text-center md:text-left">
            <div class="w-14 h-14 bg-amber-400/10 rounded-2xl flex items-center justify-center mb-6 mx-auto md:mx-0 group-hover:bg-amber-400 group-hover:text-slate-900 transition-all duration-500">
                <i class="fas fa-fingerprint text-2xl text-amber-400 group-hover:text-inherit"></i>
            </div>
            <h4 class="text-xl mb-3">Authenticity</h4>
            <p class="text-sm">We find the hidden gems that tourists usually miss. Real stories, real people.</p>
        </div>
        <div class="p-8 md:p-10 glass-card rounded-[30px] md:rounded-[40px] reveal group text-center md:text-left">
            <div class="w-14 h-14 bg-emerald-400/10 rounded-2xl flex items-center justify-center mb-6 mx-auto md:mx-0 group-hover:bg-emerald-400 group-hover:text-slate-900 transition-all duration-500">
                <i class="fas fa-leaf text-2xl text-emerald-400 group-hover:text-inherit"></i>
            </div>
            <h4 class="text-xl mb-3">Eco-Logic</h4>
            <p class="text-sm">Carbon-neutral travel that respects local cultures and environments.</p>
        </div>
        <div class="p-8 md:p-10 glass-card rounded-[30px] md:rounded-[40px] reveal group text-center md:text-left">
            <div class="w-14 h-14 bg-blue-400/10 rounded-2xl flex items-center justify-center mb-6 mx-auto md:mx-0 group-hover:bg-blue-400 group-hover:text-slate-900 transition-all duration-500">
                <i class="fas fa-shield-alt text-2xl text-blue-400 group-hover:text-inherit"></i>
            </div>
            <h4 class="text-xl mb-3">Safe Harbor</h4>
            <p class="text-sm">Our 24/7 global support team ensures your peace of mind everywhere.</p>
        </div>
    </section>

    <section id="story" class="max-w-6xl mx-auto py-20 px-6">
        <div class="space-y-20 md:space-y-32">
            <div class="flex flex-col md:flex-row items-center gap-10 reveal">
                <div class="w-full md:w-1/2 s-curve s-left p-2">
                    <img src="https://images.unsplash.com/photo-1503220317375-aaad61436b1b?w=800" class="rounded-[30px] md:rounded-[480px_30px_30px_480px] h-[300px] md:h-[450px] w-full object-cover grayscale hover:grayscale-0 transition duration-700">
                </div>
                <div class="w-full md:w-1/2 md:pl-16 text-center md:text-left">
                    <h3 class="text-4xl md:text-5xl mb-6">The Spark.</h3>
                    <p class="text-lg italic mb-4 text-amber-400">"It all started with a torn map."</p>
                    <p class="text-base leading-relaxed">We weren't looking to build a business. We were looking to build a way back to nature. TravelWay was born from the pure joy of discovering the unknown.</p>
                </div>
            </div>

            <div class="flex flex-col-reverse md:flex-row items-center gap-10 reveal">
                <div class="w-full md:w-1/2 md:pr-16 text-center md:text-right">
                    <h3 class="text-4xl md:text-5xl mb-6">The Journey.</h3>
                    <p class="text-base leading-relaxed">Fifteen years later, we are a global network of explorers. From the peaks of the Himalayas to the hidden alleys of Kyoto, our story is still being written by you.</p>
                </div>
                <div class="w-full md:w-1/2 s-curve s-right p-2">
                    <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=800" class="rounded-[30px] md:rounded-[30px_480px_480px_30px] h-[300px] md:h-[450px] w-full object-cover grayscale hover:grayscale-0 transition duration-700">
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 md:py-32 bg-slate-900/50 rounded-[40px] md:rounded-[80px] mx-4 my-20 border border-white/5">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <span class="text-amber-400 font-bold uppercase tracking-[0.3em] text-[10px] mb-4 block">Our Team</span>
            <h2 class="text-4xl md:text-5xl mb-16 md:mb-20">The Visionaries</h2>
            
           <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 gap-12 md:gap-y-20">
    
    <div class="reveal group md:col-span-3">
        <div class="w-40 h-40 md:w-52 md:h-52 mx-auto mb-6 md:mb-8 rounded-full overflow-hidden border-4 border-slate-800 group-hover:border-amber-400 transition duration-500 shadow-2xl">
            <img src="WhatsApp Image 2026-04-02 at 12.41.01.jpeg" alt="Mohini" class="w-full h-full object-cover">
        </div>
        <h5 class="text-xl font-bold">Mohini Mishra</h5>
        <p class="text-amber-400 text-xs font-bold uppercase mt-2 tracking-widest">Founder & CEO</p>
    </div>

    <div class="reveal group md:col-span-3">
        <div class="w-40 h-40 md:w-52 md:h-52 mx-auto mb-9 md:mb-8 rounded-full overflow-hidden border-4 border-slate-800 group-hover:border-amber-400 transition duration-500 shadow-2xl">
            <img src="WhatsApp Image 2026-10-08 at 14.58.47.jpeg" alt="Sanskriti" class="w-full h-full object-cover">
        </div>
        <h5 class="text-xl font-bold">Sanskriti Keshari</h5>
        <p class="text-amber-400 text-xs font-bold uppercase mt-2 tracking-widest">Chief Strategist / Marketing Lead</p>
    </div>

    <div class="reveal group md:col-span-2">
        <div class="w-40 h-40 md:w-52 md:h-52 mx-auto mb-6 md:mb-8 rounded-full overflow-hidden border-4 border-slate-800 group-hover:border-amber-400 transition duration-500 shadow-2xl">
            <img src="WhatsApp Image 2026-05-04 at 10.50.00.jpeg" alt="Prince" class="w-full h-full object-cover">
        </div>
        <h5 class="text-xl font-bold">Prince Mishra</h5>
        <p class="text-amber-400 text-xs font-bold uppercase mt-2 tracking-widest">Co-Founder & CTO</p>
    </div>

    <div class="reveal group md:col-span-2">
        <div class="w-40 h-40 md:w-52 md:h-52 mx-auto mb-6 md:mb-8 rounded-full overflow-hidden border-4 border-slate-800 group-hover:border-amber-400 transition duration-500 shadow-2xl">
            <img src="WhatsApp Image 2026-05-04 at 10.53.28.jpeg" alt="Baliram" class="w-full h-full object-cover">
        </div>
        <h5 class="text-xl font-bold">Baliram</h5>
        <p class="text-amber-400 text-xs font-bold uppercase mt-2 tracking-widest">Experience Lead / Customer Support </p>
    </div>

    <div class="reveal group md:col-span-2">
        <div class="w-40 h-40 md:w-52 md:h-52 mx-auto mb-6 md:mb-8 rounded-full overflow-hidden border-4 border-slate-800 group-hover:border-amber-400 transition duration-500 shadow-2xl">
            <img src="WhatsApp Image 2026-05-04 at 10.49.57.jpeg" alt="Aman" class="w-full h-full object-cover">
        </div>
        <h5 class="text-xl font-bold">Aman</h5>
        <p class="text-amber-400 text-xs font-bold uppercase mt-2 tracking-widest">Operations Head</p>
    </div>

    </div>
        </div>
    </section>

    <footer class="py-20 md:py-32 text-center border-t border-white/5 bg-slate-950/50 px-6">
        <h2 class="text-4xl md:text-6xl mb-8 reveal">Stay Inspired.</h2>
        <div class="max-w-xl mx-auto reveal">
            <div class="relative glass rounded-full p-2 border border-white/10 flex items-center">
                <input type="email" placeholder="Email address" class="w-full p-4 md:p-5 rounded-full bg-transparent outline-none text-sm font-semibold text-white">
                <button class="btn-gold px-6 md:px-10 py-3 rounded-full text-[10px] font-bold uppercase tracking-widest shadow-xl ml-2">Join</button>
            </div>
        </div>
        
        <div class="mt-20 flex justify-center gap-10 text-slate-600 text-2xl">
            <a href="#" class="hover:text-amber-400 transition-all"><i class="fab fa-instagram"></i></a>
            <a href="#" class="hover:text-amber-400 transition-all"><i class="fab fa-twitter"></i></a>
            <a href="#" class="hover:text-amber-400 transition-all"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <p class="mt-12 text-[10px] uppercase tracking-[0.5em] text-slate-700">© 2026 TravelWay Elite</p>
    </footer>

    <script>
        // Mobile Menu Toggle logic
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = menuBtn.querySelector('i');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            menuIcon.classList.toggle('fa-bars');
            menuIcon.classList.toggle('fa-times');
        });

        // Close menu on link click
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                menuIcon.classList.add('fa-bars');
                menuIcon.classList.remove('fa-times');
            });
        });

        // Scroll & Reveal Animation logic
        function reveal() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("progress-bar").style.width = scrolled + "%";

            let reveals = document.querySelectorAll(".reveal");
            for (let i = 0; i < reveals.length; i++) {
                let windowHeight = window.innerHeight;
                let elementTop = reveals[i].getBoundingClientRect().top;
                let elementVisible = 100;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }

        window.addEventListener("scroll", reveal);
        
        // Trigger once on load
        window.onload = () => {
            reveal();
            // Force active state for top elements
            document.querySelectorAll(".reveal").forEach((el, i) => { if(i < 4) el.classList.add("active"); });
        };
    </script>
</body>
</html>