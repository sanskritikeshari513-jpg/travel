<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password | TravelWay</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { --brand: #2D68FF; --brand-hover: #1a54eb; }
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        
        body { 
            background: #111; 
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=1920&q=80');
            background-size: cover; background-position: center;
            color: white; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; 
        }

        .card { 
            background: rgba(255,255,255,0.08); padding: 40px; border-radius: 25px; 
            backdrop-filter: blur(15px); width: 100%; max-width: 400px; 
            border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }
        
        h2 { font-size: 24px; font-weight: 800; margin-bottom: 8px; }
        .desc { font-size: 14px; opacity: 0.7; margin-bottom: 25px; line-height: 1.5; }
        
        .input-group { position: relative; margin-bottom: 20px; }
        
        label { display: block; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; opacity: 0.8; }
        
        input { 
            width: 100%; padding: 14px 18px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.2); 
            background: rgba(255,255,255,0.05); color: white; font-size: 14px; outline: none; transition: 0.3s;
        }
        
        input:focus { border-color: var(--brand); background: rgba(255,255,255,0.1); }
        
        .eye-icon { 
            position: absolute; right: 15px; top: 38px; 
            cursor: pointer; color: rgba(255,255,255,0.4); font-size: 16px;
        }
        .eye-icon:hover { color: white; }
        
        .btn { 
            width: 100%; padding: 16px; background: var(--brand); border: none; border-radius: 14px; 
            color: white; font-weight: bold; font-size: 15px; cursor: pointer; transition: 0.3s; margin-top: 10px;
        }
        .btn:hover { background: var(--brand-hover); transform: translateY(-2px); }

        .error-msg { color: #ff6b6b; font-size: 12px; margin-top: 5px; display: none; }
    </style>
</head>
<body>

<div class="card">
    <h2>Update Password</h2>
    <p class="desc">Enter your new secure password below to regain access.</p>
    
    <form action="auth_process.php" method="POST" id="resetForm">
        <input type="hidden" name="user_email" value="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>">
        
        <div class="input-group">
            <label>New Password</label>
            <input type="password" name="new_password" id="newPass" placeholder="••••••••" required minlength="8">
            <i class="fas fa-eye-slash eye-icon" onclick="togglePass('newPass', this)"></i>
        </div>
      
        <div class="input-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" id="confirmPass" placeholder="••••••••" required>
            <i class="fas fa-eye-slash eye-icon" onclick="togglePass('confirmPass', this)"></i>
            <p id="matchError" class="error-msg">❌ Passwords do not match!</p>
        </div>
        
        <button type="submit" name="update_pass_btn" class="btn">Update Password</button>
    </form>
</div>

<script>
// Eye Toggle Logic
function togglePass(inputId, icon) {
    const input = document.getElementById(inputId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    }
}

// Form Validation Logic
document.getElementById('resetForm').onsubmit = function(e) {
    const p1 = document.getElementById('newPass').value;
    const p2 = document.getElementById('confirmPass').value;
    const errorMsg = document.getElementById('matchError');

    if (p1 !== p2) {
        errorMsg.style.display = 'block';
        return false; // Form submit nahi hoga
    }
    return true;
};
</script>

</body>
</html>