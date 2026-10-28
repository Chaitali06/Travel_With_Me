<?php  
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("inc/conn.php");

if (isset($_POST['add'])) {
    $db_path = "";
    if (isset($_FILES["uploadfile"]) && $_FILES["uploadfile"]["error"] === UPLOAD_ERR_OK && !empty($_FILES["uploadfile"]["name"])) {
        $filename = basename($_FILES["uploadfile"]["name"]);
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../img/" . $filename;
        if (move_uploaded_file($tempname, $folder)) {
            $db_path = "img/" . $filename;
        }
    }

    $h4 = mysqli_real_escape_string($conn, trim($_POST["h4"]));
    $date = mysqli_real_escape_string($conn, $_POST["date"]);

    $sql = "INSERT INTO feature(img, h4, date) VALUES ('$db_path', '$h4', '$date')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'New feature added successfully!'];
        header("Location: feature.php");
        exit();
    } else {
        $error = "Failed to add feature. Please try again.";
    }
}

include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 650px; margin: 0 auto;">
    <div>
        <h4 class="fw-bold text-dark mb-1">Add Feature Category</h4>
        <p class="text-muted small mb-0">Upload an icon or photo and specify the tour category title</p>
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
            <label class="form-label fw-semibold text-secondary small">Feature Image <span class="text-danger">*</span></label>
            <input class="form-control rounded-3 py-2" type="file" name="uploadfile" id="featureImgInput" accept="image/*" required onchange="previewImage(event)">
            
            <!-- Live Image Preview Container -->
            <div id="imagePreviewBox" class="mt-3 text-center d-none p-3 border rounded-3 bg-light">
                <p class="small text-muted mb-2">Live Selected Preview:</p>
                <img id="previewImg" src="#" alt="Preview" class="rounded-3 shadow-sm" style="max-height: 180px; max-width: 100%; object-fit: cover;">
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small">Feature Heading / Title <span class="text-danger">*</span></label>
            <input class="form-control rounded-3 py-2" type="text" name="h4" placeholder="e.g. Ski Tours, Mountain Tours, Beach Tours" required>
        </div>

        <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">

        <button class="btn btn-primary rounded-pill px-4 py-2 w-100 fw-semibold shadow-sm" type="submit" name="add">
            <i class="ri-check-line me-1"></i> Save Feature
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