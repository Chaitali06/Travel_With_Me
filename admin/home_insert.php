<?php  
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("inc/conn.php");

if (isset($_POST['add'])) {
    $h5   = mysqli_real_escape_string($conn, trim($_POST["h5"]));
    $h1   = mysqli_real_escape_string($conn, trim($_POST["h1"]));
    $para = mysqli_real_escape_string($conn, trim($_POST["para"]));
    $btn  = mysqli_real_escape_string($conn, trim($_POST["btn"]));
    $date = mysqli_real_escape_string($conn, $_POST["date"]);

    $sql = "INSERT INTO home (h5, h1, para, btn, date) VALUES ('$h5', '$h1', '$para', '$btn', '$date')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Home content added successfully!'];
        header("Location: home.php");
        exit();
    } else {
        $error = "Failed to add home content. Please try again.";
    }
}

include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 700px; margin: 0 auto;">
    <div>
        <h4 class="fw-bold text-dark mb-1">Add Home Banner Content</h4>
        <p class="text-muted small mb-0">Customize hero titles and button labels</p>
    </div>
    <a href="home.php" class="btn btn-outline-secondary rounded-pill px-3 py-1 small d-flex align-items-center gap-1">
        <i class="ri-arrow-left-line"></i> Back to List
    </a>
</div>

<div class="card admin-card p-4 p-md-5 mx-auto" style="max-width: 700px;">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger mb-4"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="#" method="POST">
        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Subtitle / Tagline (H5)</label>
            <input type="text" class="form-control rounded-3 py-2" name="h5" placeholder="e.g. LET'S GO, ADVENTURE AWAITS">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Main Headline (H1) <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-3 py-2" name="h1" placeholder="e.g. Planning Your Own Travel" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Hero Description Paragraph <span class="text-danger">*</span></label>
            <textarea class="form-control rounded-3 py-2" name="para" rows="4" placeholder="Enter travel description..." required></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small">Call-To-Action Button Text</label>
            <input type="text" class="form-control rounded-3 py-2" name="btn" placeholder="e.g. Book a Trip, Explore Now">
        </div>

        <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">

        <button class="btn btn-primary rounded-pill px-4 py-2 w-100 fw-semibold shadow-sm" type="submit" name="add">
            <i class="ri-check-line me-1"></i> Save Home Content
        </button>
    </form>
</div>

<?php include("inc/footer.php"); ?>