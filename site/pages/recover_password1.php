<!doctype html>

<?php
include "session.php";
/*if(isset($_POST['submit'])) {
		$query = "SELECT * FROM clienti WHERE email = '".$_POST['email']."'";
		$result = mysqli_query($db, $query);
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		if($count == 1) {
			header("location: recover_password2.php");
		} else {
			header("location: recover_password1.php?error=1");
		}
	}*/
?>

<html lang="it">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../res/img/logo.ico">

	<title>Vinelly - Recupera la tua password</title>

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
	<form class="form-signin" method="post" action="recover_password2.php">
		<img class="mb-4" src="../res/img/logo_single_small.png" alt="" width="150" height="150">
		<h1 class="h3 mb-3 font-weight-normal">Recupera la tua password</h1>
		<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Indirizzo email" required autofocus>
		<?php if ($_GET['error'] == 1) { ?>
			<h6 class="mb-0 mt-2 font-weight-normal text-red">Account non trovato</h6>
		<?php } ?>
		<?php if ($_GET['error'] == 2) { ?>
			<h6 class="mb-0 mt-2 font-weight-normal text-red">Risposta errata, riprovare</h6>
		<?php } ?>
		<br>
		<button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Recupera</button>
	</form>
	<!-- FOOTER -->
	<?php
	include "footer.php";
	?>
</body>

</html>