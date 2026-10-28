<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("inc/conn.php");

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $sql = "DELETE FROM inquiries WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => "Inquiry #{$id} has been permanently deleted."
        ];
    } else {
        $_SESSION['flash'] = [
            'type' => 'danger',
            'message' => "Failed to delete inquiry: " . mysqli_error($conn)
        ];
    }
}

$ref = $_SERVER['HTTP_REFERER'] ?? 'inquiries.php';
header("Location: " . $ref);
exit;
