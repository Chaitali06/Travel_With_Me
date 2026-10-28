<?php  
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("inc/conn.php");

if (isset($_POST['add'])) {
    $h3   = mysqli_real_escape_string($conn, trim($_POST["h3"]));
    $info = mysqli_real_escape_string($conn, trim($_POST["info"]));
    $date = mysqli_real_escape_string($conn, $_POST["date"]);

    $sql = "INSERT INTO contact(h3, info, date) VALUES ('$h3', '$info', '$date')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Contact detail created successfully!'];
        header("Location: contact_table.php");
        exit();
    } else {
        $error = "Failed to add contact info. Please try again.";
    }
}

include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 650px; margin: 0 auto;">
    <div>
        <h4 class="fw-bold text-dark mb-1">Add Contact Channel</h4>
        <p class="text-muted small mb-0">Add phone, email address, or office location</p>
    </div>
    <a href="contact_table.php" class="btn btn-outline-secondary rounded-pill px-3 py-1 small d-flex align-items-center gap-1">
        <i class="ri-arrow-left-line"></i> Back to List
    </a>
</div>

<div class="card admin-card p-4 p-md-5 mx-auto" style="max-width: 650px;">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger mb-4"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="#" method="POST">
        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Channel / Type Heading <span class="text-danger">*</span></label>
            <input class="form-control rounded-3 py-2" type="text" name="h3" placeholder="e.g. Mobile Number, Email Address, Office Location" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small">Contact Information Details <span class="text-danger">*</span></label>
            <input class="form-control rounded-3 py-2" type="text" name="info" placeholder="e.g. +1 234 567 890 or info@travelsite.com" required>
        </div>

        <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">

        <button class="btn btn-primary rounded-pill px-4 py-2 w-100 fw-semibold shadow-sm" type="submit" name="add">
            <i class="ri-check-line me-1"></i> Save Contact Detail
        </button>
    </form>
</div>

<?php include("inc/footer.php"); ?>