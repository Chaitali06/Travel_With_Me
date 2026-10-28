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

    $h5   = mysqli_real_escape_string($conn, trim($_POST['h5']));
    $h2   = mysqli_real_escape_string($conn, trim($_POST['h2']));
    $para = mysqli_real_escape_string($conn, trim($_POST['para']));
    $btn  = mysqli_real_escape_string($conn, trim($_POST['btn']));

    $query = "UPDATE holiday SET h5 = '$h5', h2 = '$h2', para = '$para', btn = '$btn' $img_update WHERE id = $id";
    $data = mysqli_query($conn, $query);

    if ($data) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Holiday promotion updated successfully!'];
        header("Location: holiday.php");
        exit();
    } else {
        $error = "Failed to update holiday promotion. Please try again.";
    }
}

$sql = "SELECT * FROM holiday WHERE id = $id";
$rs = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($rs);

include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 700px; margin: 0 auto;">
    <div>
        <h4 class="fw-bold text-dark mb-1">Edit Holiday Promotion</h4>
        <p class="text-muted small mb-0">Update holiday imagery, titles, or descriptions</p>
    </div>
    <a href="holiday.php" class="btn btn-outline-secondary rounded-pill px-3 py-1 small d-flex align-items-center gap-1">
        <i class="ri-arrow-left-line"></i> Back to List
    </a>
</div>

<div class="card admin-card p-4 p-md-5 mx-auto" style="max-width: 700px;">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger mb-4"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small d-block">Current Active Image</label>
            <div class="p-3 bg-light border rounded-3 text-center mb-3">
                <?php if (!empty($row['img'])): ?>
                    <img src="../<?php echo htmlspecialchars($row['img']); ?>" alt="Current Holiday" class="rounded-3 shadow-sm" style="max-height: 160px; max-width: 100%; object-fit: cover;">
                    <div class="text-muted small mt-2"><code><?php echo htmlspecialchars($row['img']); ?></code></div>
                <?php else: ?>
                    <span class="text-muted small">No image currently assigned.</span>
                <?php endif; ?>
            </div>

            <label class="form-label fw-semibold text-secondary small">Choose Replacement Image (Optional)</label>
            <input class="form-control rounded-3 py-2" type="file" name="uploadfile" accept="image/*" onchange="previewImage(event)">

            <!-- Live Preview of New Selected Image -->
            <div id="imagePreviewBox" class="mt-3 text-center d-none p-3 border rounded-3 bg-light">
                <p class="small text-muted mb-2">New Selection Preview:</p>
                <img id="previewImg" src="#" alt="New Preview" class="rounded-3 shadow-sm" style="max-height: 160px; max-width: 100%; object-fit: cover;">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold text-secondary small">Subtitle / Location Tag (H5)</label>
                <input class="form-control rounded-3 py-2" type="text" name="h5" value="<?php echo isset($row['h5']) ? htmlspecialchars($row['h5']) : ''; ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold text-secondary small">Button Callout</label>
                <input class="form-control rounded-3 py-2" type="text" name="btn" value="<?php echo isset($row['btn']) ? htmlspecialchars($row['btn']) : ''; ?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Main Headline (H2) <span class="text-danger">*</span></label>
            <input class="form-control rounded-3 py-2" type="text" name="h2" value="<?php echo isset($row['h2']) ? htmlspecialchars($row['h2']) : ''; ?>" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small">Promotion Description Paragraph <span class="text-danger">*</span></label>
            <textarea class="form-control rounded-3 py-2" name="para" rows="4" required><?php echo isset($row['para']) ? htmlspecialchars($row['para']) : ''; ?></textarea>
        </div>

        <button class="btn btn-primary rounded-pill px-4 py-2 w-100 fw-semibold shadow-sm" type="submit" name="update">
            <i class="ri-check-line me-1"></i> Update Holiday Promotion
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