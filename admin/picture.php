<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Upload Image</title>
</head>
<body>
	<div class="container">
		<form action="#" method="post" enctype="multipart/form-data">
			<input type="file" name="uploadfile" id=""><br><br>
			<input type="submit" name="submit" value="Upload File">
		</form>
	</div>
</body>
</html>

<?php 
if (isset($_POST['submit']) && isset($_FILES["uploadfile"]) && $_FILES["uploadfile"]["error"] === UPLOAD_ERR_OK) {
	$filename = basename($_FILES["uploadfile"]["name"]);
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "images/". $filename;

	if (move_uploaded_file($tempname, $folder)) {
		echo "<img src='$folder' height='100px' width='100px'>";
	}
}
?>