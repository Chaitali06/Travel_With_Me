<?php  
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("inc/conn.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (isset($_POST['update'])) {
    $img_update = "";
    if (isset($_FILES["uploadfile"]) && $_FILES["uploadfile"]["error"] === UPLOAD_ERR_OK && !empty($_FILES["uploadfile"]["name"])) {
        $filename = basename($_FILES["uploadfile"]["name"]);
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder   = "../img/" . $filename;
        if (move_uploaded_file($tempname, $folder)) {
            $db_path = mysqli_real_escape_string($conn, "img/" . $filename);
            $img_update = ", img = '$db_path'";
        }
    }

    $h5        = mysqli_real_escape_string($conn, trim($_POST['h5']));
    $h2        = mysqli_real_escape_string($conn, trim($_POST['h2']));
    $para      = mysqli_real_escape_string($conn, trim($_POST['para']));
    $head1     = mysqli_real_escape_string($conn, trim($_POST['head1']));
    $paragraph = mysqli_real_escape_string($conn, trim($_POST['paragraph']));

    $query = "UPDATE about SET h5 = '$h5', h2 = '$h2', para = '$para', head1 = '$head1', paragraph = '$paragraph' $img_update WHERE id = $id";
    $data = mysqli_query($conn, $query);

    if ($data) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'About record updated successfully!'];
        header("Location: about_table.php");
        exit();
    } else {
        $error = "Failed to update about record. Please try again.";
    }
}

$sql = "SELECT * FROM about WHERE id = $id";
$rs = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($rs);

include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 700px; margin: 0 auto;">
    <div>
        <h4 class="fw-bold text-dark mb-1">Edit About / Team Member</h4>
        <p class="text-muted small mb-0">Update profile photo, role, or company story</p>
    </div>
    <a href="about_table.php" class="btn btn-outline-secondary rounded-pill px-3 py-1 small d-flex align-items-center gap-1">
        <i class="ri-arrow-left-line"></i> Back to List
    </a>
</div>

<div class="card admin-card p-4 p-md-5 mx-auto" style="max-width: 700px;">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger mb-4"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="#" method="POST" enctype="multipart/form-data">
        <h6 class="text-primary fw-bold mb-3"><i class="ri-team-line me-1"></i> Team Member Info</h6>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small d-block">Current Active Photo</label>
            <div class="p-3 bg-light border rounded-3 text-center mb-3">
                <?php if (!empty($row['img'])): ?>
                    <img src="../<?php echo htmlspecialchars($row['img']); ?>" alt="Current Member" class="rounded-3 shadow-sm" style="max-height: 160px; max-width: 100%; object-fit: cover;">
                    <div class="text-muted small mt-2"><code><?php echo htmlspecialchars($row['img']); ?></code></div>
                <?php else: ?>
                    <span class="text-muted small">No photo currently assigned.</span>
                <?php endif; ?>
            </div>

            <label class="form-label fw-semibold text-secondary small">Choose Replacement Photo (Optional)</label>
            <input class="form-control rounded-3 py-2" type="file" name="uploadfile" accept="image/*" onchange="previewImage(event)">

            <!-- Live Preview Container -->
            <div id="imagePreviewBox" class="mt-3 text-center d-none p-3 border rounded-3 bg-light">
                <p class="small text-muted mb-2">New Selection Preview:</p>
                <img id="previewImg" src="#" alt="New Preview" class="rounded-3 shadow-sm" style="max-height: 160px; max-width: 100%; object-fit: cover;">
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold text-secondary small">Team Member Name</label>
                <input class="form-control rounded-3 py-2" type="text" name="head1" value="<?php echo isset($row['head1']) ? htmlspecialchars($row['head1']) : ''; ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold text-secondary small">Team Member Role / Title</label>
                <input class="form-control rounded-3 py-2" type="text" name="paragraph" value="<?php echo isset($row['paragraph']) ? htmlspecialchars($row['paragraph']) : ''; ?>">
            </div>
        </div>

        <hr class="my-4 text-secondary opacity-25">

        <h6 class="text-primary fw-bold mb-3"><i class="ri-book-open-line me-1"></i> Our Story Content (Optional)</h6>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold text-secondary small">Story Subtitle (H5)</label>
                <input class="form-control rounded-3 py-2" type="text" name="h5" value="<?php echo isset($row['h5']) ? htmlspecialchars($row['h5']) : ''; ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold text-secondary small">Story Headline (H2)</label>
                <input class="form-control rounded-3 py-2" type="text" name="h2" value="<?php echo isset($row['h2']) ? htmlspecialchars($row['h2']) : ''; ?>">
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small">Story Paragraph</label>
            <textarea class="form-control rounded-3 py-2" name="para" rows="3"><?php echo isset($row['para']) ? htmlspecialchars($row['para']) : ''; ?></textarea>
        </div>

        <button class="btn btn-primary rounded-pill px-4 py-2 w-100 fw-semibold shadow-sm" type="submit" name="update">
            <i class="ri-check-line me-1"></i> Update Content
        </button>
    </form>
</div>

<script>
function previewImage(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreviewBox').classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php include("inc/footer.php"); ?>