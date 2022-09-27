<!doctype html>

<?php
//non va bene il fatto di passare l'user ID con il get, dobbiamo trovare una soluzione
include "session.php";

if (isset($_POST['submit'])) {
	$query = "SELECT * FROM clienti WHERE email = '" . $_POST['email'] . "'";
	$result = mysqli_query($db, $query);
	$count = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$user_id = $row['id'];
	if ($count == 1) {
		$query1 = "SELECT domanda_sicurezza, risposta_sicurezza FROM clienti WHERE id = " . $user_id;
		$result1 = mysqli_query($db, $query1);
		$row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
	} else {
		header("location: recover_password1.php?error=1");
	}
}

if (isset($_POST['submit2'])) {
	$user_id = mysqli_real_escape_string($db, $_POST['user_id']);
	$risposta = mysqli_real_escape_string($db, $_POST['risposta']);


	$query = "SELECT * FROM clienti WHERE id = " . $user_id . " AND risposta_sicurezza = '" . $risposta . "'";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	if ($count == 1) {
		$_SESSION['tmp_id'] = $user_id;
		header("location: recover_password_change.php");
	} else {
		header("location: recover_password1.php?error=2");
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
	<form class="form-signin" method="post" action="">
		<img class="mb-4" src="../res/img/logo_single_small.png" alt="" width="150" height="150">
		<h1 class="h3 mb-3 font-weight-normal">Recupera la tua password</h1>
		<input type="text" id="inputEmail" name="domanda" value="<?php echo $row['domanda_sicurezza'] ?>" class="form-control bg-white mb-1" disabled required autofocus>
		<input type="text" id="inputEmail" name="risposta" class="form-control" placeholder="Risposta" required autofocus>
		<input type="hidden" name="user_id" value="<?= $user_id ?>">
		<?php if ($_GET['sent'] == 1) { ?>
			<h6 class="mb-0 mt-2 font-weight-normal text-red">Email inviata</h6>
		<?php } else if ($_GET['error'] == 1) { ?>
			<h6 class="mb-0 mt-2 font-weight-normal text-red">Risposta errata</h6>
		<?php } ?>
		<br>
		<button class="btn btn-lg btn-primary btn-block" name="submit2" type="submit">Recupera</button>
	</form>
	<!-- FOOTER -->
	<?php
	include "footer.php";
	?>
</body>

</html>