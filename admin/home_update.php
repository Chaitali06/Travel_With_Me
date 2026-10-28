<?php  
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("inc/conn.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (isset($_POST['update'])) {
    $h5   = mysqli_real_escape_string($conn, trim($_POST['h5']));
    $h1   = mysqli_real_escape_string($conn, trim($_POST['h1']));
    $para = mysqli_real_escape_string($conn, trim($_POST['para']));
    $btn  = mysqli_real_escape_string($conn, trim($_POST['btn']));

    $query = "UPDATE home SET h5 = '$h5', h1 = '$h1', para = '$para', btn = '$btn' WHERE id = $id";
    $data = mysqli_query($conn, $query);

    if ($data) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Home content updated successfully!'];
        header("Location: home.php");
        exit();
    } else {
        $error = "Failed to update home content. Please try again.";
    }
}

$sql = "SELECT * FROM home WHERE id = $id";
$rs = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($rs);

include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 700px; margin: 0 auto;">
    <div>
        <h4 class="fw-bold text-dark mb-1">Edit Home Banner Content</h4>
        <p class="text-muted small mb-0">Update hero titles and description</p>
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
            <input type="text" class="form-control rounded-3 py-2" name="h5" value="<?php echo isset($row['h5']) ? htmlspecialchars($row['h5']) : ''; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Main Headline (H1) <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-3 py-2" name="h1" value="<?php echo isset($row['h1']) ? htmlspecialchars($row['h1']) : ''; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Hero Description Paragraph <span class="text-danger">*</span></label>
            <textarea class="form-control rounded-3 py-2" name="para" rows="4" required><?php echo isset($row['para']) ? htmlspecialchars($row['para']) : ''; ?></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small">Call-To-Action Button Text</label>
            <input type="text" class="form-control rounded-3 py-2" name="btn" value="<?php echo isset($row['btn']) ? htmlspecialchars($row['btn']) : ''; ?>">
        </div>

        <button class="btn btn-primary rounded-pill px-4 py-2 w-100 fw-semibold shadow-sm" type="submit" name="update">
            <i class="ri-check-line me-1"></i> Update Home Content
        </button>
    </form>
</div>

<?php include("inc/footer.php"); ?>