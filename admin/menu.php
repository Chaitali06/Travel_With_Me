<?php 
include("inc/conn.php");
include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Navigation Menu Items</h3>
        <p class="text-muted small mb-0">Manage website navigation links and ordering</p>
    </div>
    <a href="menu_insert.php" class="btn btn-primary rounded-pill px-4 shadow-sm d-flex align-items-center gap-2">
        <i class="ri-add-line fs-5"></i> Add New Menu
    </a>
</div>

<div class="card admin-card p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th width="8%">ID</th>
                    <th width="12%">Date</th>
                    <th width="20%">Menu Name</th>
                    <th width="12%">Parent ID</th>
                    <th width="12%">Type</th>
                    <th width="16%">URL</th>
                    <th width="8%">Order</th>
                    <th width="12%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql = "SELECT * FROM menu ORDER BY menu_order ASC, id ASC";
                    $rs = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($rs) > 0) {
                        while ($row = mysqli_fetch_array($rs)) {
                            $typeBadge = ($row["menu_type"] === 'Submenu') ? 'bg-secondary' : 'bg-primary';
                            echo "<tr>
                                <td><span class='badge bg-light text-dark border'>#" . $row["id"] . "</span></td>
                                <td class='text-muted small'>" . htmlspecialchars($row["date"]) . "</td>
                                <td><span class='fw-semibold text-dark'>" . htmlspecialchars($row["menu_name"]) . "</span></td>
                                <td><span class='text-muted'>" . (int)$row["menu_parent"] . "</span></td>
                                <td><span class='badge {$typeBadge} text-white rounded-pill px-3 py-1'>" . htmlspecialchars($row["menu_type"]) . "</span></td>
                                <td><code class='text-primary small'>" . htmlspecialchars($row["menu_url"]) . "</code></td>
                                <td><span class='badge bg-light text-secondary border'>" . (int)$row["menu_order"] . "</span></td>
                                <td>
                                    <div class='d-flex gap-2'>
                                        <a href='menu_update.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline-primary rounded-pill px-3 d-inline-flex align-items-center gap-1'>
                                            <i class='ri-edit-line'></i> Edit
                                        </a>
                                        <a href='menu_delete.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline-danger rounded-pill px-3 d-inline-flex align-items-center gap-1' onclick='return checkdelete()'>
                                            <i class='ri-delete-bin-line'></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center py-4 text-muted'>No menu items found. Click 'Add New Menu' to create one.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function checkdelete() {
    return confirm('Are you sure you want to delete this menu item?');
}
</script>

<?php  
include("inc/footer.php");
?>