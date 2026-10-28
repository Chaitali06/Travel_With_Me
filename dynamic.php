<?php
include("admin/inc/conn.php");

// Fetch menu items
$query = "SELECT id, label, link, parent FROM dmenu ORDER BY sort ASC, label";
$result = $conn->query($query);

$menus = ['items' => [], 'parents' => []];

while ($items = $result->fetch_assoc()) {
    $menus['items'][$items['id']] = $items;
    $menus['parents'][$items['parent']][] = $items['id'];
}

/**
 * Function to create dynamic treeview menus
 */
function createMenu($parent, $menu)
{
    $html = "";
    if (isset($menu['parents'][$parent])) {
        foreach ($menu['parents'][$parent] as $itemId) {
            $label = $menu['items'][$itemId]['label'];
            $link = $menu['items'][$itemId]['link'];
            
            if (!isset($menu['parents'][$itemId])) {
                $html .= "<li><a class='dropdown-item' href='{$link}'>{$label}</a></li>";
            } else {
                $html .= "<li class='dropdown-submenu'>
                            <a class='dropdown-item dropdown-toggle' href='{$link}'>{$label}</a>
                            <ul class='dropdown-menu'>";
                $html .= createMenu($itemId, $menu);
                $html .= "</ul></li>";
            }
        }
    }
    return $html;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dynamic Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dropdown-submenu { position: relative; }
        .dropdown-submenu .dropdown-menu { top: 0; left: 100%; margin-top: -1px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Travel Site</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Explore
                        </a>
                        <ul class="dropdown-menu">
                            <?php echo createMenu(0, $menus); ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
