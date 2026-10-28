<?php  
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("inc/conn.php");

if (isset($_POST['add'])) {
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $menu_name = mysqli_real_escape_string($conn, trim($_POST['menu_name']));
    $menu_parent = isset($_POST['menu_parent']) && is_numeric($_POST['menu_parent']) ? (int)$_POST['menu_parent'] : 0;
    $menu_type = mysqli_real_escape_string($conn, $_POST['menu_type']);
    $menu_url = mysqli_real_escape_string($conn, trim($_POST['menu_url']));
    $menu_order = isset($_POST['menu_order']) && is_numeric($_POST['menu_order']) ? (int)$_POST['menu_order'] : 0;

    $sql = "INSERT INTO menu (menu_name, menu_parent, menu_type, menu_url, menu_order, date) VALUES ('$menu_name', $menu_parent, '$menu_type', '$menu_url', $menu_order, '$date')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'New menu item created successfully!'];
        header("Location: menu.php");
        exit();
    } else {
        $error = "Failed to insert record. Please try again.";
    }
}

include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 650px; margin: 0 auto;">
    <div>
        <h4 class="fw-bold text-dark mb-1">Add Menu Item</h4>
        <p class="text-muted small mb-0">Create a new link in your site navigation</p>
    </div>
    <a href="menu.php" class="btn btn-outline-secondary rounded-pill px-3 py-1 small d-flex align-items-center gap-1">
        <i class="ri-arrow-left-line"></i> Back to List
    </a>
</div>

<div class="card admin-card p-4 p-md-5 mx-auto" style="max-width: 650px;">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger mb-4"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="#" method="POST">
        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Menu Label / Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-3 py-2" name="menu_name" placeholder="e.g. Destinations, Services" required>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold text-secondary small">Parent Category</label>
                <select name="menu_parent" class="form-select rounded-3 py-2">
                    <option value="0">None (Top Level)</option>
                    <?php 
                        $sql = "SELECT id, menu_name FROM menu WHERE menu_parent = 0";
                        $rs = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($rs)) {
                            echo "<option value='{$row['id']}'>" . htmlspecialchars($row['menu_name']) . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold text-secondary small">Menu Type</label>
                <select name="menu_type" class="form-select rounded-3 py-2">
                    <option value="Menu">Standard Menu</option>
                    <option value="Submenu">Submenu Item</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">URL / Destination Link <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-3 py-2" name="menu_url" placeholder="e.g. index.php, tour.php, #about" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small">Display Order</label>
            <select name="menu_order" class="form-select rounded-3 py-2">
                <option value="0">0 (Default)</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">

        <button class="btn btn-primary rounded-pill px-4 py-2 w-100 fw-semibold shadow-sm" type="submit" name="add">
            <i class="ri-check-line me-1"></i> Save Menu Item
        </button>
    </form>
</div>

<?php include("inc/footer.php"); ?>