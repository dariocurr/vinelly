<!doctype html>

<?php
include "session.php";
$queryVino = "SELECT * FROM vini WHERE id = " . $_GET['id'];
$resultVino = mysqli_query($db, $queryVino);
$datiVino = mysqli_fetch_array($resultVino, MYSQLI_ASSOC);
if (isset($_POST['submit'])) {
	$nuovoPrezzo = mysqli_real_escape_string($db, $_POST['prezzo']);
	$queryModificaVino = "UPDATE vini SET prezzo = $nuovoPrezzo WHERE id = " . $_GET['id'];
	mysqli_query($db, $queryModificaVino);
	header("location: products.php");
}
?>

<html lang="it">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../res/img/logo.ico">

	<title>Pannello amministratore - Modifica prezzo</title>

	<!-- Bootstrap core CSS -->
	<link href="../css/common.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="../../css/panel.css" rel="stylesheet">
</head>

<body>

	<?php
	include "panel_header.php";
	?>

	<div class="container-fluid">
		<div class="row">
			<?php
			include "panel_sidebar.php";
			?>

			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
				<form class="form-signin text-center" method="post" action="">
					<h1 class="h3 mb-4 font-weight-normal">Modifica il prezzo</h1>
					<input type="text" id="inputPrezzo" name="prezzo" value="<?php echo $datiVino['prezzo'] ?>" class="form-control-dark" placeholder="Prezzo" required autofocus>
					<br>
					<button class="btn btn-lg btn-primary btn-block mt-4" name="submit" type="submit">Modifica</button>
				</form>
			</main>
		</div>
	</div>

</body>

</html>