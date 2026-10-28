<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"])) {
	header("location:login.php");
	exit();
}

$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Travel Site - Admin Dashboard</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8f9fa; }
        .slidebar { min-width: 270px; max-width: 270px; box-shadow: 4px 0 15px rgba(0,0,0,0.06); background-color: #111827 !important; }
        .menu-link { 
            display: flex; align-items: center; padding: 12px 18px; color: #9ca3af; 
            text-decoration: none; border-radius: 10px; transition: all 0.25s ease;
            margin-bottom: 6px; font-weight: 500; font-size: 14.5px;
        }
        .menu-link:hover { background: rgba(255,255,255,0.08); color: #fff; transform: translateX(3px); }
        .menu-link.active { background: #3b82f6; color: #fff; font-weight: 600; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.35); }
        .menu-link i { margin-right: 12px; font-size: 19px; }
        .sidebar-title { font-size: 1.35rem; font-weight: 800; letter-spacing: 1px; }
        .admin-main-content { flex: 1; min-height: 100vh; overflow-y: auto; }
        .admin-card { background: #fff; border-radius: 16px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.04); }
        .table th { font-weight: 600; font-size: 13.5px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; background: #f9fafb; }
        .table td { vertical-align: middle; font-size: 14.5px; color: #374151; }
        .img-thumb-preview { width: 85px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #e5e7eb; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
	<div class="dashboard d-flex">
		<div class="slidebar vh-100 p-4 sticky-top">
			<div class="text-white sidebar-title mb-4 pb-3 border-bottom border-secondary border-opacity-25 d-flex align-items-center justify-content-between">
                <a href="dashboard.php" class="text-white text-decoration-none d-flex align-items-center gap-2">
                    <i class="ri-compass-3-fill text-primary fs-3"></i> <span>TRAVEL ADMIN</span>
                </a>
            </div>

			<div class="menus">
				<a href="dashboard.php" class="menu-link <?php echo ($currentPage == 'dashboard.php') ? 'active' : ''; ?>"><i class="ri-dashboard-3-line"></i> Dashboard</a>
				<?php
					$newInqCount = 0;
					if (isset($conn)) {
						$inqRes = @mysqli_query($conn, "SELECT COUNT(*) FROM inquiries WHERE status = 'New'");
						if ($inqRes && $inqRow = mysqli_fetch_row($inqRes)) {
							$newInqCount = (int)$inqRow[0];
						}
					}
				?>
				<a href="inquiries.php" class="menu-link d-flex justify-content-between align-items-center <?php echo ($currentPage == 'inquiries.php') ? 'active' : ''; ?>">
					<div class="d-flex align-items-center"><i class="ri-inbox-archive-line"></i> Inquiries & Bookings</div>
					<?php if ($newInqCount > 0): ?>
						<span class="badge bg-danger rounded-pill px-2"><?php echo $newInqCount; ?></span>
					<?php endif; ?>
				</a>
				<a href="menu.php" class="menu-link <?php echo ($currentPage == 'menu.php' || $currentPage == 'menu_insert.php' || $currentPage == 'menu_update.php') ? 'active' : ''; ?>"><i class="ri-menu-2-line"></i> Nav Menu</a>
                <a href="home.php" class="menu-link <?php echo ($currentPage == 'home.php' || $currentPage == 'home_insert.php' || $currentPage == 'home_update.php') ? 'active' : ''; ?>"><i class="ri-home-4-line"></i> Home Section</a>
                <a href="feature.php" class="menu-link <?php echo ($currentPage == 'feature.php' || $currentPage == 'feature_insert.php' || $currentPage == 'feature_update.php') ? 'active' : ''; ?>"><i class="ri-star-line"></i> Feature Section</a>
                <a href="holiday.php" class="menu-link <?php echo ($currentPage == 'holiday.php' || $currentPage == 'holiday_insert.php' || $currentPage == 'holiday_update.php') ? 'active' : ''; ?>"><i class="ri-sun-line"></i> Holiday Section</a>
                <a href="tour.php" class="menu-link <?php echo ($currentPage == 'tour.php' || $currentPage == 'tour_insert.php' || $currentPage == 'tour_update.php') ? 'active' : ''; ?>"><i class="ri-map-pin-line"></i> Tour Section</a>
                <a href="culture.php" class="menu-link <?php echo ($currentPage == 'culture.php' || $currentPage == 'culture_insert.php' || $currentPage == 'culture_update.php') ? 'active' : ''; ?>"><i class="ri-earth-line"></i> Culture Section</a>
                
                <div class="mt-3 pt-3 border-top border-secondary border-opacity-25">
                    <a href="about_table.php" class="menu-link <?php echo ($currentPage == 'about_table.php' || $currentPage == 'about_insert.php' || $currentPage == 'about_update.php') ? 'active' : ''; ?>"><i class="ri-information-line"></i> About Section</a>
                    <a href="contact_table.php" class="menu-link <?php echo ($currentPage == 'contact_table.php' || $currentPage == 'contact_insert.php' || $currentPage == 'contact_update.php') ? 'active' : ''; ?>"><i class="ri-mail-line"></i> Contact Section</a>
                    <a href="service_table.php" class="menu-link <?php echo ($currentPage == 'service_table.php' || $currentPage == 'service_insert.php' || $currentPage == 'service_update.php') ? 'active' : ''; ?>"><i class="ri-customer-service-line"></i> Service Section</a>
                </div>

				<div class="mt-4 pt-2">
					<a href="logout.php" class="btn btn-outline-danger w-100 rounded-pill py-2 d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-logout-box-r-line"></i> Logout
                    </a>
				</div>
			</div>
		</div>

		<div class="admin-main-content p-4 p-lg-5">
            <?php if (isset($_SESSION['flash'])): ?>
                <div class="alert alert-<?php echo $_SESSION['flash']['type']; ?> alert-dismissible fade show shadow-sm rounded-4 mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <i class="ri-<?php echo $_SESSION['flash']['type'] === 'success' ? 'checkbox-circle-fill' : 'error-warning-fill'; ?> fs-5"></i>
                        <strong><?php echo htmlspecialchars($_SESSION['flash']['message']); ?></strong>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['flash']); ?>
            <?php endif; ?>
