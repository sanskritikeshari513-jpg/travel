<?php 
session_start(); 
if(isset($_SESSION['user_id'])) { 
    header("Location: travel.php"); 
    exit();
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    <title>TravelWay | Experience 2026</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root{ --brand:#2D68FF; --brand-hover:#1a54eb; --input-bg:rgba(255,255,255,0.12); --glass-border:rgba(255,255,255,0.2); }
        *{ margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans',sans-serif; }
        
        body { 
            background: url('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=1920&q=80'); 
            background-size: cover; background-position: center; min-height: 100vh; 
            display: flex; align-items: center; justify-content: center; padding: 20px; overflow: hidden; position: relative; 
        }
        
        body::before { content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.45); backdrop-filter: blur(25px); z-index: 1; }
        
        .split-card { 
            width: 100%; max-width: 960px; display: flex; gap: 30px; padding: 30px; 
            background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); border-radius: 35px; 
            backdrop-filter: blur(10px); position: relative; z-index: 2; animation: fadeIn .8s ease-out; 
        }

        @keyframes fadeIn{ from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }
        
        .left-pane{ flex:1; color:#fff; padding:20px; display:flex; flex-direction:column; justify-content:space-between; }
        .feature-tag{ display:inline-flex; gap:8px; align-items:center; background:rgba(255,255,255,.15); padding:8px 16px; border-radius:50px; font-size:12px; font-weight:700; width:fit-content; }
        .left-pane h1{ font-size:44px; font-weight:800; margin:20px 0 10px; letter-spacing:-2px; }
        .left-pane p{ color:rgba(255,255,255,.75); line-height:1.6; max-width:330px; }
        
        .right-pane{ flex:1; padding-right:10px; position: relative; }
        .tabs{ display:flex; gap:30px; margin-bottom:25px; }
        .tab-btn{ background:none; border:none; color:rgba(255,255,255,.4); font-weight:700; cursor:pointer; font-size:15px; position:relative; }
        .tab-btn.active{color:#fff}
        .tab-btn.active::after{ content:""; position:absolute; bottom:-6px; left:0; width:100%; height:3px; background:var(--brand); border-radius:10px; }
        
        h2{ font-size:28px; font-weight:800; color:#fff; margin-bottom:6px; }
        .desc{ font-size:14px; color:rgba(255,255,255,.7); margin-bottom:22px; }
        
        .input-group{ margin-bottom:18px; position:relative; }
        .label-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; }
        label{ font-size:10px; font-weight:700; letter-spacing:1px; color:#fff; opacity:.8; text-transform:uppercase; }
        
        input { width: 100%; padding: 14px 18px; border-radius: 14px; border: 1px solid var(--glass-border); background: var(--input-bg); color: #fff; font-size: 14px; }
        input:focus{ outline:none; border-color:var(--brand); background:rgba(255,255,255,0.2); }
        
        .eye-icon{ position:absolute; right:15px; top:35px; cursor:pointer; color:rgba(255,255,255,0.6); z-index: 5; }
        
        .pass-hint{ font-size:10px; margin-top:5px; color:#ff9b9b; font-weight: 600; }
        .pass-hint.valid{color:#52ffc3}
        
        .suggest-btn { font-size: 10px; color: var(--brand); cursor: pointer; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
        .suggest-btn:hover { text-decoration: underline; }

        .option-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; margin-top: -10px; }
        .remember { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #fff; cursor: pointer; user-select: none; }
        .remember input { width: 16px; height: 16px; cursor: pointer; accent-color: var(--brand); }
        .forgot-link { font-size: 13px; color: var(--brand); font-weight: 700; cursor: pointer; }

        .btn-primary{ width:100%; padding:16px; border:none; border-radius:16px; background:var(--brand); color:#fff; font-size:15px; font-weight:800; cursor:pointer; transition:.3s; }
        .btn-primary:hover{background:var(--brand-hover); transform: scale(1.02);}
        
        .divider{ display:flex; align-items:center; margin:20px 0; font-size:10px; font-weight:800; letter-spacing:1px; color:rgba(255,255,255,0.35); text-transform:uppercase; }
        .divider::before, .divider::after{ content:""; flex:1; height:1px; background:rgba(255,255,255,0.1); margin:0 12px; }
        
        .social-row{ display:flex; gap:12px; margin-bottom:15px; }
        .social-btn{ flex:1; padding:12px; border-radius:14px; border:1px solid var(--glass-border); background:rgba(255,255,255,.08); color:#fff; font-weight:700; font-size:13px; display:flex; align-items:center; justify-content:center; gap:8px; cursor:pointer; transition: 0.3s; }
        .social-btn:hover { background: rgba(255,255,255,0.15); }
        
        .hidden{display:none}
        .alert { padding: 12px; border-radius: 12px; font-size: 13px; margin-bottom: 20px; border: 1px solid; animation: shake 0.4s ease-in-out; }
        @keyframes shake { 0%, 100% {transform: translateX(0);} 25% {transform: translateX(-5px);} 75% {transform: translateX(5px);} }
        
        .alert-error { color: #ff4d4d; background: rgba(255, 77, 77, 0.1); border-color: rgba(255, 77, 77, 0.3); }
        .alert-success { color: #52ffc3; background: rgba(82, 255, 195, 0.1); border-color: rgba(82, 255, 195, 0.3); }

        .close-view-btn { position: absolute; right: 0; top: 0; color: rgba(255,255,255,0.4); cursor: pointer; font-size: 20px; transition: 0.3s; }
        .close-view-btn:hover { color: #fff; }

        @media (max-width: 768px) { .split-card { flex-direction: column; padding: 20px; } }
    
        /* ================= RESPONSIVE UPGRADE ================= */

/* Tablet */
@media (max-width: 1024px) {
    .split-card {
        max-width: 90%;
        gap: 20px;
        padding: 25px;
    }

    .left-pane h1 {
        font-size: 36px;
    }
}

/* Mobile */
@media (max-width: 768px) {

    body {
        padding: 15px;
        overflow: auto;
    }

    .split-card {
        flex-direction: column;
        padding: 20px;
        border-radius: 25px;
    }

    /* Left side becomes header */
    .left-pane {
        padding: 10px 5px;
        text-align: center;
        align-items: center;
    }

    .left-pane h1 {
        font-size: 28px;
        margin: 10px 0;
    }

    .left-pane p {
        max-width: 100%;
        font-size: 14px;
    }

    /* Hide bottom copyright on small screens */
    .left-pane p:last-child {
        display: none;
    }

    /* Right side */
    .right-pane {
        padding: 0;
    }

    h2 {
        font-size: 22px;
    }

    .desc {
        font-size: 13px;
    }

    /* Tabs */
    .tabs {
        justify-content: center;
        gap: 20px;
    }

    .tab-btn {
        font-size: 14px;
    }

    /* Inputs */
    input {
        padding: 12px 14px;
        font-size: 13px;
    }

    .eye-icon {
        top: 32px;
        right: 12px;
    }

    /* Buttons */
    .btn-primary {
        padding: 14px;
        font-size: 14px;
    }

    /* Social buttons */
    .social-row {
        flex-direction: column;
    }

    .social-btn {
        font-size: 13px;
        padding: 10px;
    }

    /* Options row */
    .option-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .forgot-link {
        align-self: flex-end;
    }
}

/* Small phones */
@media (max-width: 480px) {

    .split-card {
        padding: 15px;
    }

    .left-pane h1 {
        font-size: 24px;
    }

    .feature-tag {
        font-size: 10px;
        padding: 6px 12px;
    }

    h2 {
        font-size: 20px;
    }

    .btn-primary {
        font-size: 13px;
    }

    .tabs {
        gap: 15px;
    }
}
overflow-x: hidden;
overflow-y: auto;

@media (max-width: 768px) {
    body::before {
        backdrop-filter: blur(10px); /* reduce heavy blur */
    }
}
.auth-footer-text {
    font-size: 0.75rem; /* Chota aur saaf font */
    color:white;    /* Light grey color jo aankhon ko chubhe nahi */
    text-align: center;
    margin-top: 20px;
    line-height: 1.5;
    font-weight: 400;
}

.auth-footer-text a {
    color: #2563eb;       /* Blue color links ke liye */
    text-decoration: none; /* Underline hatane ke liye */
    font-weight: 600;     /* Links ko thoda bold karne ke liye */
    transition: 0.2s;
}

.auth-footer-text a:hover {
    text-decoration: underline; /* Hover karne par underline dikhegi */
    color: #e3d043;
}
    </style>
</head>
<body>

<div class="split-card">
    <div class="left-pane">
        <div>
            <div class="feature-tag">🌍 Explore the World 2026</div>
            <h1>TravelWay</h1>
            <p>Experience seamless journeys with our next-generation travel platform.</p>
        </div>
        <p style="font-size:13px;opacity:.5;">© 2026 TravelWay Global</p>
    </div>

    <div class="right-pane">
        <i class="fas fa-times close-view-btn hidden" id="globalClose" onclick="showView('login')"></i>

        <div id="tabContainer" class="tabs">
            <button class="tab-btn active" id="signupTab" onclick="showView('signup')">Sign Up</button>
            <button class="tab-btn" id="loginTab" onclick="showView('login')">Log In</button>
        </div>

        <div id="signupBox">
            <h2>Create Account</h2>
            <?php if(isset($_GET['error']) && $_GET['error'] == 'email_taken'): ?>
                <div class="alert alert-error">⚠️ This email is already registered.</div>
            <?php endif; ?>
            <p class="desc">Join the TravelWay community.</p>
            
            <div class="social-row">
                <div class="social-btn" onclick="alert('Google Auth is currently in Sandbox mode for security testing. Please use the email signup below.')" style="cursor:pointer;">
                    <img src="https://cdn-icons-png.flaticon.com/512/2991/2991148.png" width="16"> Sign up with Google
                </div>
                
            </div>
               <div class="auth-footer-text">
    By signing up to create an account I accept <br>
    Company's <a href="terms-of-use.php">Terms of Use</a> and <a href="privacy-policy.php">Privacy Policy</a>
            </div>
            <div class="divider">or signup with email</div>
            
            <form action="auth_process.php" method="POST" autocomplete="off">
                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" placeholder="Your Name" required>
                </div>
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="you@example.com" required>
                </div>
                <div class="input-group">
                    <div class="label-row">
                        <label>Password</label>
                        <span class="suggest-btn" onclick="generateStrongPass()">Suggest Strong</span>
                    </div>
                    <input type="password" name="signup_password_unique" id="sPass" autocomplete="new-password" oninput="validatePass(this.value)" placeholder="Choose your own" required>
                    <i class="fas fa-eye-slash eye-icon" onclick="togglePass('sPass',this)"></i>
                    <p id="passHint" class="pass-hint">⚠️ Minimum 8 characters</p>
                </div>
                <button type="submit" name="signup_btn" class="btn-primary">Create Account</button>
            </form>
        </div>

        <div id="loginBox" class="hidden">
            <h2>Welcome Back</h2>
                
          
            <div class="social-row">
                <div class="social-btn" onclick="alert('Google Auth is currently in Sandbox mode for security testing. Please log in with your credentials.')" style="cursor:pointer;">
                    <img src="https://cdn-icons-png.flaticon.com/512/2991/2991148.png" width="16"> Sign in with Google
                </div>

            </div>
                             <div class="auth-footer-text">
    By signing in to create an account I accept <br>
    Company's <a href="terms-of-use.php">Terms of Use</a> and <a href="privacy-policy.php">Privacy Policy</a>.
</div>
 <div class="divider">or signin with email</div>
            <form action="auth_process.php" method="POST" autocomplete="off">
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Email address" required>
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" id="lPass" placeholder="Password" required>
                    <i class="fas fa-eye-slash eye-icon" onclick="togglePass('lPass',this)"></i>
                </div>

                <?php if(isset($_GET['error']) && ($_GET['error'] == 'wrong_pass' || $_GET['error'] == 'user_not_found')): ?>
                    <div class="alert alert-error">
                        <?php 
                            if($_GET['error'] == 'wrong_pass') echo "❌ Incorrect Password. Try again.";
                            if($_GET['error'] == 'user_not_found') echo "❌ Account not found. Please Sign Up.";
                        ?>
                    </div>
                <?php endif; ?>
                
                <div class="option-row">
                    <label class="remember"><input type="checkbox"> Remember Me</label>
                    <span class="forgot-link" onclick="showView('forgot')">Forgot Password?</span>
                </div>
                <button type="submit" name="login_btn" class="btn-primary">Login</button>
            </form>
        </div>

        <div id="forgotBox" class="hidden">
            <h2>Reset Identity</h2>
            <p class="desc">Enter email to receive recovery link.</p>
            <form action="auth_process.php" method="POST">
                <div class="input-group">
                    <label>Registered Email</label>
                    <input type="email" name="reset_email" id="reset_email_input" placeholder="you@example.com" required>
                </div>
                <button type="submit" name="forgot_btn" class="btn-primary">Send Reset Link</button>
            </form>
        </div>

        <div id="successBox" class="hidden" style="text-align: center;">
            <div style="background: rgba(82, 255, 195, 0.1); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                <i class="fas fa-check" style="color: #52ffc3; font-size: 24px;"></i>
            </div>
            <h2>Link Sent!</h2>
            <p class="desc" style="margin-bottom: 30px;">Check your inbox: <br><b id="displayEmail" style="color:#fff"></b></p>
            <button onclick="goToDemoInbox()" class="btn-primary" style="background: #fff; color: #000;">Open Gmail</button>
        </div>
    </div>
</div>

<script>
function showView(type){
    const boxes = ['signupBox', 'loginBox', 'forgotBox', 'successBox'];
    const tabs = document.getElementById('tabContainer');
    const closeBtn = document.getElementById('globalClose');

    boxes.forEach(id => document.getElementById(id).classList.add('hidden'));

    if(type === 'signup' || type === 'login') {
        tabs.classList.remove('hidden');
        closeBtn.classList.add('hidden');
        document.getElementById(type + 'Box').classList.remove('hidden');
        document.getElementById('signupTab').classList.toggle('active', type === 'signup');
        document.getElementById('loginTab').classList.toggle('active', type === 'login');
    } else {
        tabs.classList.add('hidden');
        closeBtn.classList.remove('hidden');
        document.getElementById(type + 'Box').classList.remove('hidden');
    }
}

function goToDemoInbox() {
    const email = document.getElementById('displayEmail').innerText;
    window.open('gmail_inbox.php?email=' + email, '_blank');
}

function togglePass(id,icon){
    const i=document.getElementById(id);
    if(i.type === 'password'){ i.type = 'text'; icon.classList.replace('fa-eye-slash', 'fa-eye');
    } else { i.type = 'password'; icon.classList.replace('fa-eye', 'fa-eye-slash'); }
}

function validatePass(v){
    const h=document.getElementById('passHint');
    if(v.length>=8){ h.textContent='✅ Secure password'; h.classList.add('valid');
    } else { h.textContent='⚠️ Minimum 8 characters'; h.classList.remove('valid'); }
}

function generateStrongPass() {
    const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()";
    let password = "";
    for (let i = 0; i < 12; i++) { password += chars.charAt(Math.floor(Math.random() * chars.length)); }
    const passInput = document.getElementById('sPass');
    passInput.value = password; passInput.type = 'text'; validatePass(password);
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    const status = urlParams.get('status');
    const email = urlParams.get('email');

    if (error === 'wrong_pass' || error === 'user_not_found') {
        showView('login');
    } 
    else if (status === 'reset_sent') {
        showView('success');
        if(email) document.getElementById('displayEmail').innerText = email;
    }
}
</script>
</body>
</html>