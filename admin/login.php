<?php 
include("inc/conn.php");
session_start();

$error = "";
if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $query = "SELECT * FROM user WHERE user='$user' AND pass='$pass'";
    $rs = mysqli_query($conn, $query);
    if (mysqli_num_rows($rs) >= 1) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Login Unsuccessful. Please check your credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<title>Login</title>
</head>
<body>
	<div class="container mt-5" style="max-width:500px;">
		<div class="login-form">
			<?php if (!empty($error)): ?>
				<div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
			<?php endif; ?>
			<form action="#" method="post">
				<div class="form-field mb-4">
					<input class="form-control" type="text" name="user"
					id="" placeholder="Username" required>
				</div>
				<div class="form-field mb-4">
					<input class="form-control" type="password" name="pass"
					id="" placeholder="Password" required>
				</div>
				 <a href="#" class="link" onclick="msg()">Forget Password ?</a><br><br>
				<div class="form-field mb-4">
					<input class="btn btn-primary" type="submit" name="login" value="Login">
				</div>
			</form>
		</div>
	</div>
	<script>
        function msg() {
            alert("Try to remember your password");
        }
    </script>
</body>
</html>