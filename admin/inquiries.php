<?php 
include("inc/conn.php");
include("inc/header.php");

// Fetch stats
$totalInquiries = 0;
$newCount = 0;
$inProgressCount = 0;
$confirmedCount = 0;

$statsRes = mysqli_query($conn, "SELECT status, COUNT(*) as cnt FROM inquiries GROUP BY status");
if ($statsRes) {
    while ($sRow = mysqli_fetch_assoc($statsRes)) {
        $st = $sRow['status'];
        $cnt = (int)$sRow['cnt'];
        $totalInquiries += $cnt;
        if ($st == 'New') $newCount = $cnt;
        if ($st == 'In Progress') $inProgressCount = $cnt;
        if ($st == 'Confirmed') $confirmedCount = $cnt;
    }
}

// Filter handling
$filter = isset($_GET['filter']) ? trim($_GET['filter']) : 'all';
$search = isset($_GET['q']) ? trim(mysqli_real_escape_string($conn, $_GET['q'])) : '';

$whereClauses = [];
if ($filter == 'new') {
    $whereClauses[] = "status = 'New'";
} elseif ($filter == 'bookings') {
    $whereClauses[] = "type = 'Tour Booking'";
} elseif ($filter == 'messages') {
    $whereClauses[] = "type = 'Contact Message'";
} elseif ($filter == 'confirmed') {
    $whereClauses[] = "status = 'Confirmed'";
}

if (!empty($search)) {
    $whereClauses[] = "(name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' OR tour_name LIKE '%$search%' OR message LIKE '%$search%')";
}

$whereSql = !empty($whereClauses) ? "WHERE " . implode(" AND ", $whereClauses) : "";
$query = "SELECT * FROM inquiries $whereSql ORDER BY id DESC";
$res = mysqli_query($conn, $query);
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h3 class="fw-bold text-dark mb-1">Customer Inquiries & Bookings</h3>
        <p class="text-muted small mb-0">Track tour booking requests, contact messages, and traveler reservations</p>
    </div>
    <div class="d-flex gap-2">
        <a href="inquiries.php" class="btn btn-outline-secondary rounded-pill px-3 d-flex align-items-center gap-2">
            <i class="ri-refresh-line"></i> Refresh
        </a>
    </div>
</div>

<!-- Stats Row -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card admin-card p-3 border-start border-4 border-primary">
            <small class="text-muted text-uppercase fw-semibold">Total Requests</small>
            <h3 class="fw-bold text-dark mt-1 mb-0"><?php echo $totalInquiries; ?></h3>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card admin-card p-3 border-start border-4 border-danger">
            <small class="text-muted text-uppercase fw-semibold">New / Unread</small>
            <h3 class="fw-bold text-danger mt-1 mb-0"><?php echo $newCount; ?></h3>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card admin-card p-3 border-start border-4 border-warning">
            <small class="text-muted text-uppercase fw-semibold">In Progress</small>
            <h3 class="fw-bold text-warning mt-1 mb-0"><?php echo $inProgressCount; ?></h3>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card admin-card p-3 border-start border-4 border-success">
            <small class="text-muted text-uppercase fw-semibold">Confirmed</small>
            <h3 class="fw-bold text-success mt-1 mb-0"><?php echo $confirmedCount; ?></h3>
        </div>
    </div>
</div>

<div class="card admin-card p-4">
    <!-- Filters & Search Toolbar -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div class="btn-group" role="group">
            <a href="inquiries.php?filter=all" class="btn btn-sm <?php echo ($filter == 'all') ? 'btn-primary' : 'btn-outline-secondary'; ?>">All (<?php echo $totalInquiries; ?>)</a>
            <a href="inquiries.php?filter=new" class="btn btn-sm <?php echo ($filter == 'new') ? 'btn-danger' : 'btn-outline-secondary'; ?>">New (<?php echo $newCount; ?>)</a>
            <a href="inquiries.php?filter=bookings" class="btn btn-sm <?php echo ($filter == 'bookings') ? 'btn-info text-white' : 'btn-outline-secondary'; ?>">Tour Bookings</a>
            <a href="inquiries.php?filter=messages" class="btn btn-sm <?php echo ($filter == 'messages') ? 'btn-secondary' : 'btn-outline-secondary'; ?>">Contact Messages</a>
            <a href="inquiries.php?filter=confirmed" class="btn btn-sm <?php echo ($filter == 'confirmed') ? 'btn-success' : 'btn-outline-secondary'; ?>">Confirmed</a>
        </div>

        <form action="inquiries.php" method="GET" class="d-flex gap-2">
            <input type="hidden" name="filter" value="<?php echo htmlspecialchars($filter); ?>">
            <div class="input-group input-group-sm" style="width: 260px;">
                <input type="text" name="q" class="form-control" placeholder="Search traveler, tour..." value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-outline-secondary" type="submit"><i class="ri-search-line"></i></button>
            </div>
            <?php if (!empty($search)): ?>
                <a href="inquiries.php?filter=<?php echo htmlspecialchars($filter); ?>" class="btn btn-sm btn-link text-muted">Clear</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th width="7%">ID / Date</th>
                    <th width="20%">Traveler Info</th>
                    <th width="14%">Type</th>
                    <th width="20%">Tour / Package</th>
                    <th width="13%">Status</th>
                    <th width="16%">Quick Action</th>
                    <th width="10%">Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($res && mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $name = htmlspecialchars($row['name']);
                        $email = htmlspecialchars($row['email']);
                        $phone = !empty($row['phone']) ? htmlspecialchars($row['phone']) : '<span class="text-muted">None</span>';
                        $type = htmlspecialchars($row['type']);
                        $tour = !empty($row['tour_name']) ? htmlspecialchars($row['tour_name']) : 'General';
                        $travelers = (int)$row['travelers'];
                        $date = !empty($row['travel_date']) ? htmlspecialchars($row['travel_date']) : 'Flexible';
                        $msg = htmlspecialchars($row['message']);
                        $status = htmlspecialchars($row['status']);
                        $created = date("M d, Y", strtotime($row['created_at']));

                        // Badges
                        $statusBadgeClass = 'bg-secondary';
                        if ($status == 'New') $statusBadgeClass = 'bg-danger';
                        elseif ($status == 'In Progress') $statusBadgeClass = 'bg-warning text-dark';
                        elseif ($status == 'Confirmed') $statusBadgeClass = 'bg-success';
                        elseif ($status == 'Closed') $statusBadgeClass = 'bg-secondary';

                        $typeBadge = ($type == 'Tour Booking') 
                            ? '<span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1"><i class="ri-flight-takeoff-line"></i> Tour Booking</span>' 
                            : '<span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-2 py-1"><i class="ri-mail-line"></i> Message</span>';

                        echo "<tr>
                            <td>
                                <span class='badge bg-light text-dark border'>#{$id}</span>
                                <div class='text-muted small mt-1'>{$created}</div>
                            </td>
                            <td>
                                <strong class='text-dark'>{$name}</strong>
                                <div class='small text-muted'><a href='mailto:{$email}' class='text-decoration-none'>{$email}</a></div>
                                <div class='small text-muted'><i class='ri-phone-line'></i> {$phone}</div>
                            </td>
                            <td>{$typeBadge}</td>
                            <td>
                                <div class='fw-semibold text-dark'>{$tour}</div>
                                " . ($type == 'Tour Booking' ? "<div class='small text-muted'><i class='ri-user-line'></i> {$travelers} traveler(s) &bull; <i class='ri-calendar-line'></i> {$date}</div>" : "") . "
                            </td>
                            <td>
                                <span class='badge {$statusBadgeClass} px-3 py-1 rounded-pill'>{$status}</span>
                            </td>
                            <td>
                                <form action='inquiry_status.php' method='POST' class='d-flex gap-1'>
                                    <input type='hidden' name='id' value='{$id}'>
                                    <select name='status' class='form-select form-select-sm' onchange='this.form.submit()'>
                                        <option value='New' " . ($status == 'New' ? 'selected' : '') . ">New</option>
                                        <option value='In Progress' " . ($status == 'In Progress' ? 'selected' : '') . ">In Progress</option>
                                        <option value='Confirmed' " . ($status == 'Confirmed' ? 'selected' : '') . ">Confirmed</option>
                                        <option value='Closed' " . ($status == 'Closed' ? 'selected' : '') . ">Closed</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <div class='d-flex gap-1'>
                                    <button type='button' class='btn btn-sm btn-outline-info rounded-pill px-2' data-bs-toggle='modal' data-bs-target='#inqModal{$id}' title='View Message'>
                                        <i class='ri-eye-line'></i>
                                    </button>
                                    <a href='inquiry_delete.php?id={$id}' class='btn btn-sm btn-outline-danger rounded-pill px-2' onclick=\"return confirm('Delete this inquiry permanently?');\" title='Delete'>
                                        <i class='ri-delete-bin-line'></i>
                                    </a>
                                </div>

                                <!-- Inquiry Detail Modal -->
                                <div class='modal fade' id='inqModal{$id}' tabindex='-1' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title fw-bold'>Inquiry #{$id} - {$name}</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <div class='mb-3'>
                                                    <small class='text-muted text-uppercase fw-bold'>Traveler Contact</small>
                                                    <p class='mb-0'><strong>Name:</strong> {$name}<br><strong>Email:</strong> <a href='mailto:{$email}'>{$email}</a><br><strong>Phone:</strong> {$phone}</p>
                                                </div>
                                                <div class='mb-3'>
                                                    <small class='text-muted text-uppercase fw-bold'>Inquiry / Booking Details</small>
                                                    <p class='mb-0'><strong>Type:</strong> {$type}<br><strong>Destination / Topic:</strong> {$tour}<br><strong>Travelers:</strong> {$travelers}<br><strong>Preferred Date:</strong> {$date}</p>
                                                </div>
                                                <div class='mb-3'>
                                                    <small class='text-muted text-uppercase fw-bold'>Customer Message / Requests</small>
                                                    <div class='p-3 bg-light rounded border mt-1'>" . (!empty($msg) ? nl2br($msg) : '<em>No message provided.</em>') . "</div>
                                                </div>
                                                <div>
                                                    <small class='text-muted text-uppercase fw-bold'>Submitted At</small>
                                                    <p class='mb-0 text-muted'>" . htmlspecialchars($row['created_at']) . "</p>
                                                </div>
                                            </div>
                                            <div class='modal-footer'>
                                                <a href='mailto:{$email}?subject=" . urlencode("Regarding your travel inquiry: " . $tour) . "' class='btn btn-primary rounded-pill px-4'>
                                                    <i class='ri-mail-send-line'></i> Reply via Email
                                                </a>
                                                <button type='button' class='btn btn-secondary rounded-pill' data-bs-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center py-5 text-muted'>
                        <i class='ri-inbox-line fs-1 text-muted d-block mb-2'></i>
                        No customer inquiries or bookings found matching the current filter.
                    </td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
include("inc/footer.php");
?>
