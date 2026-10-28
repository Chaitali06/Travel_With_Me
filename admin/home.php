<?php 
include("inc/conn.php");
include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Home Hero Section</h3>
        <p class="text-muted small mb-0">Manage main homepage banner titles, text, and call-to-action buttons</p>
    </div>
    <a href="home_insert.php" class="btn btn-primary rounded-pill px-4 shadow-sm d-flex align-items-center gap-2">
        <i class="ri-add-line fs-5"></i> Add New Content
    </a>
</div>

<div class="card admin-card p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th width="6%">ID</th>
                    <th width="12%">Date</th>
                    <th width="15%">Small Heading (H5)</th>
                    <th width="20%">Main Heading (H1)</th>
                    <th width="27%">Paragraph</th>
                    <th width="10%">Button</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql = "SELECT * FROM home ORDER BY id DESC";
                    $rs = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($rs) > 0) {
                        while ($row = mysqli_fetch_array($rs)) {
                            echo "<tr>
                                <td><span class='badge bg-light text-dark border'>#" . $row["id"] . "</span></td>
                                <td class='text-muted small'>" . htmlspecialchars($row["date"]) . "</td>
                                <td><span class='badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25'>" . htmlspecialchars($row["h5"]) . "</span></td>
                                <td><strong class='text-dark'>" . htmlspecialchars($row["h1"]) . "</strong></td>
                                <td><span class='text-secondary small d-inline-block text-truncate' style='max-width: 250px;'>" . htmlspecialchars($row["para"]) . "</span></td>
                                <td><span class='badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25'>" . htmlspecialchars($row["btn"]) . "</span></td>
                                <td>
                                    <div class='d-flex gap-2'>
                                        <a href='home_update.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline-primary rounded-pill px-3 d-inline-flex align-items-center gap-1'>
                                            <i class='ri-edit-line'></i> Edit
                                        </a>
                                        <a href='home_delete.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline-danger rounded-pill px-3 d-inline-flex align-items-center gap-1' onclick='return checkdelete()'>
                                            <i class='ri-delete-bin-line'></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center py-4 text-muted'>No home content found. Click 'Add New Content' to create one.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function checkdelete() {
    return confirm('Are you sure you want to delete this home content record?');
}
</script>

<?php include("inc/footer.php"); ?>