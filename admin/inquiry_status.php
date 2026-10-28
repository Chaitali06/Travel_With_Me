<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("inc/conn.php");

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $status = isset($_POST['status']) ? trim(mysqli_real_escape_string($conn, $_POST['status'])) : '';

    $allowedStatuses = ['New', 'In Progress', 'Confirmed', 'Closed'];

    if ($id > 0 && in_array($status, $allowedStatuses)) {
        $sql = "UPDATE inquiries SET status = '$status' WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => "Inquiry #{$id} status updated to '{$status}'."
            ];
        } else {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => "Error updating inquiry status: " . mysqli_error($conn)
            ];
        }
    }
}

$ref = $_SERVER['HTTP_REFERER'] ?? 'inquiries.php';
header("Location: " . $ref);
exit;
