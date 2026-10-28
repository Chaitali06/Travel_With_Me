<?php 
include("inc/conn.php");
include("inc/header.php");

// Get stats for the dashboard
$menuCount = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM menu"));
$tourCount = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tour"));
$holidayCount = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM holiday"));
$inquiryCount = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM inquiries"));
$newInquiryCount = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM inquiries WHERE status = 'New'"));
?>

<style>
    .dashboard-card {
        border: none;
        border-radius: 16px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        background: #fff;
    }
    .dashboard-card:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
    .icon-box {
        width: 54px; height: 54px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 14px; font-size: 24px;
    }
    .bg-gradient-primary { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; }
    .bg-gradient-success { background: linear-gradient(135deg, #10b981, #047857); color: white; }
    .bg-gradient-warning { background: linear-gradient(135deg, #f59e0b, #b45309); color: white; }
    .bg-gradient-danger { background: linear-gradient(135deg, #ef4444, #b91c1c); color: white; }
    .bg-gradient-info { background: linear-gradient(135deg, #06b6d4, #0e7490); color: white; }
</style>

<div class="content w-100">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="fw-bold text-dark mb-1">Welcome Back, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
            <p class="text-muted mb-0">Here's an overview of your Travel Site and customer inquiries today.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="inquiries.php" class="btn btn-outline-danger px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
                <i class="ri-inbox-archive-line"></i> Inquiries (<?php echo $newInquiryCount; ?> new)
            </a>
            <a href="../index.php" target="_blank" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
                <i class="ri-external-link-line"></i> View Live Site
            </a>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card dashboard-card p-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-gradient-danger me-3">
                        <i class="ri-inbox-archive-line"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small text-uppercase mb-0">Inquiries</h6>
                        <h3 class="fw-bold mb-0 text-dark"><?php echo $inquiryCount; ?> <span class="badge bg-danger fs-6 align-middle"><?php echo $newInquiryCount; ?> new</span></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card dashboard-card p-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-gradient-success me-3">
                        <i class="ri-map-pin-line"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small text-uppercase mb-0">Active Tours</h6>
                        <h3 class="fw-bold mb-0 text-dark"><?php echo $tourCount; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card dashboard-card p-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-gradient-warning me-3">
                        <i class="ri-sun-line"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small text-uppercase mb-0">Holidays</h6>
                        <h3 class="fw-bold mb-0 text-dark"><?php echo $holidayCount; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card dashboard-card p-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-gradient-primary me-3">
                        <i class="ri-menu-line"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small text-uppercase mb-0">Menu Items</h6>
                        <h3 class="fw-bold mb-0 text-dark"><?php echo $menuCount; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Inquiries Section -->
    <div class="card admin-card p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold text-dark mb-0">Recent Customer Requests</h5>
                <small class="text-muted">Latest booking requests and traveler messages</small>
            </div>
            <a href="inquiries.php" class="btn btn-sm btn-outline-primary rounded-pill px-3">View All Inquiries</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Traveler</th>
                        <th>Type</th>
                        <th>Package / Tour</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $recentInq = mysqli_query($conn, "SELECT * FROM inquiries ORDER BY id DESC LIMIT 5");
                    if ($recentInq && mysqli_num_rows($recentInq) > 0) {
                        while ($r = mysqli_fetch_assoc($recentInq)) {
                            $rStatus = $r['status'];
                            $badgeClass = ($rStatus == 'New') ? 'bg-danger' : (($rStatus == 'Confirmed') ? 'bg-success' : 'bg-warning text-dark');
                            echo "<tr>
                                <td><span class='badge bg-light text-dark border'>#{$r['id']}</span></td>
                                <td><strong class='text-dark'>" . htmlspecialchars($r['name']) . "</strong><br><small class='text-muted'>" . htmlspecialchars($r['email']) . "</small></td>
                                <td><span class='badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25'>" . htmlspecialchars($r['type']) . "</span></td>
                                <td>" . htmlspecialchars($r['tour_name'] ?? 'General') . "</td>
                                <td><span class='badge {$badgeClass} rounded-pill px-3 py-1'>{$rStatus}</span></td>
                                <td class='text-muted small'>" . date("M d, Y", strtotime($r['created_at'])) . "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center py-4 text-muted'>No customer inquiries received yet.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Management -->
    <div class="card admin-card p-4">
        <h5 class="fw-bold text-dark mb-3">Quick Section Shortcuts</h5>
        <div class="d-flex gap-3 flex-wrap">
            <a href="inquiries.php" class="btn btn-outline-danger p-3 rounded-4 text-start" style="min-width: 170px;">
                <i class="ri-inbox-archive-line d-block mb-1 fs-3"></i> 
                <strong>Inquiries</strong><br><small class="text-muted">Manage bookings</small>
            </a>
            <a href="tour.php" class="btn btn-outline-primary p-3 rounded-4 text-start" style="min-width: 170px;">
                <i class="ri-map-pin-line d-block mb-1 fs-3"></i> 
                <strong>Tours</strong><br><small class="text-muted">Edit destinations</small>
            </a>
            <a href="holiday.php" class="btn btn-outline-warning p-3 rounded-4 text-start" style="min-width: 170px;">
                <i class="ri-sun-line d-block mb-1 fs-3"></i> 
                <strong>Holidays</strong><br><small class="text-muted">Vacation packages</small>
            </a>
            <a href="home.php" class="btn btn-outline-dark p-3 rounded-4 text-start" style="min-width: 170px;">
                <i class="ri-home-4-line d-block mb-1 fs-3"></i> 
                <strong>Home Hero</strong><br><small class="text-muted">Banner & CTA</small>
            </a>
            <a href="menu.php" class="btn btn-outline-secondary p-3 rounded-4 text-start" style="min-width: 170px;">
                <i class="ri-list-settings-line d-block mb-1 fs-3"></i> 
                <strong>Nav Menu</strong><br><small class="text-muted">Header navigation</small>
            </a>
        </div>
    </div>
</div>

<?php include("inc/footer.php"); ?>