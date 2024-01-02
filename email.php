<?php
session_start();

// Check if the OTP is in the session
if (!isset($_SESSION['otp'])) {
    // Redirect back to the registration form if the OTP is not available
    header('Location: testing2.php');
    exit();
}

// Get the submitted OTP
$submittedOTP = filter_input(INPUT_POST, 'otp', FILTER_SANITIZE_NUMBER_INT);

// Compare with the stored OTP in the session
if ($_SESSION['otp'] == $submittedOTP) {
    // OTP is valid, perform user registration or other actions
    // You may want to unset($_SESSION['otp']) after successful verification
    unset($_SESSION['otp']);

    echo json_encode(['success' => true, 'message' => 'OTP verified successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid OTP']);
}
