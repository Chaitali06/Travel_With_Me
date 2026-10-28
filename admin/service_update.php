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

    $service_heading = mysqli_real_escape_string($conn, trim($_POST['service_heading']));
    $service_info    = mysqli_real_escape_string($conn, trim($_POST['service_info']));
    $title           = mysqli_real_escape_string($conn, trim($_POST['title']));
    $service_desc    = mysqli_real_escape_string($conn, trim($_POST['service_desc']));

    $query = "UPDATE service SET service_heading = '$service_heading', service_info = '$service_info', title = '$title', service_desc = '$service_desc' $img_update WHERE id = $id";
    $data = mysqli_query($conn, $query);

    if ($data) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Service item updated successfully!'];
        header("Location: service_table.php");
        exit();
    } else {
        $error = "Failed to update service item. Please try again.";
    }
}

$sql = "SELECT * FROM service WHERE id = $id";
$rs = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($rs);

include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 700px; margin: 0 auto;">
    <div>
        <h4 class="fw-bold text-dark mb-1">Edit Service Offering</h4>
        <p class="text-muted small mb-0">Update service photo, title, or description</p>
    </div>
    <a href="service_table.php" class="btn btn-outline-secondary rounded-pill px-3 py-1 small d-flex align-items-center gap-1">
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
                    <img src="../<?php echo htmlspecialchars($row['img']); ?>" alt="Current Service" class="rounded-3 shadow-sm" style="max-height: 160px; max-width: 100%; object-fit: cover;">
                    <div class="text-muted small mt-2"><code><?php echo htmlspecialchars($row['img']); ?></code></div>
                <?php else: ?>
                    <span class="text-muted small">No image currently assigned.</span>
                <?php endif; ?>
            </div>

            <label class="form-label fw-semibold text-secondary small">Choose Replacement Image (Optional)</label>
            <input class="form-control rounded-3 py-2" type="file" name="uploadfile" accept="image/*" onchange="previewImage(event)">

            <!-- Live Preview Container -->
            <div id="imagePreviewBox" class="mt-3 text-center d-none p-3 border rounded-3 bg-light">
                <p class="small text-muted mb-2">New Selection Preview:</p>
                <img id="previewImg" src="#" alt="New Preview" class="rounded-3 shadow-sm" style="max-height: 160px; max-width: 100%; object-fit: cover;">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Service Title <span class="text-danger">*</span></label>
            <input class="form-control rounded-3 py-2" type="text" name="title" value="<?php echo isset($row['title']) ? htmlspecialchars($row['title']) : ''; ?>" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small">Service Description <span class="text-danger">*</span></label>
            <textarea class="form-control rounded-3 py-2" name="service_desc" rows="3" required><?php echo isset($row['service_desc']) ? htmlspecialchars($row['service_desc']) : ''; ?></textarea>
        </div>

        <hr class="my-4 text-secondary opacity-25">

        <h6 class="text-primary fw-bold mb-3"><i class="ri-information-line me-1"></i> Section Intro Banner (Optional)</h6>

        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Service Section Heading</label>
            <input class="form-control rounded-3 py-2" type="text" name="service_heading" value="<?php echo isset($row['service_heading']) ? htmlspecialchars($row['service_heading']) : ''; ?>">
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small">Service Section Subtitle / Intro</label>
            <textarea class="form-control rounded-3 py-2" name="service_info" rows="2"><?php echo isset($row['service_info']) ? htmlspecialchars($row['service_info']) : ''; ?></textarea>
        </div>

        <button class="btn btn-primary rounded-pill px-4 py-2 w-100 fw-semibold shadow-sm" type="submit" name="update">
            <i class="ri-check-line me-1"></i> Update Service Offering
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