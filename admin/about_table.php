<?php 
include("inc/conn.php");
include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">About & Team Section</h3>
        <p class="text-muted small mb-0">Manage our story descriptions and team member profile cards</p>
    </div>
    <a href="about_insert.php" class="btn btn-primary rounded-pill px-4 shadow-sm d-flex align-items-center gap-2">
        <i class="ri-add-line fs-5"></i> Add New Member / Content
    </a>
</div>

<div class="card admin-card p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th width="6%">ID</th>
                    <th width="10%">Date</th>
                    <th width="12%">Photo</th>
                    <th width="16%">Member Name (Head1)</th>
                    <th width="16%">Role / Bio (Paragraph)</th>
                    <th width="16%">Story Subtitle (H5)</th>
                    <th width="14%">Story Title (H2)</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql = "SELECT * FROM about ORDER BY id DESC";
                    $rs = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($rs) > 0) {
                        while ($row = mysqli_fetch_array($rs)) {
                            $imgSrc = !empty($row["img"]) ? "../" . htmlspecialchars($row["img"]) : "../img/placeholder.jpg";
                            echo "<tr>
                                <td><span class='badge bg-light text-dark border'>#" . $row["id"] . "</span></td>
                                <td class='text-muted small'>" . htmlspecialchars($row["date"]) . "</td>
                                <td><img src='{$imgSrc}' class='img-thumb-preview' alt='about'></td>
                                <td><strong class='text-dark'>" . htmlspecialchars($row["head1"]) . "</strong></td>
                                <td><span class='text-secondary small'>" . htmlspecialchars($row["paragraph"]) . "</span></td>
                                <td><span class='badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25'>" . htmlspecialchars($row["h5"]) . "</span></td>
                                <td><span class='text-dark small'>" . htmlspecialchars($row["h2"]) . "</span></td>
                                <td>
                                    <div class='d-flex gap-2'>
                                        <a href='about_update.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline-primary rounded-pill px-3 d-inline-flex align-items-center gap-1'>
                                            <i class='ri-edit-line'></i> Edit
                                        </a>
                                        <a href='about_delete.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline-danger rounded-pill px-3 d-inline-flex align-items-center gap-1' onclick='return checkdelete()'>
                                            <i class='ri-delete-bin-line'></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center py-4 text-muted'>No about records found. Click 'Add New Content' to create one.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function checkdelete() {
    return confirm('Are you sure you want to delete this about record?');
}
</script>

<?php include("inc/footer.php"); ?>