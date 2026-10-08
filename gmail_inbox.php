<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gmail Inbox - (Demo)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f6f8fc; margin: 0; display: flex; height: 100vh; }
        .sidebar { width: 250px; padding: 20px; background: #f6f8fc; }
        .compose-btn { background: #c2e7ff; padding: 15px 25px; border-radius: 16px; display: inline-block; font-weight: 500; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); cursor: pointer; }
        .main-inbox { flex: 1; background: white; margin: 15px; border-radius: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden; }
        .header { padding: 15px; border-bottom: 1px solid #f1f1f1; display: flex; align-items: center; justify-content: space-between; }
        .email-row { padding: 12px 20px; display: flex; align-items: center; border-bottom: 1px solid #f8f9fa; cursor: pointer; transition: background 0.2s; }
        .email-row:hover { background: #f2f5f9; box-shadow: inset 3px 0 0 #4285f4; }
        .email-row.unread { font-weight: bold; background: #fff; }
        .sender { width: 200px; }
        .subject { flex: 1; color: #5f6368; font-weight: normal; }
        .unread .subject { color: #202124; font-weight: bold; }
        
        /* Modal for viewing email */
        .modal { display: none; position: fixed; z-index: 10; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); }
        .modal-content { background: white; margin: 5% auto; padding: 40px; border-radius: 20px; width: 500px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        .btn-reset { background: #2D68FF; color: white; padding: 12px 25px; border-radius: 10px; text-decoration: none; display: inline-block; margin-top: 20px; font-weight: bold; }
    </style>
</head>
<body>

<div class="sidebar">
    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ab/Gmail_Icon.svg" width="100" style="margin-bottom:20px;">
    <div class="compose-btn"><i class="fas fa-pencil"></i> Compose</div>
    <div style="color:#001d35; font-weight:bold; background:#eaf1fb; padding:10px 20px; border-radius:20px;"><i class="fas fa-inbox"></i> Inbox (1)</div>
</div>

<div class="main-inbox">
    <div class="header">
        <div style="color:#5f6368;"><i class="fas fa-redo"></i> &nbsp; <i class="fas fa-ellipsis-v"></i></div>
        <div style="color:#5f6368;">1-1 of 1</div>
    </div>

    <div class="email-row unread" onclick="openEmail()">
        <div style="width:50px;"><i class="far fa-star"></i></div>
        <div class="sender">TravelWay Security</div>
        <div class="subject">Action Required: Reset your password link inside...</div>
        <div style="font-size: 12px; color: #5f6368;">11:45 AM</div>
    </div>
</div>

<div id="emailModal" class="modal">
    <div class="modal-content">
        <img src="https://cdn-icons-png.flaticon.com/512/8132/8132714.png" width="80" style="margin-bottom: 20px;">
        <h2 style="color: #202124;">Password Reset Request</h2>
        <p style="color: #5f6368;">Hi <?php echo isset($_GET['email']) ? explode('@', $_GET['email'])[0] : 'User'; ?>,</p>
        <p style="color: #5f6368;">We received a request to reset your TravelWay password. Click the button below to set a new one.</p>
        <a href="reset_password.php?email=<?php echo $_GET['email']; ?>" class="btn-reset">Reset My Password</a>
        <p style="font-size: 11px; color: #999; margin-top: 30px;">If you didn't request this, you can safely ignore this email.</p>
    </div>
</div>

<script>
function openEmail() {
    document.getElementById('emailModal').style.display = "block";
}
</script>

</body>
</html>