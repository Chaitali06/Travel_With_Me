<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('inc/conn.php');

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$data = ($id > 0) ? mysqli_query($conn, "DELETE FROM tour WHERE id = $id") : false;

if ($data) {
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Tour destination deleted successfully!'];
} else {
    $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Failed to delete tour destination.'];
}

header("Location: tour.php");
exit();
