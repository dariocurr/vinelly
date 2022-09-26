<!doctype html>

<?php
	include "session.php";
	if(isset($_POST['submit'])) {
		$codice = mysqli_real_escape_string($db, $_POST['codice']);
		$importo = mysqli_real_escape_string($db, $_POST['importo']);
		$query = "SELECT * FROM coupon WHERE codice = '$codice'";
		$result = mysqli_query($db, $query);
		$count = mysqli_num_rows($result);
		if($count == 0) {
			$query = "INSERT INTO coupon (codice, importo_sconto) VALUES ('$codice', $importo)";
			$result = mysqli_query($db, $query);
			if($result) {
				header("location: generate_voucher.php");
			} else {
				header("location: generate_voucher.php?error=1");
			}
		} else {
			header("location: generate_voucher.php?error=2");
		}
	}
?>

<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../res/img/logo.ico">

    <title>Pannello amministratore - Genera coupon</title>

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
			<h1 class="h3 mb-4 font-weight-normal">Crea codice sconto</h1>
			<input type="text" id="inputCode" name="codice" class="form-control-dark" placeholder="Codice sconto" required autofocus>
			<input type="text" id="inputImporto" name="importo" class="form-control-dark" placeholder="Importo (ex: 20)" required autofocus>
			<br>
			<?php if($_GET['error'] == 1) { ?>
				<h6 class="mb-3 font-weight-normal text-red">Inserimento non riuscito</h6>
			<?php } else if($_GET['error'] == 2) { ?>
				<h6 class="mb-3 font-weight-normal text-red">Codice già presente nel database</h6>
			<?php } ?>
			<button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Inserisci codice</button>
		</form>
		</main>
      </div>
    </div>

  </body>
</html>
