<?php 
include("inc/conn.php");
include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Features Section</h3>
        <p class="text-muted small mb-0">Manage tour category highlights and icons shown on the homepage</p>
    </div>
    <a href="feature_insert.php" class="btn btn-primary rounded-pill px-4 shadow-sm d-flex align-items-center gap-2">
        <i class="ri-add-line fs-5"></i> Add New Feature
    </a>
</div>

<div class="card admin-card p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th width="8%">ID</th>
                    <th width="15%">Date</th>
                    <th width="20%">Image Preview</th>
                    <th width="37%">Feature Title / Heading</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql = "SELECT * FROM feature ORDER BY id DESC";
                    $rs = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($rs) > 0) {
                        while ($row = mysqli_fetch_array($rs)) {
                            $imgSrc = !empty($row["img"]) ? "../" . htmlspecialchars($row["img"]) : "../img/placeholder.jpg";
                            echo "<tr>
                                <td><span class='badge bg-light text-dark border'>#" . $row["id"] . "</span></td>
                                <td class='text-muted small'>" . htmlspecialchars($row["date"]) . "</td>
                                <td>
                                    <img src='{$imgSrc}' class='img-thumb-preview' alt='feature'>
                                </td>
                                <td><strong class='text-dark'>" . htmlspecialchars($row["h4"]) . "</strong></td>
                                <td>
                                    <div class='d-flex gap-2'>
                                        <a href='feature_update.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline-primary rounded-pill px-3 d-inline-flex align-items-center gap-1'>
                                            <i class='ri-edit-line'></i> Edit
                                        </a>
                                        <a href='feature_delete.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline-danger rounded-pill px-3 d-inline-flex align-items-center gap-1' onclick='return checkdelete()'>
                                            <i class='ri-delete-bin-line'></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center py-4 text-muted'>No features found. Click 'Add New Feature' to create one.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function checkdelete() {
    return confirm('Are you sure you want to delete this feature?');
}
</script>

<?php include("inc/footer.php"); ?>