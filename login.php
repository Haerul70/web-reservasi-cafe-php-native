<?php
@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, md5 ($_POST['password']));

	$select = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
	$result = mysqli_query($conn, $select);

	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);

		if ($row['type_user'] == 'admin') {
			$_SESSION['nama_admin'] = $row['nama'];
			header('Location: /web-reservasi-resto/admin/admin.php?halaman_admin');
		} elseif ($row['type_user'] == 'user') {
			$_SESSION['user_name'] = $row['nama'];
			header('Location: products.php?halaman_produk');
		}
	} else {
		$error[] = 'Ups! Email atau Password kamu salah!.';
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

	<title>Login</title>
</head>
<body id="bg">
	<main class="main-logReg">
		<div class="form-container">
			<form action="" method="POST" class="login-email">
				<p class="login-text" style="font-size: 2rem; font-weight: 800;">Masuk</p>
				<div class="input-group">
					<input type="email" placeholder="Email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
				</div>
				<div class="input-group">
					<input type="password" placeholder="Password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" required>
				</div>
				<div class="input-group">
					<button type="submit" name="submit" class="btn-reg">Masuk</button>
				</div>
				<p class="login-register-text">Belum memiliki akun? <a href="register.php">Daftar Disini</a>.</p>
			</form>
		</div>
	</main>
</body>
</html>
