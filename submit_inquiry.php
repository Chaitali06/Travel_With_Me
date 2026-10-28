<?php
require_once("admin/inc/conn.php");

$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
    || isset($_POST['is_ajax'])
    || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        exit;
    }
    header('Location: index.php');
    exit;
}

$name = isset($_POST['name']) ? trim(mysqli_real_escape_string($conn, $_POST['name'])) : '';
$email = isset($_POST['email']) ? trim(mysqli_real_escape_string($conn, $_POST['email'])) : '';
$phone = isset($_POST['phone']) ? trim(mysqli_real_escape_string($conn, $_POST['phone'])) : '';
$type = isset($_POST['type']) ? trim(mysqli_real_escape_string($conn, $_POST['type'])) : 'Inquiry';
$tour_name = isset($_POST['tour_name']) ? trim(mysqli_real_escape_string($conn, $_POST['tour_name'])) : '';
$travelers = isset($_POST['travelers']) ? (int)$_POST['travelers'] : 1;
if ($travelers < 1) $travelers = 1;
$travel_date = isset($_POST['travel_date']) ? trim(mysqli_real_escape_string($conn, $_POST['travel_date'])) : '';
$message = isset($_POST['message']) ? trim(mysqli_real_escape_string($conn, $_POST['message'])) : '';

// Validation
if (empty($name) || empty($email)) {
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Please fill in both your name and email address.']);
        exit;
    }
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'contact.php') . '?status=error_missing');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Please enter a valid email address.']);
        exit;
    }
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'contact.php') . '?status=error_email');
    exit;
}

$sql = "INSERT INTO inquiries (type, name, email, phone, tour_name, travelers, travel_date, message, status, created_at)
        VALUES ('$type', '$name', '$email', '$phone', '$tour_name', $travelers, '$travel_date', '$message', 'New', NOW())";

if (mysqli_query($conn, $sql)) {
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success', 
            'message' => 'Thank you! Your request has been received. Our travel specialists will get in touch with you shortly.'
        ]);
        exit;
    }
    $ref = $_SERVER['HTTP_REFERER'] ?? 'contact.php';
    $separator = (strpos($ref, '?') !== false) ? '&' : '?';
    header('Location: ' . $ref . $separator . 'status=success');
    exit;
} else {
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'A database error occurred. Please try again.']);
        exit;
    }
    $ref = $_SERVER['HTTP_REFERER'] ?? 'contact.php';
    $separator = (strpos($ref, '?') !== false) ? '&' : '?';
    header('Location: ' . $ref . $separator . 'status=error_db');
    exit;
}
