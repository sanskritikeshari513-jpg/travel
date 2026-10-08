<?php
session_start();
require 'db.php'; 

if (!isset($pdo)) {
    die("Database connection failed. Please check db.php");
}

if (!isset($_SESSION['user_id'])) { 
    $_SESSION['user_id'] = 16; 
} 
$uid = $_SESSION['user_id'];

$msg = "";
$status = ""; 

// --- FETCH DATA ---
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$uid]);
    $user = $stmt->fetch();
    if (!$user) { die("User not found."); }
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

// --- LOGIC: SAVE ALL CHANGES (Including Photo) ---
if (isset($_POST['save_changes'])) {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $phone = $_POST['phone'];
    $dob   = $_POST['dob'];
    $country = $_POST['country'];
    $full_name = trim($fname . " " . $lname);
    
    $profile_pic_name = $user['profile_pic']; // Default purani wali

    // 1. Photo Upload Handling
    if (isset($_FILES['new_dp']) && $_FILES['new_dp']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $filename = $_FILES['new_dp']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            // Naya unique naam file ke liye
            $new_name = "user_" . $uid . "_" . time() . "." . $ext;
            $upload_path = 'uploads/' . $new_name;

            if (move_uploaded_file($_FILES['new_dp']['tmp_name'], $upload_path)) {
                $profile_pic_name = $upload_path; // Naya path set kiya
            }
        }
    }

    // 2. Database Update
    try {
        $sql = "UPDATE users SET full_name = ?, phone = ?, dob = ?, country = ?, profile_pic = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute([$full_name, $phone, $dob, $country, $profile_pic_name, $uid])) {
            $msg = "Profile and Photo updated successfully!";
            $status = "success";
            header("Refresh:1");
        }
    } catch (PDOException $e) {
        $msg = "Update failed!";
        $status = "error";
    }
}

// --- LOGIC: REMOVE PHOTO ---
if (isset($_POST['remove_photo'])) {
    $stmt = $pdo->prepare("UPDATE users SET profile_pic = NULL WHERE id = ?");
    $stmt->execute([$uid]);
    $msg = "Photo removed!";
    $status = "success";
    header("Refresh:1");
}

// --- LOGIC: PASSWORD UPDATE ---
if (isset($_POST['update_pass'])) {
    $current_input = $_POST['current_password'];
    $new_input = $_POST['new_password'];
    if (password_verify($current_input, $user['password'])) {
        $new_hash = password_hash($new_input, PASSWORD_DEFAULT);
        $pdo->prepare("UPDATE users SET password = ? WHERE id = ?")->execute([$new_hash, $uid]);
        $msg = "Security updated!";
        $status = "success";
    } else {
        $msg = "Current password wrong!";
        $status = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings | TravelWay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .tab-content { display: none; }
        .tab-content.active { display: block; animation: fadeIn 0.5s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .active-tab { background: #000; color: #fff !important; border-radius: 12px; }
    </style>
</head>
<body class="bg-[#fafafa] text-[#1a1a1a]">

    <div class="max-w-5xl mx-auto py-16 px-4">
        
        <?php if($msg): ?>
            <div class="fixed top-6 left-1/2 -translate-x-1/2 z-50 <?php echo $status == 'success' ? 'bg-black' : 'bg-red-600'; ?> text-white px-8 py-4 rounded-2xl shadow-2xl font-bold flex items-center gap-3">
                <i class="fa-solid <?php echo $status == 'success' ? 'fa-check-circle' : 'fa-triangle-exclamation'; ?>"></i>
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div class="lg:col-span-3">
                <h1 class="text-2xl font-extrabold tracking-tighter mb-10">Settings</h1>
                <nav class="flex lg:flex-col gap-2 overflow-x-auto pb-4">
                    <button onclick="openTab(event, 'general')" class="tab-btn active-tab whitespace-nowrap px-6 py-3 text-sm font-bold text-gray-500 hover:text-black transition-all flex items-center gap-3">
                        <i class="fa-solid fa-id-card-alt"></i> General
                    </button>
                    <button onclick="openTab(event, 'security')" class="tab-btn whitespace-nowrap px-6 py-3 text-sm font-bold text-gray-500 hover:text-black transition-all flex items-center gap-3">
                        <i class="fa-solid fa-lock"></i> Security
                    </button>
                </nav>
            </div>

            <div class="lg:col-span-9 bg-white rounded-[2.5rem] p-8 md:p-14 shadow-sm border border-gray-100">
                
                <div id="general" class="tab-content active">
                    <div class="mb-12">
                        <h2 class="text-3xl font-extrabold tracking-tight">Public Profile</h2>
                        <p class="text-gray-400 mt-1">Update your photo and personal details.</p>
                    </div>

                    <form method="POST" enctype="multipart/form-data" class="space-y-10">
                        
                        <div class="flex flex-wrap items-center gap-8 group mb-12">
                            <div class="relative">
                                <?php 
                                    $profile_pic = !empty($user['profile_pic']) ? $user['profile_pic'] : "https://ui-avatars.com/api/?name=".urlencode($user['full_name'])."&background=000&color=fff&bold=true&size=128";
                                ?>
                                <img id="preview" src="<?php echo $profile_pic; ?>" class="w-32 h-32 rounded-[2.5rem] object-cover ring-4 ring-gray-50 group-hover:opacity-90 transition">
                                <label class="absolute -bottom-2 -right-2 bg-black text-white p-3 rounded-2xl cursor-pointer hover:scale-110 transition shadow-lg">
                                    <i class="fa-solid fa-camera"></i>
                                    <input type="file" name="new_dp" class="hidden" onchange="previewImage(event)">
                                </label>
                            </div>
                            <div class="space-y-2">
                                <h4 class="font-bold text-lg">Your Photo</h4>
                                <div class="flex gap-4">
                                    <button type="submit" name="remove_photo" class="text-[10px] font-black tracking-widest text-red-500 hover:text-red-700 transition uppercase flex items-center gap-1">
                                        <i class="fa-solid fa-trash-can"></i> Remove Photo
                                    </button>
                                </div>
                                <p class="text-sm text-gray-400">Login as: <span class="text-black font-semibold"><?php echo htmlspecialchars($user['email']); ?></span></p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-10">
                            <?php 
                                $names = explode(" ", $user['full_name'], 2);
                                $first = $names[0] ?? '';
                                $last = $names[1] ?? '';
                            ?>
                            <div class="space-y-2">
                                <label class="text-[11px] font-black uppercase text-gray-400 tracking-widest">First Name</label>
                                <input type="text" name="first_name" value="<?php echo htmlspecialchars($first); ?>" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 outline-none font-semibold transition focus:ring-2 focus:ring-black" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-black uppercase text-gray-400 tracking-widest">Last Name</label>
                                <input type="text" name="last_name" value="<?php echo htmlspecialchars($last); ?>" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 outline-none font-semibold transition focus:ring-2 focus:ring-black">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-black uppercase text-gray-400 tracking-widest">Date of Birth</label>
                                <input type="date" name="dob" value="<?php echo $user['dob']; ?>" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 outline-none font-semibold transition focus:ring-2 focus:ring-black">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-black uppercase text-gray-400 tracking-widest">Country</label>
                                <select name="country" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 outline-none font-semibold transition focus:ring-2 focus:ring-black appearance-none">
                                    <option value="India" <?php if($user['country'] == 'India') echo 'selected'; ?>>India</option>
                                    <option value="USA" <?php if($user['country'] == 'USA') echo 'selected'; ?>>USA</option>
                                    <option value="UK" <?php if($user['country'] == 'UK') echo 'selected'; ?>>UK</option>
                                </select>
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-[11px] font-black uppercase text-gray-400 tracking-widest">Phone Number</label>
                                <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 outline-none font-semibold transition focus:ring-2 focus:ring-black">
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit" name="save_changes" class="bg-black text-white px-10 py-5 rounded-[1.5rem] font-bold shadow-2xl hover:bg-gray-800 transition-all active:scale-95">
                                SAVE CHANGES
                            </button>
                        </div>
                    </form>
                </div>

                <div id="security" class="tab-content">
                    <form method="POST" class="max-w-md space-y-10">
                        <div class="space-y-2">
                            <label class="text-[11px] font-black uppercase text-gray-400 tracking-widest">Current Password</label>
                            <input type="password" name="current_password" placeholder="Verify current password" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 outline-none font-semibold" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-black uppercase text-gray-400 tracking-widest">New Password</label>
                            <input type="password" name="new_password" placeholder="Enter new password" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 outline-none font-semibold" required>
                        </div>
                        <div class="pt-6">
                            <button type="submit" name="update_pass" class="w-full bg-black text-white px-10 py-5 rounded-[1.5rem] font-bold">UPDATE SECURITY</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function openTab(evt, tabName) {
            const contents = document.getElementsByClassName("tab-content");
            for (let i = 0; i < contents.length; i++) contents[i].classList.remove("active");
            const btns = document.getElementsByClassName("tab-btn");
            for (let i = 0; i < btns.length; i++) btns[i].classList.remove("active-tab");
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.classList.add("active-tab");
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('preview').src = reader.result;
            }
            if(event.target.files[0]) reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>