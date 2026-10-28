<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Connecting...<br>";
$conn = new mysqli('127.0.0.1', 'root', '', 'traveldb');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<br>");
}
echo "Connected successfully!<br>";

echo "Inserting test row...<br>";
$sql = "INSERT INTO home (h5, h1, para, btn, date) VALUES ('test5', 'test1', 'test_para', 'test_btn', '2026/08/03')";
if ($conn->query($sql)) {
    echo "Insert query succeeded! Affected rows: " . $conn->affected_rows . "<br>";
} else {
    echo "Insert query failed: " . $conn->error . "<br>";
}

echo "Querying home table...<br>";
$res = $conn->query("SELECT * FROM home");
echo "Found " . $res->num_rows . " rows:<br>";
while ($row = $res->fetch_assoc()) {
    print_r($row);
    echo "<br>";
}

$conn->close();
?>
