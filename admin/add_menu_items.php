<?php 

	include("inc/conn.php");

	if(isset($_POST['submit']))
	 {
	 	$parent_id = $_POST['parent_id'];
	 	$name = $_POST['name'];
		
		$query = "INSERT INTO categories (parent_id,name) VALUES ('$parent_id', '$name')";

		$result = mysqli_query($conn, $query);

		if($result)
		{
			echo "Inserted";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Menu Items</title>
</head>
<body>
	<form action="#" method="POST">
		<label>Menu Items Parent</label>

		<select name="parent_id">
			<option>Select Category</option>
			<option value="0">None</option>

			<?php 
				$sql = "SELECT * FROM categories";

				$rs = mysqli_query($conn, $sql);

				while ($row = mysqli_fetch_array($rs)) {
			 ?>

			<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>


			<?php 
				}
			 ?>
		</select>

		<label></label>
		<input type="text" name="name">

		<input type="submit" name="submit">

	</form>
</body>
</html>