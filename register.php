<?php
@include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['submit'])) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);
	$type_user = $_POST['type_user'];

	if ($password == $cpassword) {
		$sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
		$result = mysqli_query($conn, $sql);
		if (!$result || $result->num_rows == 0) {
			$sql = "INSERT INTO user (nama, username, email, password, type_user) VALUES ('$nama', '$username', '$email', '$password', '$type_user')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! Registrasi kamu berhasil.')</script>";
				$nama = "";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
				$type_user = "";
			} else {
				echo "<script>alert('Woops! Ada yang salah.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email sudah terdaftar.')</script>";
		}

	} else {
		echo "<script>alert('Password tidak sesuai.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="./css/style.css">

	<title>Register Form</title>
</head>
<body id="bg">
    <main class="main-logReg">
	<div class="form-container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Daftar Akun</p>
         <div>
			<div class="input-group">
				<input type="text" placeholder="Nama" name="nama" value="<?php echo isset($nama) ? $nama : ''; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php echo isset($username) ? $username : ''; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo isset($_POST['cpassword']) ? $_POST['cpassword'] : ''; ?>" required>
			</div>
			<div>
            <select name="type_user">
               <option value="user">User</option>
               <option value="admin">Admin</option>
            </select>
         </div>
			<div class="input-group">
				<input type="submit" name="submit" class="btn-reg" value="Daftar">
			</div>
			<p class="login-register-text">Sudah memiliki akun? <a href="login.php">Masuk</a>.</p>
		</form>
	</div>
</main>
</body>
</html>
