<?php
session_start();
include 'db_connect.php';

// Helper Function: Redirection handle karne ke liye
function redirectUser() {
    if (isset($_SESSION['redirect_url'])) {
        $destination = $_SESSION['redirect_url'];
        unset($_SESSION['redirect_url']); // Clear taaki hamesha wahi na bhejta rahe
        header("Location: " . $destination);
    } else {
        header("Location: travel.php"); // Default agar user direct login/signup kiya ho
    }
    exit();
}

// --- 1. SIGNUP LOGIC ---
if (isset($_POST['signup_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $raw_password = $_POST['signup_password_unique']; 
    $pass = password_hash($raw_password, PASSWORD_DEFAULT);

    $checkEmail = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
    if(mysqli_num_rows($checkEmail) > 0) {
        header("Location: signup.php?error=email_taken");
        exit();
    } else {
        $query = "INSERT INTO users (full_name, email, password) VALUES ('$name', '$email', '$pass')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['user_name'] = $name;
            
            // Yahan Redirect logic call ho raha hai
            redirectUser();
        } else {
            echo "Database Error: " . mysqli_error($conn);
        }
    }
}

// --- 2. LOGIN LOGIC ---
if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($pass, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['full_name'];
            
            // Yahan Redirect logic call ho raha hai
            redirectUser();
        } else {
            header("Location: signup.php?error=wrong_pass");
            exit();
        }
    } else {
        header("Location: signup.php?error=user_not_found");
        exit();
    }
}

// --- 3. FORGOT PASSWORD LOGIC ---
if (isset($_POST['forgot_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['reset_email']);

    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    if(mysqli_num_rows($check) > 0) {
        header("Location: signup.php?status=reset_sent&email=" . urlencode($email));
        exit();
    } else {
        header("Location: signup.php?error=user_not_found");
        exit();
    }
}

// --- 4. NEW PASSWORD UPDATE LOGIC ---
if (isset($_POST['update_pass_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $new_pass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $update = "UPDATE users SET password='$new_pass' WHERE email='$email'";
    if(mysqli_query($conn, $update)) {
        header("Location: signup.php?status=pass_updated");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Default safety redirect
header("Location: signup.php");
exit();
?>