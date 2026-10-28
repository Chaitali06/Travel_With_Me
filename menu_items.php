<?php 
	include("admin/inc/conn.php");

	function showcategory($parentid)
	{
		$query = "SELECT * FROM categories WHERE parent_id='".$parentid."'";

		$result = mysqli_query($GLOBALS['conn'], $query);

		$out = "<ul>\n";

		while($data=mysqli_fetch_array($result)){

			$out.="<li>\n".$data['name'];
			$out.=showcategory($data['id']);
			$out.="</li>";
		}

		$out.="</ul>";

		return $out;

	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Menu Items</title>
</head>
<body>

<?php 

	echo showcategory(0);
 ?>

</body>
</html>