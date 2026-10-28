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

    $h4 = mysqli_real_escape_string($conn, trim($_POST['h4']));

    $query = "UPDATE feature SET h4 = '$h4' $img_update WHERE id = $id";
    $data = mysqli_query($conn, $query);

    if ($data) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Feature updated successfully!'];
        header("Location: feature.php");
        exit();
    } else {
        $error = "Failed to update feature. Please try again.";
    }
}

$sql = "SELECT * FROM feature WHERE id = $id";
$rs = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($rs);

include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 650px; margin: 0 auto;">
    <div>
        <h4 class="fw-bold text-dark mb-1">Edit Feature Category</h4>
        <p class="text-muted small mb-0">Update feature image or category title</p>
    </div>
    <a href="feature.php" class="btn btn-outline-secondary rounded-pill px-3 py-1 small d-flex align-items-center gap-1">
        <i class="ri-arrow-left-line"></i> Back to List
    </a>
</div>

<div class="card admin-card p-4 p-md-5 mx-auto" style="max-width: 650px;">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger mb-4"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small d-block">Current Active Image</label>
            <div class="p-3 bg-light border rounded-3 text-center mb-3">
                <?php if (!empty($row['img'])): ?>
                    <img src="../<?php echo htmlspecialchars($row['img']); ?>" alt="Current Feature" class="rounded-3 shadow-sm" style="max-height: 140px; max-width: 100%; object-fit: cover;">
                    <div class="text-muted small mt-2"><code><?php echo htmlspecialchars($row['img']); ?></code></div>
                <?php else: ?>
                    <span class="text-muted small">No image currently assigned.</span>
                <?php endif; ?>
            </div>

            <label class="form-label fw-semibold text-secondary small">Choose New Replacement Image (Optional)</label>
            <input class="form-control rounded-3 py-2" type="file" name="uploadfile" accept="image/*" onchange="previewImage(event)">

            <!-- Live Preview of New Selected Image -->
            <div id="imagePreviewBox" class="mt-3 text-center d-none p-3 border rounded-3 bg-light">
                <p class="small text-muted mb-2">New Selection Preview:</p>
                <img id="previewImg" src="#" alt="New Preview" class="rounded-3 shadow-sm" style="max-height: 140px; max-width: 100%; object-fit: cover;">
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small">Feature Heading / Title <span class="text-danger">*</span></label>
            <input class="form-control rounded-3 py-2" type="text" name="h4" value="<?php echo isset($row['h4']) ? htmlspecialchars($row['h4']) : ''; ?>" required>
        </div>

        <button class="btn btn-primary rounded-pill px-4 py-2 w-100 fw-semibold shadow-sm" type="submit" name="update">
            <i class="ri-check-line me-1"></i> Update Feature
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