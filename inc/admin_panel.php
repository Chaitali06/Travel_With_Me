<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $isAdmin = isset($_SESSION['user']);
?>
<style>
    .admin-edit-container { position: relative; border: 2px dashed transparent; transition: 0.3s; }
    .admin-edit-container:hover { border-color: #ff9d00; }
    .btn-edit { 
        position: absolute; top: 10px; right: 10px; z-index: 1000;
        background: #ff9d00; color: #fff; padding: 5px 15px; border-radius: 5px !important;
        text-decoration: none !important; font-size: 14px; font-weight: bold; border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: inline-block;
    }
    .btn-edit:hover { background: #e68a00; color: #fff; }
    .admin-bar {
        background: #333; color: #fff; padding: 10px; text-align: center;
        position: fixed; top: 0; left: 0; width: 100%; z-index: 9999; font-size: 14px;
        font-family: Arial, sans-serif;
    }
    .admin-bar a { color: #ff9d00; text-decoration: none; font-weight: bold; margin-left: 10px; }
    body.admin-mode { padding-top: 40px; }
</style>
<?php if ($isAdmin): ?>
    <div class="admin-bar">
        Logged in as Admin <span>|</span> <a href="admin/dashboard.php">Go to Dashboard</a> <span>|</span> <a href="admin/logout.php">Logout</a>
    </div>
    <script>document.body.classList.add('admin-mode');</script>
<?php endif; ?>
