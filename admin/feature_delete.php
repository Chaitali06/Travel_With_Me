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
$data = ($id > 0) ? mysqli_query($conn, "DELETE FROM feature WHERE id = $id") : false;

if ($data) {
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Feature deleted successfully!'];
} else {
    $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Failed to delete feature.'];
}

header("Location: feature.php");
exit();
