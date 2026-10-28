<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Travel Website</title>

	<!-- CSS Link -->
	<link rel="stylesheet" type="text/css" href="css/style.css">


	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

	<!-- Boxicons Link -->
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	
	<!-- Remixicon Link -->
	<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
    rel="stylesheet"/>
</head>
<body>



<!-- header design -->
	<header>
		<a href="index.php" class="logo">Travel <span style="font-family: var(--h5-font-family);">WITH ME</span></a>

		<ul class="navbar">
             <?php if (isset($isAdmin) && $isAdmin): ?>
                <li><a href="admin/menu.php" style="color: #ff9d00; border: 1px dashed #ff9d00; padding: 2px 5px; font-size: 12px;">Change Menu</a></li>
             <?php endif; ?>
			 <?php
                    $query = "SELECT * FROM menu ORDER BY menu_order ASC, id ASC";
                    $run = mysqli_query($conn, $query);

                    $current_page = basename($_SERVER['PHP_SELF']);
                    
                    $parents = [];
                    $submenus = [];

                    if ($run) {
                        while($row = mysqli_fetch_assoc($run)) {
                            $p_id = (int)$row['menu_parent'];
                            if ($p_id > 0) {
                                $submenus[$p_id][] = $row;
                            } else {
                                $parents[] = $row;
                            }
                        }
                    }

                    foreach($parents as $row) {
                        $id = $row['id'];
                        $menu_name = htmlspecialchars($row['menu_name']);
                        $menu_url = htmlspecialchars($row['menu_url']);
                        $has_children = !empty($submenus[$id]);

                        $is_active = (trim(basename($row['menu_url'])) == trim($current_page));
                        if ((trim($current_page) == "index.php" || trim($current_page) == "") && trim(basename($row['menu_url'])) == "index.php") {
                            $is_active = true;
                        }

                        if ($has_children) {
                            foreach ($submenus[$id] as $sub) {
                                if (trim(basename($sub['menu_url'])) == trim($current_page)) {
                                    $is_active = true;
                                    break;
                                }
                            }
                        }

                        $active_class = $is_active ? "class='active'" : "";

                        if ($has_children) {
                            echo "<li class='has-dropdown'>";
                            echo "<a href='$menu_url' $active_class>$menu_name <i class='ri-arrow-down-s-line arrow-icon'></i></a>";
                            echo "<ul class='sub-menu'>";
                            foreach ($submenus[$id] as $sub) {
                                $sub_url = htmlspecialchars($sub['menu_url']);
                                $sub_name = htmlspecialchars($sub['menu_name']);
                                $sub_active = (trim(basename($sub['menu_url'])) == trim($current_page)) ? "class='active'" : "";
                                echo "<li><a href='$sub_url' $sub_active>$sub_name</a></li>";
                            }
                            echo "</ul>";
                            echo "</li>";
                        } else {
                            echo "<li><a href='$menu_url' $active_class>$menu_name</a></li>";
                        }
                    }
              ?>
			
		</ul>

		<div class="h-right">
			<a href="#">Follow Us</a>
			<a href="https://www.instagram.com/"><i class="ri-instagram-fill"></i></a>
			<a href="https://x.com/?lang=en"><i class="ri-twitter-fill"></i></a>
			<a href="https://www.facebook.com/"><i class="ri-facebook-fill"></i></a>
			<div class="bx bx-menu" id="menu-icon"></div>
		</div>
	</header>