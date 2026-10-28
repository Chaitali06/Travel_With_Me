<?php  
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("inc/conn.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (isset($_POST['update'])) {
    $menu_name   = mysqli_real_escape_string($conn, trim($_POST['menu_name']));
    $menu_parent = isset($_POST['menu_parent']) && is_numeric($_POST['menu_parent']) ? (int)$_POST['menu_parent'] : 0;
    $menu_type   = mysqli_real_escape_string($conn, $_POST['menu_type']);
    $menu_url    = mysqli_real_escape_string($conn, trim($_POST['menu_url']));
    $menu_order  = isset($_POST['menu_order']) && is_numeric($_POST['menu_order']) ? (int)$_POST['menu_order'] : 0;

    $query = "UPDATE menu SET menu_name = '$menu_name', menu_parent = $menu_parent, menu_type = '$menu_type', menu_url = '$menu_url', menu_order = $menu_order WHERE id = $id";
    $data = mysqli_query($conn, $query);

    if ($data) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Menu item updated successfully!'];
        header("Location: menu.php");
        exit();
    } else {
        $error = "Failed to update record. Please try again.";
    }
}

$sql = "SELECT * FROM menu WHERE id = $id";
$rs = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($rs);

include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 650px; margin: 0 auto;">
    <div>
        <h4 class="fw-bold text-dark mb-1">Edit Menu Item</h4>
        <p class="text-muted small mb-0">Update menu title, link, or position</p>
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
            <input type="text" class="form-control rounded-3 py-2" name="menu_name" value="<?php echo isset($row['menu_name']) ? htmlspecialchars($row['menu_name']) : ''; ?>" required>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold text-secondary small">Parent Category</label>
                <select name="menu_parent" class="form-select rounded-3 py-2">
                    <option value="0" <?php echo (isset($row['menu_parent']) && $row['menu_parent'] == 0) ? 'selected' : ''; ?>>None (Top Level)</option>
                    <?php 
                        $sql = "SELECT id, menu_name FROM menu WHERE menu_parent = 0 AND id != $id";
                        $parents = mysqli_query($conn, $sql);
                        while ($p = mysqli_fetch_array($parents)) {
                            $sel = ($row['menu_parent'] == $p['id']) ? 'selected' : '';
                            echo "<option value='{$p['id']}' $sel>" . htmlspecialchars($p['menu_name']) . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold text-secondary small">Menu Type</label>
                <select name="menu_type" class="form-select rounded-3 py-2">
                    <option value="Menu" <?php echo (isset($row['menu_type']) && $row['menu_type'] === 'Menu') ? 'selected' : ''; ?>>Standard Menu</option>
                    <option value="Submenu" <?php echo (isset($row['menu_type']) && $row['menu_type'] === 'Submenu') ? 'selected' : ''; ?>>Submenu Item</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">URL / Destination Link <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-3 py-2" name="menu_url" value="<?php echo isset($row['menu_url']) ? htmlspecialchars($row['menu_url']) : ''; ?>" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small">Display Order</label>
            <select name="menu_order" class="form-select rounded-3 py-2">
                <?php for ($i = 0; $i <= 10; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php echo (isset($row['menu_order']) && $row['menu_order'] == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <button class="btn btn-primary rounded-pill px-4 py-2 w-100 fw-semibold shadow-sm" type="submit" name="update">
            <i class="ri-check-line me-1"></i> Update Menu Item
        </button>
    </form>
</div>

<?php include("inc/footer.php"); ?>