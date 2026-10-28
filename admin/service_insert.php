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

    $service_heading = mysqli_real_escape_string($conn, trim($_POST["service_heading"]));
    $service_info    = mysqli_real_escape_string($conn, trim($_POST["service_info"]));
    $title           = mysqli_real_escape_string($conn, trim($_POST["title"]));
    $service_desc    = mysqli_real_escape_string($conn, trim($_POST["service_desc"]));
    $date            = mysqli_real_escape_string($conn, $_POST["date"]);

    $sql = "INSERT INTO service(img, service_heading, service_info, title, service_desc, date) VALUES ('$db_path', '$service_heading', '$service_info', '$title', '$service_desc', '$date')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'New service created successfully!'];
        header("Location: service_table.php");
        exit();
    } else {
        $error = "Failed to add service. Please try again.";
    }
}

include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 700px; margin: 0 auto;">
    <div>
        <h4 class="fw-bold text-dark mb-1">Add Service Offering</h4>
        <p class="text-muted small mb-0">Create a new service card or offering description</p>
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
            <label class="form-label fw-semibold text-secondary small">Service Image / Icon <span class="text-danger">*</span></label>
            <input class="form-control rounded-3 py-2" type="file" name="uploadfile" accept="image/*" required onchange="previewImage(event)">

            <!-- Live Image Preview Container -->
            <div id="imagePreviewBox" class="mt-3 text-center d-none p-3 border rounded-3 bg-light">
                <p class="small text-muted mb-2">Live Selected Preview:</p>
                <img id="previewImg" src="#" alt="Preview" class="rounded-3 shadow-sm" style="max-height: 180px; max-width: 100%; object-fit: cover;">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Service Title <span class="text-danger">*</span></label>
            <input class="form-control rounded-3 py-2" type="text" name="title" placeholder="e.g. Flight Booking, Hotel Reservations" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small">Service Description <span class="text-danger">*</span></label>
            <textarea class="form-control rounded-3 py-2" name="service_desc" rows="3" placeholder="Describe the service in detail..." required></textarea>
        </div>

        <hr class="my-4 text-secondary opacity-25">

        <h6 class="text-primary fw-bold mb-3"><i class="ri-information-line me-1"></i> Section Intro Banner (Optional)</h6>

        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Service Section Heading</label>
            <input class="form-control rounded-3 py-2" type="text" name="service_heading" placeholder="e.g. What We Offer">
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small">Service Section Subtitle / Intro</label>
            <textarea class="form-control rounded-3 py-2" name="service_info" rows="2" placeholder="Introductory paragraph for services page..."></textarea>
        </div>

        <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">

        <button class="btn btn-primary rounded-pill px-4 py-2 w-100 fw-semibold shadow-sm" type="submit" name="add">
            <i class="ri-check-line me-1"></i> Save Service Offering
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