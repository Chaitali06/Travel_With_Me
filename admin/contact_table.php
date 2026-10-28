<?php 
include("inc/conn.php");
include("inc/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Contact Details & Offices</h3>
        <p class="text-muted small mb-0">Manage support phone numbers, email addresses, and office locations</p>
    </div>
    <a href="contact_insert.php" class="btn btn-primary rounded-pill px-4 shadow-sm d-flex align-items-center gap-2">
        <i class="ri-add-line fs-5"></i> Add New Contact Info
    </a>
</div>

<div class="card admin-card p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th width="8%">ID</th>
                    <th width="15%">Date</th>
                    <th width="25%">Heading / Channel</th>
                    <th width="35%">Contact Information / Details</th>
                    <th width="17%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql = "SELECT * FROM contact ORDER BY id DESC";
                    $rs = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($rs) > 0) {
                        while ($row = mysqli_fetch_array($rs)) {
                            echo "<tr>
                                <td><span class='badge bg-light text-dark border'>#" . $row["id"] . "</span></td>
                                <td class='text-muted small'>" . htmlspecialchars($row["date"]) . "</td>
                                <td><strong class='text-dark'>" . htmlspecialchars($row["h3"]) . "</strong></td>
                                <td><span class='text-secondary small'>" . htmlspecialchars($row["info"]) . "</span></td>
                                <td>
                                    <div class='d-flex gap-2'>
                                        <a href='contact_update.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline-primary rounded-pill px-3 d-inline-flex align-items-center gap-1'>
                                            <i class='ri-edit-line'></i> Edit
                                        </a>
                                        <a href='contact_delete.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline-danger rounded-pill px-3 d-inline-flex align-items-center gap-1' onclick='return checkdelete()'>
                                            <i class='ri-delete-bin-line'></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center py-4 text-muted'>No contact records found. Click 'Add New Contact Info' to create one.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function checkdelete() {
    return confirm('Are you sure you want to delete this contact detail?');
}
</script>

<?php include("inc/footer.php"); ?>