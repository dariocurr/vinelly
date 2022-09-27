<!doctype html>
<?php
include 'session.php';
if ($_SESSION['logged'] == 'true') {
	header("location: profile.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$myusername = mysqli_real_escape_string($db, $_POST['username']);
	$mypassword = mysqli_real_escape_string($db, $_POST['password']);
	$mypassword = md5($mypassword);

	$sql = "SELECT id FROM clienti WHERE username = '$myusername' and password = '$mypassword'";
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$count = mysqli_num_rows($result);

	if ($count == 1) {
		$_SESSION['user'] = $myusername;
		$_SESSION['logged'] = 'true';
		if ($_GET['id'] != 0) {
			header("location: description.php?id=" . $_GET['id']);
		} else {
			header("location: index.php");
		}
	} else {
		$_SESSION['logged'] = 'false';
		header("location: login.php?error=1");
	}
}
?>
<html lang="it">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../res/img/logo.ico">

	<title>Vinelly - Login</title>

	<!-- Bootstrap core CSS -->
	<link href="../css/common.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="../css/login.css" rel="stylesheet">
</head>

<body class="text-center">
	<!-- HEADER -->
	<?php
	include "header.php";
	?>
	<form class="form-signin" method="post" action="">
		<img class="mb-4" src="../res/img/logo_single_small.png" alt="" width="150" height="150">
		<h1 class="h3 mb-3 font-weight-normal">Effettua il login</h1>
		<?php if ($_GET['error'] == 1) { ?>
			<h6 class="mb-3 font-weight-normal text-red">Accesso non riuscito</h6>
		<?php } ?>
		<div class="mb-1">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">@</span>
				</div>
				<input type="text" class="form-control" id="username" name="username" placeholder="MarioRossi" required>
				<div class="invalid-feedback" style="width: 100%;">
					Il tuo username è richiesto
				</div>
			</div>
		</div>
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="inputPassword" name="password" class="form-control mb-0" placeholder="Password" required>
		<br>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
		<br>
		<a href="recover_password1.php"><button type="button" class="btn btn-sm btn-outline-secondary">Ho dimenticato la mia password</button></a>
		<a href="signin.php"><button type="button" class="btn btn-sm btn-outline-secondary">Non ho ancora un account</button></a>
		<a class="" href="panel/index.php"><button type="button" class="btn btn-sm btn-outline-secondary mt-3">Sono un amministratore</button></a>
	</form>
	<!-- FOOTER -->
	<?php
	include "footer.php";
	?>
</body>

</html>