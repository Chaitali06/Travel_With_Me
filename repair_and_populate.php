<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "traveldb";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

echo "<h2>Database Repair and Data Population Script</h2>";

// Helper function to execute query
function runQuery($conn, $sql, $label) {
    if ($conn->query($sql)) {
        echo "SUCCESS: $label<br>";
    } else {
        echo "ERROR on $label: " . $conn->error . "<br>";
    }
}

// 1. Add 'date' column to existing tables if missing
$existingTables = ['culture', 'feature', 'holiday', 'home', 'menu', 'tour'];
foreach ($existingTables as $table) {
    // Check if column exists
    $check = $conn->query("SHOW COLUMNS FROM `$table` LIKE 'date'");
    if ($check->num_rows == 0) {
        $alterSql = "ALTER TABLE `$table` ADD COLUMN `date` DATE NULL";
        runQuery($conn, $alterSql, "Add 'date' column to table `$table`");
    } else {
        echo "INFO: 'date' column already exists in `$table`<br>";
    }
}

// 2. Create missing tables
// Create 'about' table
$conn->query("DROP TABLE IF EXISTS `about`");
$createAbout = "CREATE TABLE `about` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `h5` VARCHAR(255) NULL,
    `h2` VARCHAR(255) NULL,
    `para` TEXT NULL,
    `img` VARCHAR(255) NULL,
    `head1` VARCHAR(255) NULL,
    `paragraph` TEXT NULL,
    `date` DATE NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
runQuery($conn, $createAbout, "Create table `about`");

// Create 'contact' table
$conn->query("DROP TABLE IF EXISTS `contact`");
$createContact = "CREATE TABLE `contact` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `h3` VARCHAR(255) NULL,
    `info` VARCHAR(255) NULL,
    `date` DATE NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
runQuery($conn, $createContact, "Create table `contact`");

// Create 'service' table
$conn->query("DROP TABLE IF EXISTS `service`");
$createService = "CREATE TABLE `service` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `service_heading` VARCHAR(255) NULL,
    `service_info` TEXT NULL,
    `img` VARCHAR(255) NULL,
    `title` VARCHAR(255) NULL,
    `service_desc` TEXT NULL,
    `date` DATE NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
runQuery($conn, $createService, "Create table `service`");

// 3. Clear existing data
echo "<h3>Clearing existing table records...</h3>";
$tablesToTruncate = ['home', 'feature', 'holiday', 'tour', 'culture', 'menu', 'about', 'contact', 'service'];
foreach ($tablesToTruncate as $t) {
    $conn->query("TRUNCATE TABLE `$t`");
}

// 4. Populate dynamic data
echo "<h3>Populating data...</h3>";

// Home Content
$homeSql = "INSERT INTO home (h5, h1, para, btn, date) VALUES (
    'LET\'S GO',
    'Planning Your<br>Own Travel',
    'Explore the world with us. We offer customized tour packages, guided trips, and exceptional services to make your holidays memorable and stress-free.',
    'Book a Trip',
    '" . date('Y-m-d') . "'
)";
runQuery($conn, $homeSql, "Populate Home");

// Feature Content
$features = [
    ['img/pic2.jpg', 'Ski Tours'],
    ['img/pic3.jpg', 'Desert Tours'],
    ['img/pic4.jpg', 'Beach Tours'],
    ['img/pic5.jpg', 'Mountain Tours']
];
foreach ($features as $f) {
    $sql = "INSERT INTO feature (img, h4, date) VALUES ('{$f[0]}', '{$f[1]}', '" . date('Y-m-d') . "')";
    runQuery($conn, $sql, "Populate Feature: {$f[1]}");
}

// Holiday Content
$holidaySql = "INSERT INTO holiday (img, h5, h2, para, btn, date) VALUES (
    'img/pic6.jpg',
    'EAST NUSA TENGGARA',
    'Have You Enjoyed your Holidays?',
    'Discover breathtaking landscapes, clean beaches, and unique wildlife in East Nusa Tenggara. Experience world-class hospitality, custom tour paths, and guided cultural tours designed for travelers seeking a deep adventure.',
    'Read More',
    '" . date('Y-m-d') . "'
)";
runQuery($conn, $holidaySql, "Populate Holiday");

// Tour Content
$tours = [
    ['img/pic7.jpg', 'East Java', 'Mount Bromo', 'See Tours', 'Popular Tours'],
    ['img/pic8.jpg', 'Bali', 'Ubud Temple', 'See Tours', 'Popular Tours'],
    ['img/pic9.jpg', 'Komodo Island', 'Pink Beach', 'See Tours', 'Popular Tours']
];
foreach ($tours as $t) {
    $sql = "INSERT INTO tour (img, h6, h4, btn, h2, date) VALUES ('{$t[0]}', '{$t[1]}', '{$t[2]}', '{$t[3]}', '{$t[4]}', '" . date('Y-m-d') . "')";
    runQuery($conn, $sql, "Populate Tour: {$t[2]}");
}

// Culture Content
$cultureSql = "INSERT INTO culture (h5, h2, para, btn, img, date) VALUES (
    'INDONESIAN CULTURE',
    'Our culture here is very friendly to people',
    'Indonesian culture is a colorful tapestry of diverse traditions, beliefs, arts, and cuisines. Across thousands of islands, you will find warm hospitality, smiling faces, and rich community celebrations that welcome visitors like family.',
    'Read More',
    'img/pic10.jpg',
    '" . date('Y-m-d') . "'
)";
runQuery($conn, $cultureSql, "Populate Culture");

// Menu Content
$menus = [
    ['Home', 0, 'header', 'index.php', 1],
    ['Services', 0, 'header', 'service.php', 2],
    ['About Us', 0, 'header', 'about.php', 3],
    ['Contact Us', 0, 'header', 'contact.php', 4]
];
foreach ($menus as $m) {
    $sql = "INSERT INTO menu (menu_name, menu_parent, menu_type, menu_url, menu_order, date) VALUES ('{$m[0]}', {$m[1]}, '{$m[2]}', '{$m[3]}', {$m[4]}, '" . date('Y-m-d') . "')";
    runQuery($conn, $sql, "Populate Menu: {$m[0]}");
}

// About Content
$aboutEntries = [
    ['OUR STORY', 'We provide the best guidance', 'We started with a simple passion: to make travel accessible, enjoyable, and meaningful. Our team works hard to create itineraries that let you connect with local cultures and nature.', 'img/team-member1.jpg', 'John Doe', 'CEO & Founder'],
    ['', '', '', 'img/team-member2.jpg', 'Jane Smith', 'Travel Agent Specialist'],
    ['', '', '', 'img/team-member3.jpg', 'Mike Johnson', 'Tour Guide Manager']
];
foreach ($aboutEntries as $a) {
    $sql = "INSERT INTO about (h5, h2, para, img, head1, paragraph, date) VALUES ('{$a[0]}', '{$a[1]}', '{$a[2]}', '{$a[3]}', '{$a[4]}', '{$a[5]}', '" . date('Y-m-d') . "')";
    runQuery($conn, $sql, "Populate About: {$a[4]}");
}

// Contact Content
$contacts = [
    ['Mobile Number', '+1 234 567 890'],
    ['Email Address', 'info@travelwithme.com'],
    ['Office Address', '123 Adventure Way, Jakarta, Indonesia']
];
foreach ($contacts as $c) {
    $sql = "INSERT INTO contact (h3, info, date) VALUES ('{$c[0]}', '{$c[1]}', '" . date('Y-m-d') . "')";
    runQuery($conn, $sql, "Populate Contact: {$c[0]}");
}

// Service Content
$services = [
    ['What We Offer', 'Our services are designed to give you the ultimate travel experience from start to finish.', 'img/service1.jpg', 'Flight Booking', 'Compare and book flights to destinations around the world at the best rates.'],
    ['', '', 'img/service2.jpg', 'Hotel Booking', 'Find luxury hotels, resorts, and budget-friendly stays curated for your comfort.'],
    ['', '', 'img/service3.jpg', 'Travel Guides', 'Experience cultures with local certified guides showing you the sights.']
];
foreach ($services as $s) {
    $sql = "INSERT INTO service (service_heading, service_info, img, title, service_desc, date) VALUES ('{$s[0]}', '{$s[1]}', '{$s[2]}', '{$s[3]}', '{$s[4]}', '" . date('Y-m-d') . "')";
    runQuery($conn, $sql, "Populate Service: {$s[3]}");
}

echo "<h2>Database schema repair and sample data population completed successfully!</h2>";
?>
