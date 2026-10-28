<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'traveldb');
$out = "";

$tables = ['home', 'feature', 'holiday', 'tour', 'culture', 'menu', 'about', 'contact', 'service'];
foreach ($tables as $table) {
    $res = $conn->query("SELECT * FROM `$table`");
    $out .= "Table: $table (Rows: " . $res->num_rows . ")\n";
    while ($row = $res->fetch_assoc()) {
        $out .= "  Row: " . json_encode($row) . "\n";
    }
    $out .= "\n";
}

file_put_contents('records_output.txt', $out);
echo "Done!";
?>
